<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
     //
     public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function item(){
        return $this->hasMany('App\Models\Item');
    }
    public function itemCount($category, $sub_category, $user = null , $id = null){
    if($user != null && $id != null)
        return   count(Item::where($user, $id)->where('category', $category)->where('sub_category', $sub_category)->get());
    else
         return   count(Item::where('category', $category)->where('sub_category', $sub_category)->get());
         
    }
}
