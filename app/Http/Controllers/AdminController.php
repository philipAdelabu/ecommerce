<?php

namespace App\Http\Controllers;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use DB;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Item;
use App\Models\ItemDetail;
use App\Models\Admin;
use App\Models\CartSession;
use App\Models\User;
use App\Models\Seller;
use App\Models\Purchase;
use App\Models\Earning;
use App\Models\Supplier;
use App\Models\DeliveryAddress;
use App\Models\CompanyDetail;
use App\Models\GeneralInformation;
use App\Http\Controllers\UtilityController;

use Mail;
use App\Mail\AdminReset;
use App\Models\LastDayMonth;
use App\Models\BannerImage;
use App\Models\FeaturedImage;
use App\Models\SpecialImage;
use App\Models\Maquee;


class AdminController extends Controller
{
    //
    //The login page
    public function getLoginPage(){
        $company = CompanyDetail::find(1);
        return view('admin.login', ['company' => $company]);
    }
        //Login out the administrator
        public function getAdminLogout(){
            if((session()->exists('admin') || session('admin')=='login')){
                session()->flush();
                return redirect()->to('login/admin');
            }
             session()->flush();
             return redirect()->to('login/admin');
        }


    //the  administrator login is taken care of here. If the login is successful
    // a session is created for the admin for the login.
     public function getAdminLogin(Request $request){
         $username = $request->input('username');
         $password = md5($request->input('password'));
        try{
         if(DB::table('admins')->where('password', $password)->where('email', $username)->where('status',1)->count()==1){
              $admin = DB::table('admins')->where('email', $username)->where('password', $password)->first();
              $categories = Category::get();
              session(['admin'=>$admin, 'admin_id'=>$admin->id, 'categories'=>$categories]);
            return redirect()->to('adminDashboard');
         }else{
             return back()->with('fail', 'You entered a wrong credential');
         }
        }catch(Exception $e) {
        return $e;
         abort(500, 'There was a problem in the server column section <br />');
        }
     }


     public function getAdminDashboard(){
   
        $data = null;
        $categories = Category::orderBy('name','asc')->get();
         return view('admin.a_dashboard', ['data'=>$data, 'categories'=>$categories]);
     }


   
    public function getAddCategory(Request $request){
        $categories = Category::orderBy('name','asc')->get();
        return view('admin.add_category', ['categories'=>$categories]);
    }


    public function postAddCategory(Request $request){
        $category = strtoupper($request->input('category'));
        if(strlen($category) <= 1){
            return back()->with('fail', 'Please, type the name of category in full.');
        }

        if(Category::where('name', $category)->exists()){
            return back()->with('fail', 'The '.$category.' category was already added');
        }else{
        $catg = new Category();
        $catg->name = $category;
        $catg->icon = $request->input('icon');
        $catg->admin_id = session('admin_id');
        $catg->save();
        return back()->with('success','The '.$category.' category was successfully added');
        }
        return back()->with('fail', 'Please try again later, there was a technical problem.');
    }

    public function postSubCategory(Request $request){
        $catg_id = $request->input('catg_id');
        if($catg_id == null){
            return back()->with('fail', 'Please check to see if a category has been selected.');
        }
        $sub_catg =  ucfirst(strtolower($request->input('sub_category')));
        if(strlen($sub_catg) <= 1){
            return back()->with('fail', 'Please, Enter a sub-category name in full.');
        }

        if(SubCategory::where('name', $sub_catg)->where('category_id', $catg_id)->exists() ){
            return back()->with('fail', 'The  '.$sub_catg.'  sub-category was already added');
        }else{

        $s_catg = new SubCategory();
        $s_catg->name = $sub_catg;
        
        $catg = Category::find($catg_id);
        $catg->subCategory()->save($s_catg);

        return back()->with('success','The '.$sub_catg.' sub-category was successfully added');
        }
        return back()->with('fail', 'Please try again later, there was a technical problem.');
    }
    

    public function getViewCategory(Request $request){
        $categories = Category::get();
        return view('admin.view_category', ['categories'=>$categories]);
    }

    public function getAdminEditItem(Request $request, $type, $id){
        $item = $items = null;
        if($type == 'category'){
            $item = Category::find($id);
            $items = Category::orderBy('name','asc')->get();
        }
        if($type == 'sub_category'){
            $item = SubCategory::find($id);
            if($item)
            $items = SubCategory::where('category_id', $item->category_id)->orderBy('name','asc')->get();
        }
       
        $features = json_decode($item->features);
        $features_key = json_decode($item->features_key);

        return view('admin.admin_edit_item', ['features'=>$features, 'features_key'=>$features_key,'item'=>$item, 'items'=>$items, 'type'=>$type]);
       
    }

    public function getAdminDeleteItem(Request $request, $type, $id){
        DB::beginTransaction();
         
        try{
        if($type == 'category'){
            $category = Category::find($id);
            if(!$category) return back();
            if($category){
                $sub_cats = SubCategory::where('category_id', $category->id)->get();
                if(count($sub_cats) > 0 ){
                    foreach($sub_cats as $sbc){
                        if($this->deleteSubcategoryProduct($sbc->id))
                              $sbc->delete();    
                    }
                }
            }
            $category->delete();
        }

        if($type == 'sub_category'){
            if($this->deleteSubcategoryProduct($id)){
                $item = SubCategory::find($id);
                $item->delete(); 
            }
                
          }

        DB::commit();
        return redirect()->to('view_category')->with('success', 'The action was successful');
       
        }catch(\Exception $e){
            DB::rollBack();
            return $e;
            return back()->with('fail', 'The was a problem. Please try again later.');
        }
       
    }

   public function deleteSubcategoryProduct($sub_category_id){

    $items = Item::where('sub_category_id', $sub_category_id)->get();
    if(count($items) < 1) return true;
    try{
        foreach($items as $item){
            try{
        if($item->image1) UtilityController::deleteImage($item->image1);
        if($item->image2) UtilityController::deleteImage($item->image2);
        if($item->image3) UtilityController::deleteImage($item->image3);
        if($item->image4) UtilityController::deleteImage($item->image4);
          $item->delete();
            }catch(\Exception $e){
            $item->delete();
            }
        }
        return true;
    }catch(\Exception $e){
        throw $e;
    }

   }



    public function postAdminUpdateItem(Request $request){
        $item = strtoupper($request->input('item'));
        if(strlen($item) <= 1){
            return back()->with('fail', 'Please, type in a name that is reasonable enough');
        }
        $id = $request->input('id');
        $type = $request->input('type');
        if($type == 'category'){
            $catg = Category::where('id', $id)->first(); 
            $catg->name = $item;
            if($request->input('icon') != null){
             $catg->icon = $request->input('icon');
            }
            $catg->save();
        }
        if($type == 'sub_category'){
            $subcatg = SubCategory::where('id', $id)->update([
                'name'=>$item,
            ]);
        }
        return back()->with('success','The name was successfully edited');
    }

    public function getAdminAddProduct(){
        $categories = Category::get();
        return view('admin.admin_add_item', ['categories'=>$categories]);
    }
   
     public function getSubCategory(Request $request, $id){
      $sub_catg = SubCategory::where('category_id', $id)->orderBy('name','asc')->pluck('name');
       return   json_encode($sub_catg);
     }
     
     public function postAdminAddProduct(Request $request){
 
        if($request->category == '' || $request->sub_category == '')
        return  back()->with('fail', 'Please, select a Category and Sub-category');
      DB::beginTransaction();
      try{
         if(isset($request->update)){
              $item = Item::find($request->item_id);
             /* if($item->image1) File::delete($item->image1);
                if($item->image2) UtilityController::deleteImage($item->image2);
              if($item->image3) UtilityController::deleteImage($item->image3);
              if($item->image4) UtilityController::deleteImage($item->image4); */
         }else $item = new Item();

        /// the features added by the user
        //////////////////////////////////
          $features = $features_key = [];
           for($i = 1; $i <= 40; $i++){
             if( trim($request->input('key_'.$i)) && trim($request->input('value_'.$i)) ){
               $features_key[] = $request->input('key_'.$i);
               $features[$request->input('key_'.$i)] = $request->input('value_'.$i);
             } 
           }
        
         $item->item_type = $request->item_type;
         $item->features = json_encode($features);
         $item->features_key = json_encode($features_key);
         ///////////////////////////////////////////

         $item->old_price = $request->old_price;
         $item->new_price = $request->new_price;
         $item->company = session('admin')->company;
         $item->contact = session('admin')->phone; 
         $item->package = $request->package;
         $item->video_url = $request->video;
         $item->item_condition = $request->item_condition;
         $item->name = $request->name;
         $item->quantity = $item->initial_quantity = $request->quantity;
        
         if($request->category_changed == 'yes' || $request->update_item == null) {
            $category = explode('/', $request->category);
            $category_id = $category[0];
            $item->category = $category[1];
            $item->sub_category = $request->sub_category;
            $sub_catg = SubCategory::where('category_id', $category_id)->where('name', $request->sub_category)->first();
            if(!$sub_catg || !$category[1]) return  back()->with('fail', 'Please, select a Category and Sub-category');
            $item->sub_category_id = $sub_catg->id;
         }
        
         $item->admin_id = session('admin_id');
         $item->description = $request->description;
  
        
         $data = null;
         if($request->hasFile('images.*')){ 
             $util = new UtilityController();
             $data = $util->imageUpload($request, 'images.*');
            }
    
         if(isset($data[0])){  if($item->image1) UtilityController::deleteImage($item->image1); $item->image1 = $data[0]; }
         if(isset($data[1])){  if($item->image2) UtilityController::deleteImage($item->image2); $item->image2 = $data[1]; }
         if(isset($data[2])){  if($item->image3) UtilityController::deleteImage($item->image3); $item->image3 = $data[2]; }
         if(isset($data[3])){  if($item->image4) UtilityController::deleteImage($item->image4); $item->image4 = $data[3]; }

         $item->save();
         DB::commit();
         return back()->with('success', 'The action was successfully done');
      }catch(\Exception $e){
          DB::rollBack();
          return $e;
      }

     }

   

     public function getAdminItemDetail($sub_catg_id = null){
         $item = $items = $category = null;
         $find = true;
         if($sub_catg_id != null){
           
            $item = Item::where('admin_id', session('admin_id'))->where('sub_category_id', $sub_catg_id)->inRandomOrder()->first();
            if($item == null) $find = false;
            else
            $items = Item::where('admin_id', session('admin_id'))->where('sub_category_id', $sub_catg_id)->where('id','<>', $item->id)->orderBy('created_at', 'desc')->paginate(20);
            
         }else{
         $item = Item::where('admin_id', session('admin_id'))->inRandomOrder()->limit(1)->first();
         if($item == null) { $find = false; }
         else
         $items = Item::where('admin_id', session('admin_id'))->where('sub_category_id', $item->sub_category_id)->where('id','<>', $item->id)->orderBy('created_at', 'desc')->paginate(20);
         }
         $categories = Category::get();
         if(!$find)  $item = $items = $category = null;
         $features = $features_key = null;
         if($item != null){
         $features = json_decode($item->features);
         $features_key = json_decode($item->features_key);
         }
          
         return view('admin.admin_item_detail', ['features'=>$features, 'features_key'=>$features_key,'item'=>$item, 'items'=>$items, 'categories'=>$categories]);
     }

     public function getAdminViewItem(){
        $items = Item::where('admin_id', session('admin_id'))->paginate(20);
        $categories = Category::get();
        return view('admin.admin_item', ['items'=>$items, 'categories'=>$categories]);
     }

     public function postAdminSearchContent(Request $request){
         $features = null;
         $features_key = null;
         $it = $request->item;
         $category = $request->category;
         $item = $items = $categories = null; 
         $find = true;
         if($category == 'all'){
            $item = Item::where('admin_id', session('admin_id'))  
                                    ->Where('name','like', '%'.$it.'%') 
                                    ->orWhere('id','like', $it)
                                    ->orWhere('company','like', '%'.$it.'%')
                                   ->orWhere('sub_category','like', '%'.$it.'%')
                                   ->orWhere('state','like', '%'.$it.'%')
                                   ->orWhere('city','like', '%'.$it.'%')
                                   ->inRandomOrder()->first();
        
        if($item == null){
                $item = Item::where('admin_id', session('admin_id'))->inRandomOrder()->limit(1)->first();
                $find = false;
            }     
         }else{
         $item = Item::where('admin_id', session('admin_id'))
                                ->Where('name','like', '%'.$it.'%')
                                ->orWhere('id','like', $it)
                                ->orWhere('company','like', '%'.$it.'%')
                                ->orWhere('sub_category','like', '%'.$it.'%')
                                ->orWhere('state','like', '%'.$it.'%')
                                ->orWhere('city','like', '%'.$it.'%')
                                ->where('category','like', '%'.$category.'%')
                                ->inRandomOrder()
                                ->limit(1)->first();
      if($item == null){
        $item = Item::where('admin_id', session('admin_id'))->inRandomOrder()->limit(1)->first();
        $find = false;
        }  
       $items = Item::where('sub_category_id', $item->sub_category_id)->where('id','<>', $item->id)->orderBy('created_at', 'desc')->paginate(20);
        
         }
         if($item != null){
             $items = Item::where('sub_category_id', $item->sub_category_id)->where('id','<>', $item->id)->orderBy('created_at', 'desc')->paginate(20);
             $features = json_decode($item->features);
             $features_key = json_decode($item->features_key);
            }else{
                $features = null;
                $features_key = null;
            }
         $categories = Category::get();
         
         if(!$find)
         return view('admin.admin_item_detail', ['features'=>$features, 'features_key'=>$features_key,'item'=>$item, 'items'=>$items, 'categories'=>$categories])->with('fail', 'We did not find what you are looking for, but find something that migth interest you.');
         else
         return view('admin.admin_item_detail', ['features'=>$features, 'features_key'=>$features_key,'item'=>$item, 'items'=>$items, 'categories'=>$categories]);
   
     }

     public function getAdminSpecificItem(Request $request, $status , $id){
         if($status == 'view'){
            //$item = Item::where('admin_id', session('admin_id'))->where('id', $id)->first();
            //$items = Item::where('admin_id', session('admin_id'))->where('id','<>', $item->id)->orderBy('created_at', 'desc')->paginate(12);
            $item = Item::where('id', $id)->first();
            $items = Item::where('id','<>', $item->id)->orderBy('created_at', 'desc')->paginate(12);
            $features = json_decode($item->features);
            $features_key = json_decode($item->features_key);
            $categories = Category::get();
            return view('admin.admin_item_detail', ['features'=>$features, 'features_key'=>$features_key,'item'=>$item, 'items'=>$items, 'categories'=>$categories]);
         }

         if($status == 'edit'){
            return redirect()->to('admin_update_item/'.$id);
         }

         if($status == 'delete'){
            try{
            $item = Item::find($id);
        
            if($item->image1 != null) UtilityController::deleteImage($item->image1);
            if($item->image2 != null) UtilityController::deleteImage($item->image2);
            if($item->image3 != null) UtilityController::deleteImage($item->image3);
            if($item->image4 != null) UtilityController::deleteImage($item->image4);
            $item->delete();
            return redirect()->to('admin_view_item_detail')->with('success', 'The action performed was successful');
            }catch(\Exception $e){
                throw $e;
            }
         }

     }

      public function getAdminUpdateItem($id){
        $item = Item::find($id);
        $categories = Category::get();
        $features = json_decode($item->features);
        $features_key = json_decode($item->features_key);
        return view('admin.admin_update_item',['features'=>$features, 'features_key'=>$features_key,'item'=>$item, 'categories'=>$categories]);
      }

      public function getSubCategory1(Request $request, $id){
        $sub_catg = SubCategory::where('category_id', $id)->orderBy('name','asc')->pluck('name');
         return   json_encode($sub_catg);
       }

       public function getAdminAddSeller(){
           return view('admin.create_seller');
       }

       public function postCreateSeller(Request $request){
            DB::beginTransaction();
           try{
            $sll = [];
           if(!isset($request->edit)){

            if(Supplier::where('company', $request->company)->exists()){
                return back()->with('fail', 'The company name you entered already exist in the system. Please try another Company name.');
            }
            if(Supplier::where('email', $request->email)->exists()){
                return back()->with('fail', 'The email you entered already exist in the system. Please try another email address.');
            }

           $password = str_random(8);
           $username = $request->email;
           $sll['password'] = $password;
           $sll['username'] = $username;
           
           $seller = new Supplier();
           $seller->name =  $sll['name'] = $request->name;
           $seller->address =  $sll['address'] = $request->address;
           $seller->title = $sll['title'] = $request->title;
           $seller->company = $sll['company'] = $request->company;
           $seller->lga = $sll['lga'] = $request->lga;
           $seller->state = $sll['state'] = $request->ostate;
           $seller->information = $sll['information'] = $request->information;
           $seller->phone = $sll['phone'] = $request->phone;
           $seller->email = $sll['email'] = $request->email;
           $seller->vat = $sll['vat'] = $request->vat;
           $seller->brn = $sll['brn'] = $request->brn;
           $seller->business_type = $sll['business_type'] = $request->business_type;
           $seller->person_in_charge = $sll['person_in_charge'] = $request->person_in_charge;
           $seller->account_name = $sll['account_name'] = $request->account_name;
           $seller->bank_name = $sll['bank_name'] = $request->bank_name;
           $seller->account_number = $sll['account_number'] = $request->account_number;

           $seller->password = md5($password);
           $seller->old_password = $this->enc_dec($password);
           if(session('admin_id') == 1)
             $seller->referral = 1;
            else $seller->referral = 2;            
           $admin = Admin::find(session('admin_id'));
           
           $admin->suppliers()->save($seller);
           $email = $username;
           try{
           Mail::to($email)->send(new AdminReset($username, $password));
           }catch(\Exception $e){
               DB::rollBack();
             return $e;
           }
           
           }else{
               $seller = Supplier::find($request->id);
               $seller->name =  $sll['name'] = $request->name;
               $seller->address =  $sll['address'] = $request->address;
               $seller->title = $sll['title'] = $request->title;
               $seller->company = $sll['company'] = $request->company;
               $seller->lga = $sll['lga'] = $request->lga;
               $seller->state = $sll['state'] = $request->ostate;
               $seller->information = $sll['information'] = $request->information;
               $seller->phone = $sll['phone'] = $request->phone;
               $seller->email = $sll['email'] = $request->email;
               $seller->vat = $sll['vat'] = $request->vat;
               $seller->brn = $sll['brn'] = $request->brn;
               $seller->business_type = $sll['business_type'] = $request->business_type;
               $seller->person_in_charge = $sll['person_in_charge'] = $request->person_in_charge;
               $seller->account_name = $sll['account_name'] = $request->account_name;
               $seller->bank_name = $sll['bank_name'] = $request->bank_name;
               $seller->account_number = $sll['account_number'] = $request->account_number;
               $seller->save();

               $seller = Supplier::find($request->id);
               
                 $history = $seller;
             if($history){
            DB::table('supplier_history')->insert([
            'supplier_id' => $history->id,
            'email' => $request->email,
            'name' =>  $request->name,
            'address' =>  $request->address,
            'title' => $request->title,
            'company' =>  $request->company,
            'lga' =>  $request->lga,
            'state' =>  $request->ostate,
            'information' =>  $request->information,
            'phone' =>  $request->phone,
            'vat' => $request->vat,
            'brn' =>  $request->brn,
            'business_type' =>  $request->business_type,
            'person_in_charge' =>  $request->person_in_charge,
            'account_name' => $request->account_name,
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            ]);
           }
               
               
               DB::commit();
               return view('admin.seller_edit', ['seller'=>$seller])->with('success', 'The seller information was successfully updated');      
           }
           
           
             $history = Supplier::where('email', $request->email)->first();
          if($history){
           DB::table('supplier_history')->insert([
            'supplier_id' => $history->id,
            'email' => $request->email,
            'name' =>  $request->name,
            'address' =>  $request->address,
            'title' => $request->title,
            'company' =>  $request->company,
            'lga' =>  $request->lga,
            'state' =>  $request->ostate,
            'information' =>  $request->information,
            'phone' =>  $request->phone,
            'vat' => $request->vat,
            'brn' =>  $request->brn,
            'business_type' =>  $request->business_type,
            'person_in_charge' =>  $request->person_in_charge,
            'account_name' => $request->account_name,
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            ]);
          }

           session(['seller' => $sll]);
           DB::commit();
           return redirect()->to('seller_created')->with('success', 'The seller was successfully created');
           }catch(\Exception $e){
               DB::rollBAck();
               return $e;
           }
       }
     public function getSellerCreated(){
         return view('admin.seller_successfull_creation');
     }
      
     public function  getAdminManageSupplier(){
         if(session('admin_id') == 1)
         $sellers = Supplier::orderBy('created_at', 'desc')->get();
         else
         $sellers = Supplier::where('admin_id', session('admin_id'))->orderBy('created_at', 'desc')->get();
      
         return view('admin.manage_supplier', ['sellers'=>$sellers]);
     }

     public function getAdminManageSeller($status , $id){
         if($status == 'view'){
            $seller = Supplier::find($id);
            $password = $this->enc_dec($seller->old_password);
            return view('admin.seller_detail', ['password'=>$password, 'seller'=>$seller]);
         }

         if($status == 'edit'){
            $seller = Supplier::find($id);
            return view('admin.seller_edit', ['seller'=>$seller]);  
         }

         if($status == 'suspend'){
            $seller = Supplier::find($id);
            $seller->status = 1;
            $seller->save();
            $sellers = Supplier::where('admin_id', session('admin_id'))->orderBy('created_at', 'desc')->get();
            return view('admin.manage_supplier', ['sellers'=>$sellers])->with('success', 'The action performed was successfull.'); 
         }
         if($status == 'enable'){
            $seller = Supplier::find($id);
            $seller->status = 0;
            $seller->save();
            $sellers = Supplier::where('admin_id', session('admin_id'))->orderBy('created_at', 'desc')->get();
            return view('admin.manage_supplier', ['sellers'=>$sellers])->with('success', 'The action performed was successfull.'); 
         }

         if($status == 'delete'){
            $seller = Supplier::find($id);
            $seller->delete();
            $items = Item::where('supplier_id', $id)->get();
            if(count($items) > 0)
            foreach($items as $item){
            //if($item->image1) File::delete($item->image1);
            /*
            if($item->image2) File::delete($item->image2);
            if($item->image3) File::delete($item->image3);
            if($item->image4) File::delete($item->image4);
            */

            if($item->image2) UtilityController::eleteImage($item->image2);
            if($item->image3) UtilityController::deleteImage($item->image3);
            if($item->image4) UtilityController::deleteImage($item->image4);

            $item->delete();
            }
           // $sellers = Supplier::where('admin_id', session('admin_id'))->orderBy('created_at', 'desc')->paginate(10);
            return redirect()->to('admin/manage/supplier')->with('success', 'The action performed was successfull.'); 
         }
     }


    public function getAdminViewSupplierItems(){
        if(session('admin_id') == 1)
        $sellers = Supplier::orderBy('updated_at', 'desc')->paginate(10);
        else
        $sellers = Supplier::where('admin_id', session('admin_id'))->orderBy('name', 'asc')->paginate(20);
        return view('admin.seller_items', ['sellers' => $sellers]);
    }


    public function getAdminSellerItems($id){
        $items = Item::where('supplier_id', $id)->orderBy('name', 'asc')->paginate(10);
        $seller = Supplier::find($id);
        return view('admin.seller_products', ['seller'=>$seller, 'items'=>$items]);
    }

    public function getAdminSellerSpecificItem(Request $request, $status , $id, $seller_id){
        if($status == 'view'){
           $item = Item::where('id', $id)->first();
           $items = Item::where('id','<>', $item->id)->where('supplier_id', $seller_id)->orderBy('created_at', 'desc')->paginate(20);
           $seller = Supplier::find($item->supplier_id);
           $categories = Category::get();
           $features = json_decode($item->features);
           $features_key = json_decode($item->features_key);
           return view('admin.seller_item_detail', ['features'=>$features, 'features_key'=>$features_key,'seller'=>$seller,'item'=>$item, 'items'=>$items, 'categories'=>$categories]);
        }

    
        if($status == 'delete'){
           $item = Item::find($id);

            // if($item->image1) File::delete($item->image1);
             /*
            if($item->image2) File::delete($item->image2);
            if($item->image3) File::delete($item->image3);
            if($item->image4) File::delete($item->image4);
            */

            if($item->image2) UtilityController::deleteImage($item->image2);
            if($item->image3) UtilityController::deleteImage($item->image3);
            if($item->image4) UtilityController::deleteImage($item->image4);
            
           $item->delete();
           return redirect()->to('admin/view/supplier/items')->with('success', 'The action performed was successful');
        }
    }
   
    public function getAdminViewPurchaseItem(){
        if(session('admin_id') == 1)  $items = Purchase::get();
        else  $items = Purchase::where('admin_id', session('admin_id'))->get();
        return view('admin.purchase_items', ['items'=>$items]);
    }

    public function getAdminItemPurchase($status, $id){
        $purchase = Purchase::find($id);
        if($status == 'approve'){
           $purchase->status = 1;
           $item = Item::where('id', $purchase->item_id)->first();
           $quantity = $item->quantity;
           $quantity -=  $purchase->quantity;
           $item->quantity = $quantity;
           $item->save();
           $purchase->save();
        }
        if($status == 'cancel'){
           $purchase->status = 2;
           $purchase->save();
        } 
        if($status == 'delete'){
            $purchase->delete();
        }
        
        return back()->with('success', 'The action has been activated.');
    }

    public function getAdminTransactionDetail($trans_id, $buyer_id, $seller_id=null){
        $seller = null;
        if($seller_id != null)  $seller = Supplier::find($seller_id);
        $buyer = User::find($buyer_id);
        if(session('admin_id') == 1) $items = Purchase::where('transaction_id', $trans_id)->get();
        else $items = Purchase::where('admin_id', session('admin_id'))->where('transaction_id', $trans_id)->get();
          
        $address = DeliveryAddress::where('transaction_id', $trans_id)->first();
        return view('admin.transaction_detail', 
        ['address'=>$address, 'items'=>$items, 'seller'=>$seller, 'buyer'=>$buyer]);
    }

    public function getUsers(){
        $users = User::orderBy('name','asc')->get();
        return view('admin.user', ['users'=>$users]);
    }

    public function getBuyers(){
        if(session('admin_id') == 1){
        $users = DB::table('users')->join('purchases', 'users.id', '=', 'purchases.user_id')
        ->select('users.*')
        ->where('users.status', '=', 0)
        ->orderBy('users.created_at', 'desc')->distinct()->get();
        }else{
            $users = DB::table('users')->join('purchases', 'users.id', '=', 'purchases.user_id')
        ->select('users.*')
        ->where('users.status', '=', 0)
        ->where('purchases.admin_id', session('admin_id'))
        ->orderBy('users.created_at', 'desc')->distinct()->get();   
        }
        return view('admin.buyer', ['users'=>$users]);
    }

    public function getAdminUser($status, $id){
        $user = User::find($id);
        if($status == 'suspend'){
           $user->status = 1;
           $user->save();
        }
        if($status == 'activate'){
           $user->status = 0;
           $user->save();
        }

        if($status == 'delete'){
            $user->delete();
        }

        if($status == 'delete_buyer'){
            $buyers = Purchase::where('user_id',$id)->get();
            foreach($buyers as $buyer) $buyer->delete();
        }
       
        return back()->with('success', 'The action has been processed.');
    }

  public function getAdminAddFeatured(){
      return view('admin.admin_add_featured');
  }

  public function getAdminAddBanner(){
    return view('admin.admin_add_banner');
  }
  public function getAdminAddSpecial(){
    return view('admin.admin_add_special');
  }

  public function postAdminAddFeatured(Request $request){
    $item_id = $request->item_id;

    if($request->hasFile('image')){ 
        $util = new UtilityController();
      $image = $util->uploadSpecialImage($request, 'featured', 'image');
      $featured = null;
      if($image != null){
         if($item_id != null)
               $featured = FeaturedImage::where('item_id', $item_id)->first();
          if($featured != null){ 
              $featured->image = $image; 
              $featured->save(); 
          }else{
            $featured = new FeaturedImage();
            $featured->image = $image;
            $featured->item_id = $item_id;
            $featured->save();
          }
          return  back()->with('success', 'The Image was successfully loaded');
      }else{
         return  back()->with('fail', 'The Image was not stored, please try again later.'); 
      }
     }else{
     return  back()->with('fail', 'The Image is not well loaded. Try again');
     }
  }

  
  
    public function postAdminAddBannerAd(Request $request){

        $item_id = $request->item_id;
    
      if($request->hasFile('image')){ 
        $util = new UtilityController();
        $image = $util->uploadSpecialImage($request, 'banner', 'image');
        if($image != null){
            $banner = null;
            if($item_id != null)
                  $banner = DB::table('banner_ads')->where('item_id', $item_id)->first();
            if($banner != null ){ 
                DB::table('banner_ads')->where('item_id', $item_id)->update(['image'=>$image, 'updated_at' => now()]);
            }else{
              DB::table('banner_ads')->insert(['image'=>$image,'item_id'=>$item_id, 'updated_at'=>now() ]);
            }
            return  back()->with('success', 'The Image was successfully loaded');
        }else{
           return  back()->with('fail', 'The Image was not stored, please try again later.'); 
        }
       }else{
       return  back()->with('fail', 'The Image is not well loaded. Try again');
       }
  }
  
  
  
  public function getAdminDeleteBannerAd(){
      $items = DB::table('banner_ads')->orderBy('updated_at')->paginate(30);
      return view('admin.admin_delete_banner_ad',['items'=>$items]);
  }
  
  
  

  public function postAdminAddSpecial(Request $request){
    $id = $request->item_id;
    $item = Item::find($id);
    if($item == null) return back()->with('fail', 'The Id number you entered is invalide');
    if($request->hasFile('image')){ 
     $util =  new UtilityController();
      $image = $util->uploadSpecialImage($request, 'special', 'image');
      if($image != null){
          $special = SpecialImage::where('item_id', $id)->first();
          if($special != null){ 
              $special->image = $image; 
              $special->save(); 
              return  back()->with('success', 'The Image was successfully loaded');
          }
          else{
            $special = new SpecialImage();
            $special->image = $image;
            $item->specialImage()->save($special);
            return  back()->with('success', 'The Image was successfully loaded');
          }
      }else{
         return  back()->with('fail', 'The Image was not stored, please try again later.'); 
      }
     }else{
     return  back()->with('fail', 'The Image is not well loaded. Try again');
     }
}




 public function getAdminRemoveItem($item, $id = null){
   
    if($item == 'Banner'){
        if($id != null){
           $b = BannerImage::find($id);
           UtilityController::deleteImage($b->image);
           $b->delete();
           
        }
        $items = BannerImage::paginate(20);
    }
    if($item == 'Featured'){
        if($id != null){
            $b = FeaturedImage::find($id);
            UtilityController::deleteImage($b->image);
            $b->delete();
         }
        $items = FeaturedImage::paginate(12);
    }
    if($item == 'Special'){
        if($id != null){
            $b = SpecialImage::find($id);
            UtilityController::deleteImage($b->image);
            $b->delete();
         }
        $items = SpecialImage::paginate(12);
    }
    
     if($item == 'banner_ad'){
        if($id != null){
            $b = DB::table('banner_ads')->where('id', $id)->first();
            UtilityController::deleteImage($b->image);
            DB::table('banner_ads')->where('id', $id)->delete();
         }
        return back()->with('success', 'The action was successfull');
    }
     
    
    
    if($id != null){
        // if($b->image) File::delete($b->image);
         if($b->image) $this->deleteImage($b->image);
     }
  
    $categories = Category::get();
    return view('admin.admin_delete_items', ['items'=>$items,'categories'=>$categories, 'type'=>$item]);
 }

 public function getAdminPasswordReset(){
     return view('admin.view_password_reset');
 }

 public function postAdminPasswordReset(Request $request){
   if(Admin::where('id',session('admin_id'))->first() != null)
                 $admin = Admin::where('id', session('admin_id'))->first();
        else{
            session()->flush();
            return redirect()->to('login/admin');
        } 
        $password1 = $request->input('password1');
        $password2 = $request->input('password2');
        if($password1 != $password2){
            return back()->with('fail', 'The passwords do not match.');
        }else{
            $table = DB::table('admins')->where('email', $admin->email)->update(['password'=>md5($password1),
            'old_password'=> $this->enc_dec($password1)]);
                return back()->with('success','The pasword is successfully updated');
        }
    }


   public function getMarquee(){
       $message = null;
       $m = Maquee::find(1);
       $message = $m->message;
       return view('admin.admin_marquee', ['message'=>$message]);
   }
   public function getDeleteScrollingText(){
    $message = null;
    $message = Maquee::find(1); 
    if($message == null) return redirect()->to('admin/add/marquee');
    $message->message = null;
    $message->save();
    return redirect()->to('admin/add/marquee')->with('success', 'The scrolling text was successfully deleted.');
   }
   public function postAddMarquee(Request $request){
       $message = trim($request->message);
       if($message == '') return redirect()->to('admin/add/marquee')->with('fail', 'The text enter is empty.');
       $text = null;
       $text = Maquee::find(1);
       if($text != null){
           $text->message = $message;
       }else{
           $text = new Maquee();
           $text->message = $message;
       }
       $text->save();
       return redirect()->to('admin/add/marquee')->with('success', 'The text was success updated');
   }




  // the section that manage other administrators, either by adding or managing them
  //////////////////////////////////////////////////////////////////////////////
  public function getAdminAddAdmin(){
    return view('admin.create_admin');
}

public function postCreateAdmin(Request $request){
     DB::beginTransaction();
    try{
     $sll = [];
    if(!isset($request->edit)){
    $password = Str::random(8, 10);
    $username = $request->email;
    $sll['password'] = $password; 
    $sll['username'] = $username;
    
    $admin = new Admin();
    $admin->name =  $sll['name'] = $request->name;
    $admin->phone = $sll['phone'] = $request->phone;
    $admin->email = $sll['email'] = $request->email;
    $admin->status = 1;
  
    $admin->old_password = $this->enc_dec($password);
    $admin->password = md5($password);
    $admin->save();
    $email = $username;
    try{
   // Mail::to($email)->send(new AdminReset($username, $password));
    }catch(\Exception $e){
        DB::rollBack();
      return $e;
    }

    }else{
        $admin = Admin::find($request->id);
        $admin->name =  $sll['name'] = $request->name;
        $admin->phone = $sll['phone'] = $request->phone;
        $admin->status = 1;
        $admin->save();
        $admin = Admin::find($request->id);
        DB::commit();
        return view('admin.admin_edit', ['admin'=>$admin])->with('success', 'The administrator information was successfully updated');;      
    }

    session(['administrator' => $sll]);
    DB::commit();
    return redirect()->to('admin_created')->with('success', 'The seller was successfully created');
    }catch(\Exception $e){
        DB::rollBack();
        return $e;
    }
}
public function getAdminCreated(){
  return view('admin.admin_successfull_creation');
}

//A function to encrypt and decrypt text characters
public function enc_dec($text){
    $new_t = str_split(trim($text));
    $size = sizeof($new_t);
    $a1 = $a2 = []; $i = 0; $s = $size - 1;
    for(; $i < (int)$size/2 ; $i++){
         $a1[] = $new_t[$i];
         $a2[] = $new_t[$s]; 
         $s--;
    }
    if($size % 2 != 0) array_pop($a1);
   $encry = array_merge(array_reverse($a1), $a2);
   if($size == 2) $encry = array_reverse($new_t);
  return implode($encry);
}



public function  getAdminManageAdmin(){
  $admins = Admin::where('id', '<>', 1)->orderBy('created_at', 'desc')->paginate(10);
  return view('admin.manage_admin', ['admins'=>$admins]);
}


public function getAdminManageAdministrator($status , $id){
  if($status == 'view'){
     $admin = Admin::find($id);
     $password = $this->enc_dec($admin->old_password);
     return view('admin.admin_detail', ['admin'=>$admin, 'password'=>$password]);
  }

  if($status == 'edit'){
    $admin = Admin::find($id);
     return view('admin.admin_edit', ['admin'=>$admin]);  
  }

  if($status == 'suspend'){
     $admin = Admin::find($id);
     $admin->status = 0;
     $admin->save();
  }
  if($status == 'enable'){
     $admin = Admin::find($id);
     $admin->status = 1;
     $admin->save();
 }

  if($status == 'delete'){
     $admin = Admin::find($id);
     $admin->delete();
  }
  $admins = Admin::where('id', '<>', 1)->orderBy('created_at', 'desc')->paginate(10);
  return redirect()->to('admin/manage/admin')->with('success', 'The action performed was successfull.'); 

}

public function getAdminViewAdminSeller(){
 $admins = Admin::where('id', '<>', 1)->orderBy('name', 'asc')->paginate(10);
 return view('admin.admin_sellers', ['admins' => $admins]);
}


public function getAdminAdminSeller($id){
    $sellers = Supplier::where('admin_id', $id)->orderBy('name', 'asc')->get();
    $admin = Admin::find($id);
    return view('admin.admin_personal_seller', ['sellers'=>$sellers, 'admin'=>$admin]);
}


public function getAdminViewSubAdminItems(){
    $admins = Admin::orderBy('name', 'asc')->paginate(10);
    return view('admin.sub_admin_item', ['admins' => $admins]);
}


public function getAdminSubAdminItems($id){
    $items = Item::where('supplier_id',null)->where('admin_id', $id)->orderBy('name', 'asc')->paginate(10);
    $admin = Admin::find($id);
    return view('admin.sub_admin_products', ['admin'=>$admin, 'items'=>$items]);
}

public function getAdminAdminSpecificItem(Request $request, $status , $id, $admin_id){
    if($status == 'view'){
       $item = Item::where('id', $id)->first();
       $items = Item::where('id','<>', $item->id)->where('supplier_id',null)
       ->where('admin_id', $admin_id)->orderBy('updated_at', 'desc')->paginate(12);
       $seller = Admin::find($admin_id);
       $categories = Category::get();
       $features = json_decode($item->features);
       $features_key = json_decode($item->features_key);
       return view('admin.sub_admin_item_detail', ['features'=>$features, 'features_key'=>$features_key,'seller'=>$seller,'item'=>$item, 'items'=>$items, 'categories'=>$categories]);
    }


    if($status == 'delete'){
       $item = Item::find($id);
      // if($item->image1) File::delete($item->image1);
       if($item->image2) File::delete($item->image2);
       if($item->image3) File::delete($item->image3);
       if($item->image4) File::delete($item->image4);
       $item->delete();
       return redirect()->to('admin/view/sub_admin/items')->with('success', 'The action performed was successful');
    }
}

public function getViewAllItems(){
    $items = Item::orderBy('id', 'asc')->paginate(50); 
    return view('admin.admin_all_items', ['items'=>$items]);
}

public function getAdminViewSpecificItem(Request $request, $status , $id){
    if($status == 'view'){
       $item = Item::where('id', $id)->first();
       $items = Item::where('id','<>', $item->id)->orderBy('created_at', 'desc')->paginate(6);
       $features = json_decode($item->features);
       $features_key = json_decode($item->features_key);
       $categories = Category::get();
       return view('admin.admin_item_detail', ['features'=>$features, 'features_key'=>$features_key,'item'=>$item, 'items'=>$items, 'categories'=>$categories]);
    }

    if($status == 'edit'){
       return redirect()->to('admin_update_item/'.$id);
    }

    if($status == 'delete'){
       $item = Item::find($id);
       //if($item->image1) File::delete($item->image1);
       if($item->image2) File::delete($item->image2);
       if($item->image3) File::delete($item->image3);
       if($item->image4) File::delete($item->image4);
       $item->delete();
       return back()->with('success', 'The action performed was successful');
    }
    
}



   ////////////////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////////////////

  
  

   public function getAdminSearch(){
     
       return view('admin.admin_search');
   }

  public function getFindUser(Request $request){
      $user = $request->input('user');
      if(trim($user) == ''){
          return back()->with('fail', 'The search field can not be emtpy.');
      }
      $many = 0;
     
      $present = User::where('user_code', 'like' , '%'.$user.'%')->orderBy('user_code', 'asc')->get();
      if(count($present) == 0){
          $present = User::where('name', 'like' , '%'.$user.'%')->orderBy('user_code', 'asc')->get();
      }
      return view('admin.admin_search', ['present'=>$present]);
  }








   //The portion that load the view of the admin password change view
   public function getAdminPasswordChange(){
    return view('admin.admin_change_password');
}
 
//the function to update the password of the administrator.
//
public function postAdminPasswordChange(Request $request){
   $password1 = $request->input('password1');
   $password2 = $request->input('password2');
   if($password1 != $password2){
       return back()->with('fail', 'The passwords do not match.');
   }else{
       $table = DB::table('admin')->where('username', 'admin@gmail.com')->update(['password'=>md5($password1)]);
           return back()->with('success','The pasword is successfully updated');
   }
}






//////// *****************************************************////////////////////



   

     //Resetting the admin password
     public function getAdminReset(Request $request){
         $email = $request->input('email');
         $adm = DB::table('adm')->where('username', 'administrator')
                                ->where('email', $email)->first();
          if($adm){
              $username = 'administrator';
              $password = str_random(10);
              $savePass = md5($password);
              try{
              //Mail::to('enjiniaolatejualiubabs2013@gmail.com')->send(new AdminReset($username, $password));
               }catch(Exception $e){
              abort(500, 'There is network problem. Please try later');
             }
                  DB::table('adm')->where('username', 'administrator')
                                ->where('email', $email)->update(['password' => $savePass]);
                  return back()->with('success', 'A new password has been sent to your mail.');
             
          }else{
              return back()->with('fail', 'This email does not exist in the system.');
          }
     }



     public function getUpdateInformation(){
        $company = CompanyDetail::find(1);
        return view('admin.information.company_detail' , ['company'=>$company]);
     }

     public function postUpdateInformation(Request $request){

        $company = CompanyDetail::find(1);
        if(!$company) 
          $company = new CompanyDetail();
        $company->name = $request->input('name');
        $company->address1 = $request->input('address1');
        $company->address2 = $request->input('address2');
        $company->phone1 = $request->input('phone1');
        $company->phone2 = $request->input('phone2');
        $company->twitter = $request->input('twitter');
        $company->facebook = $request->input('facebook');
        $company->google = $request->input('google');
        $company->instagram = $request->input('instagram');
        $company->whatsapp = $request->input('whatsapp');
        $company->email = $request->input('email');
        $company->latitude = $request->input('latitude');
        $company->longitude = $request->input('longitude');
      
        $company->save();

        return back()->with('success','The information is successfully updated');
     }


     public function getUpdateGeneralInformation($info){
            $information = GeneralInformation::find(1);
            if($info == 'terms') return view('admin.information.terms', ['info' => $information]);
            if($info == 'shipping') return view('admin.information.shipping', ['info' => $information]);
            if($info == 'about') return view('admin.information.about', ['info' => $information]);
       }

     public function postUpdateGeneralInformation(Request $request){
        $information = GeneralInformation::find(1);

        if(!$information)
             $information =  new GeneralInformation();

         if($request->input('terms') != null && !empty($request->input('terms'))) $information->terms = $request->input('terms');
         if($request->input('about') != null && !empty($request->input('about'))) $information->about = $request->input('about');
         if($request->input('shipping') != null && !empty($request->input('shipping'))) $information->shipping = $request->input('shipping');

         $information->save();
         return back()->with('success', 'The information was successfully updated');
     }

     public function postAdjustItemVisibility(Request $request){
        $item_id =  $request->input('item_id');
        $item = Item::find($item_id);
        if(!$item) return back();
        $visible = $request->input('visibility');
        $quantity = $request->input('quantity');
        if($quantity == null && $visible == null) return back();
        if($visible != null && !empty($visible))  $item->visible = $visible;
        if($quantity != null && !empty($quantity)) $item->quantity = $quantity;
        $item->save();
        return back()->with('success', 'The adjustment was successfully updated');

     }

     public function getViewSubCategoryItems($sub_cat){
         $items = Item::where('sub_category_id', $sub_cat)->orderBy('updated_at', 'desc')->paginate(18);
         $categories = Category::get();
         $sub_cat_name = '';
         if(count($items) > 0)
          $sub_cat_name = $items[0]->sub_category;
         return view('admin.admin_view_sub_items', ['items'=>$items, 'categories'=>$categories, 'sub_cat_name'=>$sub_cat_name]);
     }



}
