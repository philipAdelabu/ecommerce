<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UtilityController extends Controller
{
    //
   // production // $path = '../../';
   // developement // $path '';
     static $path = '../../';
    public function uploadSpecialImage($request, $imageType, $name){
        $this->validate($request, [$name => 'image|mimes:jpeg,png,jpg,gif,svg|max:8096',]);
        $path = UtilityController::$path;
       try{
       $image = $request->file($name);
       $imageName = time().'.'.$image->getClientOriginalExtension();
       $img = null; 
       if($imageType == 'banner'){ 
       $image->move(public_path($path.'bannerImages'), $imageName);
       $img = 'bannerImages/'.$imageName;
      //$image_resize = Image::make(public_path($path.$img))->resize(1170, 480)->save(); 
      $mg = new ImageManager(new Driver());
      $image_resize = $mg->read($path.$img)->resize(1170, 480); 
       }
       if($imageType == 'featured'){
          $image->move(public_path($path.'featuredImages'), $imageName);
          $img = 'featuredImages/'.$imageName;
         // $image_resize = Image::make(public_path($path.$img))->resize(1170, 300)->save();
         $mg = new ImageManager(new Driver());
         $image_resize = $mg->read($path.$img)->resize(1170, 300);
       }
       if($imageType == 'special'){
          $image->move(public_path($path.'specialImages'), $imageName);
          $img = 'specialImages/'.$imageName;
         // $image_resize = Image::make(public_path($path.$img))->resize(400, 380)->save();
         $mg = new ImageManager(new Driver());
         $image_resize = $mg->read($path.$img)->resize(400, 380);
       }
       return $img;
      }catch(\Exception $e){
          return $e;
      }
    }


        // A function to upload multiple images.
        public function imageUpload($request, $names){

            $this->validate($request, [$names => 'image|mimes:jpeg,png,jpg,gif,svg|max:8096',]);
                //the image upload is treated here with care
                $data = [];
                $path = UtilityController::$path;
            $i = 11;
            foreach($request->file($names) as $image){
             $imageName = ($i + time()).'.'.$image->getClientOriginalExtension();
             $i += 21;
             $img = null;  
             $image->move(public_path($path.'productImages'), $imageName);
             $img = 'productImages/'.$imageName;

                  // create new image instance
                  $mg = new ImageManager(new Driver());
                 // $image_resize = $mg->read($path.$img)->resize(1200, 990);
             $data[] = $img; 
           } 
          return $data;
         }

         public static function deleteImage($fileName){
            try{
                 File::delete($fileName);
                 Storage::disk('public')->delete($fileName);
                 return true;
                }catch(\Exception $e){
                throw $e;
            }
         }


}

class Image {
    public static function make(){
                    // create image manager with desired driver
            $manager = new ImageManager(new Driver());

            // read image from file system
            $image = $manager->read('images/example.jpg');

            // resize image proportionally to 300px width
            $image->scale(width: 300);

            // insert watermark
            $image->place('images/watermark.png');

            // save modified image in new format 
            $image->toPng()->save('images/foo.png');
    }
}
