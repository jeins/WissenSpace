<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    protected $table = 'product_tag';
    public $timestamps = false;

    protected $guarded = ['id'];

    public function tag()
    {
        return $this->belongsTo('App\Model\Tag');
    }

    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }
}
