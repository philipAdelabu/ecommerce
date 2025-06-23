<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Feedback;

class Item extends Model
{
    use HasFactory;
     //
     public function itemDetail(){
        return $this->hasOne('App\Models\ItemDetail');
    }

    public function subCategory(){
        return $this->belongsTo('App\Models\SubCategory');
    }

    public function seller(){
        return $this->belongsTo('App\Models\Seller');
    }
    public function supplier(){
        return $this->belongsTo('App\Models\Supplier');
    }
    public function admin(){
        return $this->belongsTo('App\Models\Admin');
    }

    public function bannerImage(){
        return $this->hasOne('App\Models\BannerImage');
    }
    public function featuredImage(){
        return $this->hasMany('App\Models\FeaturedImage');
    }

    public function BannerAd(){
        return $this->hasMany('App\Models\FeaturedImage');
    }

    public function specialImage(){
        return $this->hasOne('App\Models\SpecialImage');
    }
    public function comment(){
        return $this->hasMany('App\Models\Feedback');
    }
    public function feedback($id){
      return Feedback::where('product_id', $id)->get();
    }
}
