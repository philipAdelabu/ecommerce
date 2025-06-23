<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use DB;


use App\Models\Contents;
use App\Models\Comments;
use App\Models\Item;

use App\Emails;
use App\Models\Admin;
use App\Http\Middleware\GuestMiddleware;
use App\Mail\Mailing;
use Illuminate\Support\Facades\Mail;



class BlogController extends Controller
{

    public function getIndex(){
        $contents = Contents::orderBy('created_at', 'desc')->paginate(20);
        $items = Item::inRandomOrder()->limit(9)->get();
        return view('general.blog', [ 'contents'=>$contents, 'items'=>$items ]);
         }
         
          public function getAddPosts(){
      return view('add_post');
  }
  
       

         public function getProducts(){
             $items = Item::inRandomOrder()->paginate(60);
             return view('blog.products', ['items'=>$items]);
         }
         public function getSinglePostb(){
            return view('general.blog_detail');
        }
    
         public function getSinglePost($id, $title){
             $items = Item::inRandomOrder()->limit(9)->get();
             $content = Contents::find($id);
             if(!$content) return redirect()->to('blog');
             $count = $content->view + 1;
             $content->view = $count;
             $content->save();
             $contents = Contents::where('id', '<>', $id)->orderBy('created_at' , 'desc')->paginate(10); 
             $comments = Comments::where('content_id', $id)->get();
             return view('general.blog_detail', ['contents'=>$contents,'comments'=>$comments, 'content'=>$content, 'items'=>$items]);
        }
    
    
        public function postSendComment(Request $request){
            $comment = new Comments();
            $comment->content_id = $request->id;
            $comment->username = $request->email;
            $comment->name = $request->name;
            $comment->comment = $request->message;
            $comment->save();
            return back()->with('success', 'Your comment was sent successfully');
        }
    
        public function randomContents($number){
            $random = Contents::inRandomOrder()->orderBy('created_at' , 'desc')->limit($number)->get();
            return $random;
        }
       
        public function postSearchPost(Request $request){
           if(trim($request->text) == "" )  return back();
            $contents = Contents::where('title','like',  '%'.$request->text.'%')->orderBy('created_at', 'desc')->paginate(28);
            $items = Item::inRandomOrder()->limit(9)->get();
            return view('general.blog', ['contents'=>$contents, 'items'=>$items]);
            }
     
        public function getNewsUpdate(){
            $random = $this->randomContents();
            $mostView = Contents::orderBy('view', 'desc')->limit(20)->get();
            $breaking_news = Contents::orderBy('created_at', 'desc')->limit(12)->get();
            $data['status'] = 'ok';
            $data['random'] = $random;
            $data['mostView'] = $mostView;
            $data['breaking_news'] = $breaking_news;
            $data = json_encode($data);
            return $data;
        }
    
        public function postSubscribe(Request $request){
            $email = $request->email;
            if(Emails::where('email' , $email)->exists()) return back()->with('fail', 'The email you enter already exists in our system.');
            $e = new Emails();
            $e->email = $email;
            $e->save();
            return back()->with('success', 'Thank you for subscribing for our newsletter');
        }
    
    
    //Section use to handle the admin controller activities 

    public function getAdminAddNews(){
        return view('admin.blog.admin_add_item');
    }

    public function postAdminAddNews(Request $request){
    
      DB::beginTransaction();
      try{
          
         if(isset($request->update)){
              $content = Contents::find($request->news_id);
              if($content->image) File::delete($content->image);
         }else   $content = new Contents();

         $content->message = $request->content;
         $content->title = $request->title;
         $content->author = $request->author;
         $data = null;
         if($request->hasFile('image')){ 
             $data = $this->imageUpload($request, 'image');
            }
          
         if($data) $content->image = $data;
         $content->save();
         DB::commit();
         return back()->with('success', 'The action was successfully done');
      }catch(\Exception $e){
          DB::rollBack();
          return back()->with('fail', 'The Post was not successfully submitted. Please, try again later.');
          return $e;
      }
    return back()->with('fail', 'The Post was not successfully submitted.');
     }
     
      public function postUserAddPost(Request $request){
    
      DB::beginTransaction();
      try{
          
          $content = new Contents();

         $content->message = $request->content;
         $content->title = $request->title;
         $content->author = $request->author;
         $data = null;
         if($request->hasFile('image')){ 
             $data = $this->imageUpload($request, 'image');
            }
          
         if($data) $content->image = $data;
         $content->save();
         DB::commit();
         return back()->with('success', 'The Post was successfully submitted.');
      }catch(\Exception $e){
          DB::rollBack();
          return back()->with('fail', 'The Post was not successfully submitted. Please, try again later');
          return $e;
      }
       return back()->with('fail', 'The Post was not successfully submitted.');
     }

    // A function to upload multiple images.
  
     public function imageUpload($request, $name){
         $this->validate($request, [ $name => 'image|mimes:jpeg,png,jpg,gif,svg|max:8096', ]);
         //the image upload is treated here with care
         $data = null;
         $image = $request->file($name);
         $imageName = (time()).'.'.$image->getClientOriginalExtension();
         $img = null;  
         $image->move(public_path('../../newsImages'), $imageName);
         $img = 'newsImages/'.$imageName;
        $image_resize = Image::make(public_path('../../'.$img))->resize(1200, 600)->save();
         $data = $img; 
      return $data;
     }
     
     
public function getAdminViewNews($category = null){
    $news = Contents::paginate(18);
    return view('admin.blog.admin_view_news', ['news'=>$news,]);
 }

 public function getAdminSpecificNews(Request $request, $status , $id){
    if($status == 'view'){
       $content = Contents::where('id', $id)->first();
       $contents = Contents::where('id','<>', $content->id)->orderBy('created_at', 'desc')->paginate(12);
       
       return view('admin.blog.admin_news_detail', ['content'=>$content, 'contents'=>$contents]);
    }

    if($status == 'edit'){
       return redirect()->to('admin_update_news/'.$id);
    }
    if($status == 'delete'){
       $item = Contents::find($id);
       if($item){
        $comments = Comments::where('content_id', $item->id)->get();
        if(count($comments)> 0){
            foreach($comments as $com) $com->delete();
        }
      }
       if($item->image) File::delete($item->image);
       $item->delete();
       return redirect()->to('admin_view_news')->with('success', 'The action performed was successful');
    } 
}

public function getAdminUpdateNews($id){ 
    $content = Contents::find($id);
    return view('admin.blog.admin_update_news',['content'=>$content]);
  }

  
    
}
