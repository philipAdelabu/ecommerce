<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedImage extends Model
{
    use HasFactory;
    public function item(){
        return $this->belongsTo('App\Models\Item');
    }

}
