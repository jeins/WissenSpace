<?php

namespace App\Http\Controllers;

use Cookie;
use App\Models\Tag;
use App\Models\Type;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        $types = Type::all();
        $products = Product::with('tags')->withCount('comments')->get();
        return view('products/index', compact('products', 'tags', 'types'));
    }

    public function show($slug)
    {
        $product = Product::with('comments.user')->where('slug', $slug)->first();

        if($product == null)
            abort(404);

        return view('products/single', compact('product'));
    }

    public function filterTag($name)
    {
        $tags = Tag::all();
        $types = Type::all();
        $products = Product::with('tags')->withCount('comments')->whereHas('tags', function($q) use ($name) {
                        $q->where('name', $name);
                    })->get();

        return view('products/index', compact('products', 'tags', 'types'));
    }

    public function filterMedia($name)
    {
        $tags = Tag::all();
        $types = Type::all();
        $type_id = Type::where('name', $name)->first();

        $products = Product::with('tags')->withCount('comments')->where('type_id', $type_id->id)->get();

        return view('products/index', compact('products', 'tags', 'types'));
    }
}
