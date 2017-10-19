<?php

namespace App\Http\Controllers;

use Cookie;
use App\Models\Tag;
use App\Models\User;
use App\Models\Type;
use App\Models\Maker;
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
        $products = Product::with('tags')->withCount('comments')->orderBy('id','desc')->get();

        return view('products/index', compact('products', 'tags', 'types'));
    }

    public function show($slug)
    {
        $product = Product::with('comments.user')->where('slug', $slug)->first();

        if ($product === null)
            abort(404);

        if($product->images){
            $tmpImages = json_decode($product->images);
            array_walk($tmpImages, function(&$image, &$index){
                $image = route('image.view', [ImageController::PRODUCT_TYPE, $image]);
            });
            $product->images = $tmpImages;
        }

        return view('products/single', compact('product'));
    }

    public function filterTag($name)
    {
        $tags = Tag::all();
        $types = Type::all();
        $products = Product::with('tags')->withCount('comments')->orderBy('id','desc')->whereHas('tags', function ($q) use ($name) {
            $q->where('name', $name);
        })->get();

        return view('products/index', compact('products', 'tags', 'types'));
    }

    public function filterMedia($name)
    {
        $tags = Tag::all();
        $types = Type::all();
        $type_id = Type::where('name', $name)->first();

        $products = Product::with('tags')->withCount('comments')->orderBy('id','desc')->where('type_id', $type_id->id)->get();

        return view('products/index', compact('products', 'tags', 'types'));
    }

    public function loadMore(Request $request, $name_or_id, $id = null)
    {
        $limit = 2;
        $products = Product::where('id', '<', $name_or_id)->orderBy('id','desc')->get();

        if(str_contains($request->fullUrl(), 'planet')) {
            $products = Product::with('tags')->withCount('comments')
                        ->orderBy('id','desc')->whereHas('tags', function ($q) use ($name_or_id) {
                            $q->where('name', $name_or_id);
                        })->where('id', '<', $id)->orderBy('id','desc')->get();
        }

        if(str_contains($request->fullUrl(), 'media')) {
            $type_id  = Type::where('name', $name_or_id)->first();
            $products = Product::with('tags')->withCount('comments')->orderBy('id','desc')
                                ->where('type_id', $type_id->id)->where('id', '<', $id)->get();
        }

        foreach($products->take($limit) as $product){
            echo "<div id='products'>
                    <a href='/explore/". $product->slug ."' class='each-product' data-id=".$product->id.">
                        <img src=".$product->thumbnail." width='100'>
                        <h3>". $product->name ."</h3>
                        <p>". $product->tagline ."</p>
                        <p>".$product->comments_count." Komentar</p>";

                        foreach ($product->tags as $tag){
                            echo "<span>#".$tag->name."</span>";
                        }
                    echo "</a>
                </div>";
        }

        if($products->count() > $limit)
            echo "<a class='button is-primary load-more'> Explore Lagi </a>";
    }

    public function add()
    {
        $tags = Tag::all();
        return view('products.add', compact('tags'));
    }

    public function doAdd(Request $request)
    {
        $productData = $request->all();

        $user = User::find(Auth::user()->id);

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

        foreach ($productData['tag_id'] as $tag){
            $tag = Tag::find($tag);
            $tag->products()->attach($product);
        }

        return response()->json(['productId' => $product->id], 200);
    }
}
