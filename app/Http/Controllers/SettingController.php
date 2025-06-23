<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use App\Models\Bank;
use App\Models\Doc;
use Auth;


class SettingController extends Controller
{           
  
    public function __construct()
    {
        $this->middleware('auth');
    }

    //To the change the user profile
    public function getChangeProfile(Request $request){
        //validate the image
         $this->validate($request, [
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    
        $id = $request->input('user_id');
        $address = $request->input('address');
          //the image upload is treated here with care
       if($request->hasFile('image')){
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('imageUpload'), $imageName);
       //Save the uploaded image into the database
       $img = 'imageUpload/'.$imageName;
       } 
       if(isset($img))
         DB::table('users')->where('id', $id)->update(['address'=>$address, 'image'=>$img]);
           else
       DB::table('users')->where('id', $id)->update(['address'=>$address]);
        return back()->with('success', 'Profile successfully updated');
    }

    //Here we upload the document of the user
    // Documents are save as the are submit
    public function getSubmitDocument(Request $request){
        //validate the image
         $this->validate($request, [
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
        $doc = new Doc();
        $doc->user_id = $request->input('user_id');
         
          //the image upload is treated here with care
       if($request->hasFile('image')){
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('doc'), $imageName);
       //Save the uploaded image into the database
       $doc->document = 'doc/'.$imageName;
       } 
       if(isset($doc->document)){
       $doc->save();
        return back()->with('success', 'Document successfully updated');
       }else
       return back()->with('fail', 'Document not submitted');
    }

     //This function is used to the password of the user
    public function getChangePassword(Request $request){
        $id = $request->input('user_id');
        $pass1 = $request->input('pass1');
        $pass2 = $request->input('pass2');
        if($pass1 != $pass2){
             return back()->with('fail', 'The passwords do not match');
        }
         DB::table('users')->where('id', $id)->update(['password'=>bcrypt($pass1)]);
        return back()->with('success', 'Profile successfully updated');
    }
  

       //This update the bank account of the user
       //
      public function getUpdateBank(Request $request){
       $id = $request->input('user_id');
       $bank = new Bank();
          if ($bank->where('user_id', $id)->first()) {
              $bank = $bank->where('user_id', $id)->first(); 
          }
           else 
             $bank->user_id = $id;
           
       $bank->bank = $request->input('bank');
       $bank->accountname = $request->input('accountname');
       $bank->accountnumber = $request->input('accountnumber');
       $bank->save();
        return back()->with('success', 'Bank Information Successfully Updated');
    }
}
