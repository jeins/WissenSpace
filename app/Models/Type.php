<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $timestamps = false;
    
    public function products()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
