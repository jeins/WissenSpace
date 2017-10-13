<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [
        'id', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function makers()
    {
        return $this->hasMany('App\Models\Maker');
    }


    public function comments()
    {
        return $this->hasMany('App\Models\ProductComment');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
}
