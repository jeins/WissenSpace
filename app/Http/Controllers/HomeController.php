<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome()
    {
        $top_products = Product::withCount('comments')->orderBy('comments_count', 'desc')
                            ->take(5)->get();

        $new_products = Product::orderBy('id', 'desc')->take(5)->get();

        return view('pages.welcome', compact('top_products', 'new_products'));
    }

    public function faq()
    {
        return view('pages.faq');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function team()
    {
        return view('pages.team');
    }
}
