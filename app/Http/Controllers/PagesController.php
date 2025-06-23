<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use Illuminate\Support\Facades\Hash;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Item;
use App\Models\ItemDetail;
use App\Models\Admin;
use App\Models\Supplier;
use App\Models\CartSession;
use App\Models\User;
use App\Models\Seller;
use App\Models\Purchase;
use App\Models\DeliveryAddress;
use App\Models\Earning;
use App\Models\BannerImage;
use App\Models\FeaturedImage;
use App\Models\SpecialImage;
use App\Models\Maquee;
use App\Models\Feedback;
use App\Models\CompanyDetail;
use App\Models\GeneralInformation;
use App\Models\BannerAd;

use App\Http\Middleware\GuestMiddleware;
use App\Mail\SendMailBuy;
use App\Mail\SendMailSell;
use App\Mail\Mailing;
use Illuminate\Support\Facades\Mail;



use App\Mail\AdminReset;
use App\Mail\MailAdmin;

class PagesController extends Controller
{
    //

    public function __construct()
    {
      $categories = Category::get();
      $special = null;
      $specials = Item::inRandomOrder()->limit(8)->get();
      $company = CompanyDetail::find(1);
      $information = GeneralInformation::find(1);
      session(['categories'=>$categories, 'specials'=>$specials, 'company'=>$company, 'information'=>$information]);
  
      $this->cartSize();
      $this->totalCost();
    }

   

       // Pages public functions 
       public function getAbout(){
          return view('general.pages.about-us');
     }
     public function getContactInformation(){
         return view('general.pages.contactInformation');
    }
    public function getOrderLookUp(){
     return view('general.pages.order-lookup');
    }

    
    /*
    
    Route::prefix('pages')->group(function(){
    Route::get('about-us', [PagesController::class, 'getAbout']);
    Route::get('contact-us', [PagesController::class, 'getContactUs']);
    Route::get('order-lookup', [PagesController::class, 'getOrderLookUp']);
    
});

Route::prefix('policies')->group(function(){
    Route::get('privacy-policy', [PagesController::class, 'getPrivacyPolicy']);
    Route::get('drop-shipping', [PagesController::class, 'getDropShipping']);
    Route::get('terms-conditions', [PagesController::class, 'getTermConditions']);
    Route::get('refund-policy', [PagesController::class, 'getRefundPolicy']);
    Route::get('shipping-policy', [PagesController::class, 'getShippingPolicy']);
    Route::get('warranty-policy', [PagesController::class, 'getWarrantyReport']);
});

    
    
    */
    
    
    public function getRefundPolicy(){
        return view('general.policies.refundPolicy');
    }

     public function getPrivacyPolicy(){
        return view('general.policies.privacyPolicy');
    }
    
    public function getDropShipping(){
        return view('general.policies.dropShipping');
    }
    
    public function getShippingPolicy(){
        return view('general.policies.shippingPolicy');
    }
    
    public function getWarrantyPolicy(){
        return view('general.policies.warrantyPolicy');
    }
    public function getTermConditions(){
        return view('general.policies.termConditions');
    }
    
    public function toBlank(){
         return redirect()->to('blank');
    }
  
    public function getLogin(){
        return redirect()->to('/');
         //return view('general.page.login');
    }

    public function getSearch(){
         return view('general.search');
    }
    public function postSearch(Request $request){
         $q = $request->q;
    
         if(trim($q) == '') return back();
         $items = Item::Where('sub_category','like', '%'.$q.'%')
                   ->orWhere('category','like', '%'.$q.'%')
                        ->orWhere('name','like', '%'.$q.'%') 
                        ->inRandomOrder()->simplePaginate(24);
        return view('general.collections.display-products', ['items'=>$items]);
    }

     // Collection public functions 
    public function getBestSelling(){
        $items = Item::inRandomOrder()->paginate(24);
      return view('general.collections.display-products', ['items'=>$items]); 
    }

    public function getLatestProducts(){
        $items = Item::orderBy('id', 'desc')->paginate(24);
     return view('general.collections.display-products', ['items'=>$items]); 
   }
    
   public function getComputerComponents(){
    $items = Item::where('category', 'computer Components')->orderBy('id', 'desc')->paginate(24);
      return view('general.collections.display-products', ['items'=>$items]);
   }

    public function getAllProducts(){
        $items = Item::inRandomOrder()->paginate(24);
         return view('general.collections.display-products', ['items'=>$items]);
    }


   public function getLaptops(){
     $items = Item::where('category', 'laptop')->orderBy('id', 'desc')->paginate(24);
      return view('general.collections.display-products', ['items'=>$items]);
   }

   public function getDesktopAllInOne(){
    $items = Item::where('category', 'desktop')->orderBy('id', 'desc')->paginate(24);
      return view('general.collections.display-products', ['items'=>$items]);
   }

   public function getAccessories(){
    $items = Item::where('category', 'accessories')->orderBy('id', 'desc')->paginate(24);
    return view('general.collections.display-products', ['items'=>$items]);
 }

   public function getPhonesTablets(){
    $items = Item::where('category', 'Phones & Tablets')->orderBy('id', 'desc')->paginate(24);
      return view('general.collections.display-products', ['items'=>$items]);
   }

   public function getSingleProduct($category, $id){
      $item = Item::where('id', $id)->first();
      return view('general.products.single-product', ['item'=>$item]);
   }



  
   public function refreshCategories(){
     if(session('categories') != null) session()->forget('categories');
     if(session('specials') != null) session()->forget('specials');
     $categories = Category::get();
     $special = null;
     $specials = Item::inRandomOrder()->limit(8)->get();
     $index_specials = Item::inRandomOrder()->limit(8)->get();
     session(['categories' => $categories, 'specials'=>$specials, 'index_specials' => $index_specials]);
 
     $this->cartSize();
     $this->totalCost();
   }
 
   public function getIndex(){
     $this->refreshCategories();
  
     $banners = BannerImage::inRandomOrder()->limit(2)->get();
     $featureds = FeaturedImage::inRandomOrder()->limit(3)->get(); 
     $banner_ads = BannerAd::inRandomOrder()->limit(20)->get();
     $categories = Category::get();                 
     $index_specials = Item::inRandomOrder()->limit(9)->get();
 
    // $items = Item::where('quantity','<>', 0)->inRandomOrder()->simplePaginate(60);
     $items = Item::where('quantity', '<>', 0)->orderBy('updated_at', 'desc')->get();
     $latest = Item::orderBy('updated_at','desc')->limit(20)->get();
     $message = null;
     $m = Maquee::find(1);
     $message = $m->message; 
     
     return view('general.index', [
         'index_specials'=> $index_specials, 
         'banner_ads'=>$banner_ads, 
         'message'=>$message,
         'items'=>$items,
          'banners'=>$banners, 
          'featureds'=>$featureds,
          'categories' => $categories,
          'latest' => $latest,
         ]);
   }
 
    public function getProductNames(Request $request){
          $name = $request->name; 
          $names = Item::where('name', 'like', '%'.$name.'%')->distinct('name')->pluck('name');
          return  $names;
     }
  
 public function getProductName(Request $request, $name=null){
      $item = null;
     if($name){
         $item = Item::where('name', $name)->first();
         $items = Item::where('sub_category_id', $item->sub_category_id)->inRandomOrder()->simplePaginate(60);
       }else{
         $name = $request->name;
        $items = Item::where('name', 'like', '%'.$name.'%')->inRandomOrder()->simplePaginate(60);
      }
      return view('general.related_products', ['item'=>$item, 'items'=>$items]);
  }
 
   
 
       public function getSingleProductDetails(Request $request ,$status, $id, $title=null){
         $item = $items = null;
         $categories = Category::get();
         if($status == 'view'){
            $item = Item::where('id', $id)->first();
            if($item == null) return back()->with('fail', 'The product you are looking for is no longer available.');
            $features = json_decode($item->features);
            $features_key = json_decode($item->features_key);
            $item->views = $item->views + 1;
            $item->save();
            $items = Item::where('sub_category_id', $item->sub_category_id)->where('quantity','<>', 0)->where('id','<>', $item->id)->inRandomOrder()->paginate(12);
            return view('general.products.product_details', ['item'=>$item, 'features'=>$features, 'features_key'=>$features_key,'items'=>$items, 'categories'=>$categories]);
         }
         if($status == 'add'){
             $item = Item::where('id', $id)->first();
             $item_id = $id;
             if(session('buyer_session') == null){
             $buyer_session = uniqid(30);
             $product_no = rand(100000000, (int)9699906999) + rand(1001, (int)1001001) + 101;
             session(['buyer_session' => $buyer_session]);
             session(['product_no' => $product_no]);
             $cart = [];
             session([session('buyer_session') => $cart]);
             }
               if(session($item_id."_item")  != $item_id){
                   session([$item_id."_item" => $item_id]);
                   
                 $item_id = session($item_id."_item");
                 $cart =  session(session('buyer_session'));
                 $cart[$item_id]['session_id'] = session('buyer_session');
                 $cart[$item_id]['item_id'] = $item->id;
                 $cart[$item_id]['maxQty'] = $item->quantity;
                 $cart[$item_id]['item'] = $item;
                 $cart[$item_id]['price'] = $item->new_price;
                 $cart[$item_id]['company'] = $item->company;
                 $cart[$item_id]['contact'] = $item->contact;
                 $cart[$item_id]['image'] = $item->image1;
                 $cart[$item_id]['name'] = $item->name;
                 $cart[$item_id]['quantity'] = 1;
                 $cart[$item_id]['product_no'] = session('product_no');
                 session([session('buyer_session') => $cart]);    
         }else {
                 $item_id = session($item_id."_item"); 
                 $cart =  session(session('buyer_session'));
                 if( $cart[$item_id]['quantity'] <=  $item->quantity){ 
                 $cart[$item_id]['quantity'] += 1;
                 session([session('buyer_session') => $cart]);
                 }  
             }
         $this->cartSize();
         $this->totalCost();
        // return  back(); //redirect()->to('view_cart');      
         }
 
         if($status == 'delete'){
             $item_id = $id;
             session()->forget($item_id."_item");
             $cart =  session(session('buyer_session'));
            unset($cart[$item_id]);
            session([session('buyer_session') => $cart]);
 
             $this->cartSize();
             $this->totalCost();
             //return redirect()->to('view_cart'); 
             return back();
         }
         $this->cartSize();
         $this->totalCost();
        return back();
        
      }

      public function postAddCart(Request $request){
                $id = $request->item_id;
                $item = Item::where('id', $id)->first();
                $quantity = $request->quantity;
                $item_id = $id;
              
                if(session('buyer_session') == null){
                      
                    $buyer_session = uniqid(30);
                    $product_no = rand(100000000, (int)9699906999) + rand(1001, (int)1001001) + 101;
                    $product_no += $item_id;
                    session(['buyer_session' => $buyer_session]);
                    session(['product_no' => $product_no]);
                    $cart = [];
                    session([session('buyer_session') => $cart]);
                    }
               if(session($item_id."_item")  != $item_id){
                    session([$item_id."_item" => $item_id]);
                        
                      $item_id = session($item_id."_item");
                      $cart =  session(session('buyer_session'));
                      $cart[$item_id]['session_id'] = session('buyer_session');
                      $cart[$item_id]['item_id'] = $item->id;
                      $cart[$item_id]['maxQty'] = $item->quantity;
                      $cart[$item_id]['item'] = $item;
                      $cart[$item_id]['price'] = $item->new_price;
                      $cart[$item_id]['old_price'] = $item->old_price;
                      $cart[$item_id]['contact'] = $item->contact;
                      $cart[$item_id]['image'] = $item->image1;
                      $cart[$item_id]['name'] = $item->name;
                      $cart[$item_id]['quantity'] = 1;
                      $cart[$item_id]['product_no'] = session('product_no');
                      session([session('buyer_session') => $cart]);    
                }else {
                      $item_id = session($item_id."_item"); 
                      $cart =  session(session('buyer_session'));
                      if( $cart[$item_id]['quantity'] <=  $item->quantity){ 
                      $cart[$item_id]['quantity'] += 1;
                      session([session('buyer_session') => $cart]);
                      }  
                  }
              $this->cartSize();
              $this->totalCost();

              return redirect()->to($request->product_url);

      }
      
       public function getUpdateCart($item_id, $quantity, $session_id){
         
             if($session_id == null ){
            return -1;
         }
                 $cart =  session($session_id); 
                 $cart[$item_id]['quantity'] = $quantity;
                 session([$session_id => $cart]);
                 
          
         $this->cartSize();
         $this->totalCost();
         return 0;      
       }
 
      public function cartSize(){
         $count = 0;
         if(session('buyer_session') != null ){
         $cart =  session(session('buyer_session'));
         if(count($cart) > 0){
             foreach($cart as $k => $va){
                  $count += $cart[$k]['quantity'];
             }
           }
         }
         session(['cartSize' => $count]);
      }
 
      public function totalCost(){
         $cost = 0;
         if(session('buyer_session') != null){
         $cart =  session(session('buyer_session'));
         if(count($cart) > 0){
             foreach($cart as $k => $va){
                  $cost += $cart[$k]['quantity'] * $cart[$k]['price'];
             }
           }
         }
        session(['totalCost'=>$cost]);
      }
 
      public function removeItem(){
         if($status == 'remove'){
             $item = Item::where('id', $id)->first();
             $item_id = $id;
             if(session('buyer_session') == null){
            return redirect()->to('/');
         }
             if(session($item_id."_item") != $item_id){
                 session([$item_id."_item" => $item_id]);
                 $item_id = session($item_id."_item");
                 $cart =  session(session('buyer_session'));
                 $cart[$item_id]['quantity'] -= 1;
                 session([session('buyer_session') => $cart]);
             }
         $this->cartSize();
         $this->totalCost();
         return redirect()->to('view_cart');  
          
         }
         return back();
      }
 
      
      public function getViewCart(){
         $this->cartSize();
         return view('general.cart'); 
      }
 
      public function getCheckOut(){
         if(!session()->exists('user')){
             return redirect()->to('login_page');
         }
          return view('general.check_out');
      }
  
      public function postModeOfPayment(Request $request){
         try{
          $mode = $request->input('payment');
          $this->postDeliveryAddress($request);
 
          if($mode == 'delivery'){
              session(['mode_of_payment' => 'Payment On Delivery']);
              if(session('account') != null) session()->forget('account');
             return redirect()->to('delivery_address');
          }else if($mode == 'account'){
             session(['mode_of_payment' => 'Pay To Account']);
             return redirect()->to('pay_to_account');
          }else{
             session(['mode_of_payment' => 'Online Payment']);
             if(session('account') != null) session()->forget('account');
             return redirect()->to('online_payment');
          }
         }catch(\Exception $e){
             return back()->with('fail', 'An error was encountered.');
         }
      }
 
      public function  getOnlinePayment(){
          return view('general.online_payment');
      }
 
      public function  getPayToAccount(){
         return view('general.pay_to_account');
     }
 
      public function getDeliveryAddress(){
          return view('general.delivery_address');
      }
 
      public function getConfirmProductOrder(){
          return $this->getFinalSubmit();
      }
      
      public function postDeliveryAddress(Request $request){
  
                //$user_id = session('user')[0]['id'];
                //session('user')->id;
               
                $address = [];
                $address['email'] = $request->input('email');
                $address['name'] = $request->input('name');
                $address['state'] = $request->input('state');
                $address['city'] = $request->input('city');
                $address['address'] = $request->input('address');
                $address['phone'] = $request->input('phone');
                $address['mode_of_payment'] = $request->input('payment');
               
                $userData = [];
                $user = null;
                if($request->input('create-account')){
                   $userData['email'] = $request->input('username');
                   $userData['name'] = $request->input('name');
                   $userData['phone'] = $request->input('phone');
                   $userData['password'] = $request->input('password');
                  $user = $this->createUser($userData);
                  if(!session()->exists('user')){
                     session()->push('user', $user);
                  }
                }
                if($user)
                    $address['user_id'] = $user->id; 
                session(['del_addr' => $address, 'user_data'=>$userData]);
                    
            // return  view('general.transaction');
      }
 
      public function createUser(array $data){
       return  User::create([
             'name' => $data['name'],
             'email' => $data['email'],
             'phone' => $data['phone'],
             'password' => Hash::make($data['password']),
         ]);
      }
 
      public function getFinalSubmit(){
          if(!session()->exists('user') || session('buyer_session') == null){
             return redirect()->to('login_page');
          }else{
              DB::beginTransaction();
                $user_id = session('user')[0]['id'];
             try{
                 $add =  session('del_addr');
                 $cart =  session(session('buyer_session'));
                
              if(session('buyer_session') != null){
                 $user = User::find($user_id);
 
                 $address = new DeliveryAddress();
                 $address->user_id = $user_id;
                 $address->city = $add['city']; 
                 $address->name = $add['name'];
                 $address->state = $add['state'];
                 $address->email = $add['email'];
                 $address->phone = $add['phone'];
                 $address->transaction_id = session('product_no');
                 $address->address = $add['address'];
                  
                 $user->deliveryAddress()->save($address);
                  $admins_id = $suppliers_id = []; $transaction_no;
                 if(sizeof($cart) > 0){
                     foreach($cart as $k => $va){
                          $purchase = new Purchase();
                          $item_id = $cart[$k]['item_id'];
                          $item = Item::find($item_id);
                          $purchase->admin_id = $admins_id [] = $item->admin_id;
                          $purchase->user_id = $user_id;
                          $purchase->item_id = $item_id;
                          $purchase->mode_of_payment = session('mode_of_payment');
                          $purchase->transaction_id = $transaction_no = $cart[$k]['product_no'];
                          $purchase->quantity = $cart[$k]['quantity'];
                          $purchase->price = $cart[$k]['price'];
                          $purchase->total = $cart[$k]['quantity'] * $cart[$k]['price'];
                          $purchase->name = $cart[$k]['name'];
                          $purchase->image =  $cart[$k]['image'];
                          $purchase->company = $cart[$k]['company'];
                          $purchase->contact = $cart[$k]['contact'];
                          $user->purchase()->save($purchase);
                          session(['transaction_no'=>$transaction_no ]);
 
                     }
                   }
                      
             }
             $user = User::where('id',$user_id)->first();
        
             try{
                
                 if(count($admins_id) > 0){
                     $admins = $this->unique($admins_id);
                     foreach($admins as $id){
                        $admin = Admin::find($id);
                        if($admin != null && $id != 1){
                           $carts = $this->cart('admin_id', $id, $transaction_no);
                          // Mail::to($admin->email)->send(new SendMailSell($carts, $user, $add));  
                        }
                     }
                   }
                  // Mail::to($user->email)->send(new SendMailSell($cart, $user, $add));
                   $admin1 = Admin::find(1);
                  // Mail::to($admin1->email)->send(new SendMailSell($cart, $user, $add));
                  
              }catch(Exception $e){
             // return $e;
              // abort(500, 'There is network problem. Please try later');
              }
              DB::commit(); 
              $userDetail = session('user')[0];
              $mode = null;
              if(session('mode_of_payment') == 'Pay To Account') $mode = 'Pay To Account';
              
              session()->forget([session('buyer_session'), 'product_no']);
              session(['buyer_session' => null, 'totalCost' => 0, 'cartSize'=> 0]);
              return redirect()->to('getCongrat');  
             }catch(\Exception $e){
              DB::rollBack();
              return $e;
             }
          }
      }
 
      public function getCongrat(){
          $mode = null;
          if(session()->exists('transaction_no')){
           $trns_id = session('transaction_no');
          }
           $transactions = Purchase::where('transaction_id', $trns_id)->get();
           $address = DeliveryAddress::where('transaction_id', $trns_id)->first();
         return view('general.congratulation', ['mode' => $mode, 'transaction_id'=>$trns_id, 'transactions'=>$transactions, 'address'=>$address]); 
      }
 
      public function unique($array){
          $collection = collect($array);
          $unique = $collection->unique();
          return $unique->values()->all();
      }
 
      public function cart($admin_supplier_id, $id, $prd_no){
         $items = Purchase::where($admin_supplier_id, $id)->where('transaction_id', $prd_no)->get();
         $cart = [];
         foreach($items as $item){
         $k = $item->item_id;
         $cart[$k]['item_id'] = $item->item_id;
         $cart[$k]['product_no'] = $item->transaction_id;
         $cart[$k]['quantity'] = $item->quantity;
         $cart[$k]['price'] = $item->price;
         $cart[$k]['name'] = $item->name;
         $cart[$k]['image'] = $item->image;
         $cart[$k]['company'] = $item->company;
         $cart[$k]['contact'] = $item->contact;
         }
         return $cart;
      }
 
 
   
      public function getUserLogin(){
          return view('general.user_login');
      }
 
      public function getUserReset(){
          return view('general.passwordreset');
      }
 
      public function getAccount(){
         if(!session()->exists('user')) return redirect()->to('signup');
         return view('general.account');
      }
 
      public function postUserReset(Request $request){
          if(!session()->exists('user')) 
             return back()->with('fail','Please, login first. Your are currently logged out');
     if(User::where('email', session('user')->email)->first() == null){
    session()->flush();
    return back()->with('fail','Please, login first. Your are currently logged out');   
 } 
 $password1 = $request->input('password1');
 $password2 = $request->input('password2');
 if($password1 != $password2){
    return back()->with('fail', 'The passwords do not match.');
 }else{
    $table = DB::table('users')->where('email', session('user')->email)->update(['password'=>md5($password1), 'old_password'=>enc_dec($password1)]);
        return back()->with('success','The pasword is successfully updated');
    }
 }
 
      public function postUerPasswordReset(Request $request){
          $email = $request->input('email');
          if(User::where('email', $email)->first() == null){
              return back()->with('fail','The email you provided does not exist in our system.');
          }
          try{
          $user = User::where('email', $email)->first();
          $password = str_random(10);
          $user->password = md5($password); 
          Mail::to($email)->send(new AdminReset($email, $password));
         $user->save();
          }catch(\Exception $e){
              return back()->with('fail', 'Please,try again later. A technical issue occurs.');
          }
          return back()->with('success', 'Check your email, we have sent you a mail for your password reset');
      }
 
      // A function to post message to the respective owner of the email under 'to'
      public function postSendMailing(Request $request){
         $info = [];
         $body = $request->message; 
         $subject = $request->subject;
         $to = trim($request->to_email);
         $info['from'] =  trim($request->from_email); 
         $info['name'] = $request->name;
         $info['body'] = $body; 
         $info['subject'] = $subject; 
         $info['admin_id'] = 0;
         try{   
         Mail::to($to)->send(new MailAdmin($info)); 
         return back()->with('success', 'The message was successfully sent.');
         }catch(\Exception $e){
             return back()->with('fail', 'The message fail.');
         }
     }
   
     public function getUserHistory(){
         if(!session()->exists('user')){
             return redirect()->to('login_page');
         }
         $solds = Purchase::where('user_id', (session('user')[0])->id)->orderBy('created_at', 'desc')->simplePaginate(10); 
         return view('general.history', ['solds'=>$solds]);
     }
 
    public function getCancelItem($id){
        $purchase = Purchase::find($id);
        $purchase->status = 2;
        $purchase->save();
        return back()->with('success', 'The item ordered has been cancelled successfully');
    }
 
 
      public function getLoginPage(){
          return view('general.signup');
      }
 
      public function getLegal(){
         return view('general.legal');
     }
     public function getTac(){
         return view('general.tac');
     }
 
     public function getFaq(){
         return view('general.faq');
     }
 
     public function getItemViewCategory($catg_id = null){ 
         $items =  null;
         if($catg_id != null){
           $category = Category::find($catg_id);
           if(!$category) return back();
            $items = Item::where('category', $category->name)->where('quantity','<>', 0)->inRandomOrder()->simplePaginate(30);
            if($items == null) 
            $items = Item::where('quantity','<>', 0)->inRandomOrder()->simplePaginate(30);
         }else{
             $items = Item::where('quantity','<>', 0)->inRandomOrder()->simplePaginate(30);
         }
          $featureds = FeaturedImage::inRandomOrder()->limit(16)->get();
          if(count($featureds) < 1)  $featureds = Item::inRandomOrder()->limit(16)->get();
          $banner_ads = DB::table('banner_ads')->inRandomOrder()->limit(20)->get();              
          $index_specials = Item::inRandomOrder()->limit(9)->get();
          
         return view('general.shop', ['items'=>$items, 'banner_ads'=>$banner_ads, 'index_specials' => $index_specials, 'featureds'=>$featureds]);
     }
 
      public function getProduct_summary(){
       return view('general.product_summary');
      }
 
 
      public function getSpecial_offer(){
       $featureds = FeaturedImage::inRandomOrder()->orderBy('updated_at' , 'desc')->paginate(30);
       
       return view('general.special_offer',['items'=>$featureds]);
      }
      public function getSignup(){
       return view('general.createAccount');
      }
 
      public function getForgetPassword(){
          return view('general.reset_password');
      }
 
      public function postRegisterUser(Request $request){
           if($request->password1 != $request->password2)
           return back()->with('fail', 'The passwords you enter do match');
           $user = User::where('email', $request->email1 )->first();
           if($user) return back()->with('fail', 'The email you entered already exists in our system.');
           try{
           $user = new User();
           $user->name = $request->name;
          // $user->phone = $request->phone;
           $user->email = $request->email;
           $user->password = md5($request->password1);
           $user->save();
           $user = User::where('email', $request->email)->where('password', md5($request->password1))->first();
           if($user) $request->session()->push('user', $user);
           
           return redirect()->to('account');
           }catch(\Exception $e){
               return back()->with('fail', 'There was a server internal error.');
           }
      }
 
 
      public function getUserLogout(){
          if(session()->setExists('user')){
              session()->forget('user');
          }
          session()->flush();
          return redirect()->to('/');
      }
 
 
 
   public function getItemViewSubCategory($sub_catg_id = null){ 
     $items =  null;
     if($sub_catg_id != null){
        $items = Item::where('sub_category_id', $sub_catg_id)->where('quantity','<>', 0)->inRandomOrder()->simplePaginate(30);
        if($items == null) 
        $items = Item::where('quantity','<>', 0)->inRandomOrder()->simplePaginate(30);
     }else{
         $items = Item::where('quantity','<>', 0)->inRandomOrder()->simplePaginate(30);
     }
      $featureds = FeaturedImage::inRandomOrder()->limit(16)->get();
      if(count($featureds) < 1)  $featureds = Item::inRandomOrder()->limit(16)->get();
      $banner_ads = DB::table('banner_ads')->inRandomOrder()->limit(20)->get();              
      $index_specials = Item::inRandomOrder()->limit(9)->get();
      
     return view('general.sub-category', ['items'=>$items, 'banner_ads'=>$banner_ads, 'index_specials' => $index_specials, 'featureds'=>$featureds]);
 }
 
 
 
 public function getSearchContent(Request $request){
        
        if(session()->exists('it') && session()->exists('ctg')){
         $it = (session('it'));
         $category = session('ctg');
        }else{
         $it = 'all';
         $category = 'all';
        }
   
     if($category == 'all' && ($it == null || $it == 'all')){
         $items = Item::inRandomOrder()->simplePaginate(60);
     }else if($category != 'all' && ($it == null || $it == 'all')){
         $items = Item::where('category', $category)->inRandomOrder()->simplePaginate(60); 
     }else if($category != 'all' && ($it != null || $it != 'all')){
         $items = Item::where('category', $category)
                         ->Where('sub_category','like', '%'.$it.'%')
                         ->orWhere('name','like', '%'.$it.'%')
                         ->orWhere('item_type','like', '%'.$it.'%')
                         ->inRandomOrder()->simplePaginate(60);
     }else if($category == 'all' && ($it != null || $it != 'all')){
         $items = Item::where('category', $category)
                         ->Where('sub_category','like', '%'.$it.'%')
                         ->orWhere('name','like', '%'.$it.'%')
                         ->orWhere('item_type','like', '%'.$it.'%')
                         ->orWhere('description','like', '%'.$it.'%')
                         ->orWhere('company','like', '%'.$it.'%')
                         ->orWhere('contact','like', '%'.$it.'%')
                         ->orWhere('new_price','like', '%'.$it.'%')
                         ->orWhere('state','like', '%'.$it.'%')
                         ->orWhere('city','like', '%'.$it.'%')
                         ->inRandomOrder()->simplePaginate(60);
     }else {
         $itmes = null;
     }
 
    // $featureds = FeaturedImage::inRandomOrder()->limit(16)->get();
     $featureds = Item::orderBy('updated_at', 'desc')->limit(16)->get();
     return view('general.search', ['items'=>$items, 'featureds'=>$featureds]);
 }
 
 public function postSearchContent(Request $req){
     session(['it' => $req->item, 'ctg'=>$req->category]);
     return redirect()->to('search'); 
 }
 
 public function postLoginMe(Request $request){
            $user = User::where('email', $request->email )->where('password', md5($request->password))->first();
             if($user){
             $request->session()->push('user', $user);
            // return redirect()->to('view_cart'); 
         return redirect()->to('account');
             }else{
                 return back()->with('fail', 'You have fail to login.'); 
             }
        }
 
 
    public function getBecomeSeller(){
        return view('general.become_seller');
    }
 
 
    public function postSelfSellerCreation(Request $request){
       DB::beginTransaction();    
     try{
      $sll = []; $admin = null;
     
         
             if($request->email != $request->email1)
         return back()->with('fail', 'The email you enter do not match');
         
          if($request->password1 != $request->password2)
         return back()->with('fail', 'The password you enter do not match');
         
           if(trim($request->company) == ''){
             return back()->with('fail', 'The business name cannot be empty.');
         }
         
         if(Supplier::where('company', $request->company)->exists()){
             return back()->with('fail', 'The business name you entered already exist in the system. Please try another business name.');
         }
               
         
         if(Supplier::where('email', $request->email)->exists()){
             return back()->with('fail', 'The email you entered already exist in the system. Please try another email address.');
         }
 
       
         $seller = new Supplier();
         
        if(isset($request->admin_email)){
         if(Admin::where('email', $request->admin_email)->exists())
           $admin = Admin::where('email', $request->admin_email)->first();
             if($admin == null)  return back()->with('fail', 'The Administrator or Agent email you enter does not exist.');
             $seller->referral = 2;
             if(trim($request->admin_email) == 'support@vnaira.com')
                 $seller->referral = 1;
         } 
 
     $password = $request->password1;
     $username = $request->email;
     $sll['password'] = $password; 
     $sll['username'] = $username;
     
    
     $seller->name =  $sll['name'] = $request->name;
     $seller->address =  $sll['address'] = $request->address;
     $seller->title = $sll['title'] = $request->title;
     $seller->company = $sll['company'] = $request->company;
     $seller->state = $sll['state'] = $request->ostate;
     $seller->information = $sll['information'] = $request->information;
     $seller->phone = $sll['phone'] = $request->phone;
     $seller->email = $sll['email'] = $request->email;
     $seller->status = 0;
     $seller->password = md5($password);
     $seller->old_password = $this->enc_dec($password);
      
     if($admin == null){
        $admin = Admin::find(1);
        $seller->referral = 0;
     }
    
     $admin->suppliers()->save($seller);
     
    
       $history = Supplier::where('email', $request->email)->first();
     if($history){
         DB::table('supplier_history')->insert([
             'supplier_id' => $history->id,
             'email' => $request->email,
             'name' =>  $request->name,
             'address' =>  $request->address,
             'title' => $request->title,
             'company' =>  $request->company,
             'state' =>  $request->ostate,
             'information' =>  $request->information,
             'phone' =>  $request->phone,
             ]);
     }
    
     DB::commit();
     return view('general.seller_created')->with('success','The seller was successfully created');
     }catch(\Exception $e){
         DB::rollBack();
         return $e;
         return back()->with('fail', 'There was a problem.. please, try again later.');
     }
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
 
 
   public function getCompanyProduct($company){
     
       
     $this->refreshCategories();
     $link = '@/'.$company;
     $company = str_replace(['+','_'], ' ', $company);
     $message = null;
     $m = Maquee::find(1);
     $message = $m->message;
     $company_name = $company;
     $supplier = Supplier::where('company','like',  '%'.$company.'%')->first();
     $comp = Item::where('company','like',  '%'.$company.'%')->first();
     if($comp) $company_name = $comp->company;                 
         $featureds = Item::Where('company','like', '%'.$company.'%')
                        ->orWhere('contact','like', '%'.$company.'%')
                        ->orderBy('updated_at', 'desc')->limit(16)->get();
                        
        $banner = DB::table('banner_ad')->Where('business_link', $link)->first();                
        $items = Item::Where('company','like', '%'.$company.'%')
                        ->orWhere('contact','like', '%'.$company.'%')
                        ->orderBy('updated_at', 'desc')->simplePaginate(40);                   
      return view('general.company_product', ['supplier'=>$supplier, 'company_name' => $company_name,'message'=>$message ,'items'=>$items, 'banner'=>$banner, 'featureds'=>$featureds]);
   
   }
 
 public function getBlankIndex(){
     $this->refreshCategories();
     $top_specials = SpecialImage::inRandomOrder()->limit(2)->get();
     $top_features = FeaturedImage::inRandomOrder()->limit(2)->get();
     $banners = BannerImage::inRandomOrder()->limit(2)->get();
    
     $featureds = Item::inRandomOrder()->limit(16)->get();
     $banner_ads = DB::table('banner_ad')->inRandomOrder()->limit(6)->get();
     $items = Item::where('quantity','<>', 0)->inRandomOrder()->orderBy('updated_at', 'desc')->paginate(30);
     $message = null;
     $m = Maquee::find(1);
     $message = $m->message;
     
     return view('general.blank_index', ['banner_ads'=>$banner_ads, 'top_features'=>$top_features ,'top_specials'=>$top_specials , 'message'=>$message ,'items'=>$items, 'banners'=>$banners, 'featureds'=>$featureds]);
   }
 
   public function postFeedback(Request $req){
      $feedback = Feedback::create([
         'product_id' => $req->product_id,
         'author' => $req->author,
         'comment' => $req->comment,
         'email' => $req->email,
         'like' => $req->like,
      ]);
      return back();
   }
 
 
 
 
 
 
 
 
 
  //////////////////////////////////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////////////////////////////
   //the  administrator login is taken care of here. If the login is successful
   // a session is created for the admin for the login.
    public function getAdminLogin(Request $request){
        $username = $request->input('username');
        $password = md5($request->input('password'));
       try{
        if(DB::table('admins')->where('password', $password)->where('email', $username)->where('status',1)->count()==1){
             $admin = DB::table('admins')->where('password', $password)->first();
             $categories = Category::get();
             session(['admin'=>'login', 'admin_id'=>$admin->id, 'categories'=>$categories]);
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
     /*  $data = DB::table('periods')->join('users', 'users.user_code', '=', 'periods.user_code')
       ->select('users.name as name', 'periods.*')
       ->where('periods.status', '=', 0)
       ->orderBy('periods.created_at', 'desc')->get();
       */
       $data = null;
        return view('admin.a_dashboard', ['data'=>$data]);
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
       return view('admin.admin_edit_item', ['item'=>$item, 'items'=>$items, 'type'=>$type]);
      
   }
 
 
 
   public function getAdminAddProduct(){
       $categories = Category::get();
       return view('admin.admin_add_item', ['categories'=>$categories]);
   }
  
    public function getSubCategory(Request $request, $id){
     $sub_catg = SubCategory::where('category_id', $id)->orderBy('name','asc')->pluck('name');
      return   json_encode($sub_catg);
    }
    
 
 
 
    public function getAdminItemDetail($sub_catg_id = null){
        $item = $items = $category = null;
        $find = true;
        if($sub_catg_id != null){
           //return $sub_catg_id."Hlleo";
           $item = Item::where('admin_id', session('admin_id'))->where('sub_category_id', $sub_catg_id)->inRandomOrder()->first();
           if($item == null) $find = false;
           else
           $items = Item::where('admin_id', session('admin_id'))->where('sub_category_id', $sub_catg_id)->where('id','<>', $item->id)->orderBy('created_at', 'desc')->paginate(3);
           
        }else{
        $item = Item::where('admin_id', session('admin_id'))->inRandomOrder()->limit(1)->first();
        if($item == null) $find = false;
        else
        $items = Item::where('admin_id', session('admin_id'))->where('sub_category_id', $item->sub_category_id)->where('id','<>', $item->id)->orderBy('created_at', 'desc')->paginate(3);
        }
        $categories = Category::get();
        if(!$find)  $item = $items = $category = null;
 
        return view('admin.admin_item_detail', ['item'=>$item, 'items'=>$items, 'categories'=>$categories]);
    }
 
    public function postAdminSearchContent(Request $request){
        $it = $request->item;
        $category = $request->category;
        $find = true;
        if($category == 'all'){
           $item = Item::where('admin_id', session('admin_id'))  
                                   ->Where('name','like', '%'.$it.'%')
                                  ->orWhere('sub_category','like', '%'.$it.'%')
                                  ->inRandomOrder()->first();
       
       if($item == null){
               $item = Item::where('admin_id', session('admin_id'))->inRandomOrder()->limit(1)->first();
               $find = false;
           }     
        }else{
        $item = Item::where('admin_id', session('admin_id'))
                               ->Where('name','like', '%'.$it.'%')
                               ->orWhere('sub_category','like', '%'.$it.'%')
                               ->where('category','like', '%'.$category.'%')
                               ->inRandomOrder()
                               ->limit(1)->first();
     if($item == null){
       $item = Item::where('admin_id', session('admin_id'))->inRandomOrder()->limit(1)->first();
       $find = false;
       }  
      $items = Item::where('admin_id', session('admin_id'))->where('sub_category_id', $item->sub_category_id)->where('id','<>', $item->id)->orderBy('created_at', 'desc')->paginate(3);
       
        }
 
        $items = Item::where('admin_id', session('admin_id'))->where('sub_category_id', $item->sub_category_id)->where('id','<>', $item->id)->orderBy('created_at', 'desc')->paginate(3);
        $categories = Category::get();
       
        if(!$find)
        return view('admin.admin_item_detail', ['item'=>$item, 'items'=>$items, 'categories'=>$categories])->with('fail', 'We did not find what you are looking for, but find something that migth interest you.');
        else
        return view('admin.admin_item_detail', ['item'=>$item, 'items'=>$items, 'categories'=>$categories]);
  
    }
 
    public function getAdminSpecificItem(Request $request, $status , $id){
        if($status == 'view'){
           $item = Item::where('admin_id', session('admin_id'))->where('id', $id)->first();
           $items = Item::where('admin_id', session('admin_id'))->where('id','<>', $item->id)->orderBy('created_at', 'desc')->paginate(3);
           
           $categories = Category::get();
           return view('admin.admin_item_detail', ['item'=>$item, 'items'=>$items, 'categories'=>$categories]);
        }
 
        if($status == 'edit'){
           return redirect()->to('admin_update_item/'.$id);
        }
        if($status == 'delete'){
           $item = Item::find($id);
           $item->delete();
           return redirect()->to('admin_view_item_detail')->with('success', 'The action performed was successful');
        }
        
    }
 
     public function getAdminUpdateItem($id){
       $item = Item::find($id);
       $categories = Category::get();
       return view('admin.admin_update_item',['item'=>$item, 'categories'=>$categories]);
     }
 
     public function getSubCategory1(Request $request, $id){
       $sub_catg = SubCategory::where('category_id', $id)->orderBy('name','asc')->pluck('name');
        return   json_encode($sub_catg);
      }


}
