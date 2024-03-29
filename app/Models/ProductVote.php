<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVote extends Model
{
    protected $guarded = ['id'];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
