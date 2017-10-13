<?php

namespace App\Http\Controllers;

use Cookie;
use App\Models\Tag;
use App\Models\Type;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;

class ProductController extends Controller
{
    const PRODUCT_THUMBNAIL_PATH = 'product_thumbnail';
    const PRODUCT_IMAGES_PATH = 'product_images';

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

        if ($product === null) {
            abort(404);
        }

        return view('products/single', compact('product'));
    }

    public function filterTag($name)
    {
        $tags = Tag::all();
        $types = Type::all();
        $products = Product::with('tags')->withCount('comments')->whereHas('tags', function ($q) use ($name) {
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

    public function add()
    {
        $tags = Tag::all();

        return view('products.add')
            ->with('categories', $tags);
    }

    public function uploadThumbnail()
    {
        if(Input::hasFile('file')){
            $image = ImageController::uploadTmpImage(Input::file('file'));

            return response()->json(['image_url' => route('view.tmp.image', ['userId' => Auth::user()->id, 'image' => $image])], 200);
        }

        return response()->json(false, 200);
    }
}
