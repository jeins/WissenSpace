<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * database table
     * @var string
     */
    protected $table = 'users';

    /**
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'full_name',
        'email',
        'token',
        'point',
        'activated',
        'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'token', 'activated', 'role'
    ];

    /**
     * relationships with social
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function social()
    {
        return $this->hasMany('App\Models\Social');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function product_comments()
    {
        return $this->hasMany('App\Models\ProductComment');
    }
}
