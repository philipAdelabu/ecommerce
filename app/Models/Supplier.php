<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    //
    public function item(){
        return $this->hasMany('App\Models\Item');
    }

    public function admins(){
        return $this->belongsTo('App\Models\Admin');
    }
}
