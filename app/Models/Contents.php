<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contents extends Model
{
    use HasFactory;
    public function comments(){
        return $this->hasMany('App\Models\Comments', 'content_id');
    }
}
