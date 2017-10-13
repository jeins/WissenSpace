<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($name)
    {
        $user = User::with('products', 'product_comments')->where('name', $name)->first();
        return view('user.profile', compact('user'));
    }
}
