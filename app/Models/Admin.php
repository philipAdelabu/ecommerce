<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
     //
     public function item(){
        return $this->hasMany('App\Models\Item');
    }

    public function suppliers(){
        return $this->hasMany('App\Models\Supplier');
    }
}
