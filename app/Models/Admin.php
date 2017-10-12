<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    /**
     * table name
     * @var string
     */
    protected $table = 'admins';

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];
}
