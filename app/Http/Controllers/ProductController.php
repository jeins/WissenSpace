<?php

namespace App\Http\Controllers;

use App\Models\Maker;
use App\Models\User;
use Cookie;
use App\Models\Tag;
use App\Models\Type;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

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
            ->with('tags', $tags);
    }

    public function doAdd(Request $request)
    {
        $productData = $request->all();

        $user = User::find(Auth::user()->id);
        $tag = Tag::find($productData['tag_id']);

        $product = new Product();
        foreach ($productData['info'] as $key=>$val){
            $product[$key] = $val;
        }

        $maker = new Maker();
        foreach ($productData['owner'] as $key=>$val){
            $maker[$key] = $val;
        }

        $product->slug = strtolower(str_replace(' ', '-', $product->name));
        $product->thumbnail = $productData['thumbnail'];
        $product->images = json_encode($productData['images']);
        $product->type_id = $productData['type_id'];
        $user->products()->save($product);
        $product->makers()->save($maker);
        $product->save();

        $tag->products()->attach($product);

        return response()->json(['productId' => $product->id], 200);
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
