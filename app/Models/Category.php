<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
      //
      public function subCategory(){
        return $this->hasMany('App\Models\SubCategory');
     }
     public function totalCount($category, $user = null , $id = null){
         if($user != null && $id != null)
             return   count(Item::where($user, $id)->where('category', $category)->get());
         else 
         return   count(Item::where('category', $category)->get());
     }
}
