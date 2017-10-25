<?php

namespace App\Http\Controllers;

use Cookie;
use Carbon\Carbon;
use App\Models\Tag;
use App\Models\User;
use App\Models\Type;
use App\Models\Maker;
use GuzzleHttp\Client;
use App\Models\Product;
use App\Models\ProductTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
    const PRODUCT_THUMBNAIL_PATH = 'product_thumbnail';
    const PRODUCT_IMAGES_PATH = 'product_images';

    public function __construct()
    {
        Carbon::setLocale('id');
    }

    public function index()
    {
        $tags = Tag::select('name')->has('products')->get();
        $types = Type::all();
        $products = Product::with('tags')->withCount('comments')->orderBy('id', 'desc')->get();

        return view('products/index', compact('products', 'tags', 'types'));
    }

    public function show($slug)
    {
        $product = Product::with('comments.user')->where('slug', $slug)->first();

        if ($product === null)
            abort(404);

        if ($product->images) {
            $tmpImages = json_decode($product->images);
            array_walk($tmpImages, function (&$image, &$index) {
                $image = route('image.view', [ImageController::PRODUCT_TYPE, $image]);
            });
            $product->images = $tmpImages;
        }

        return view('products/single', compact('product'));
    }

    public function filterTag($name)
    {
        $tags = Tag::select('name')->has('products')->get();
        $types = Type::all();
        $products = Product::with('tags')->withCount('comments')->orderBy('id', 'desc')->whereHas('tags', function ($q) use ($name) {
            $q->where('name', $name);
        })->get();

        return view('products/index', compact('products', 'tags', 'types'));
    }

    public function filterMedia($name)
    {
        $tags = Tag::select('name')->has('products')->get();
        $types = Type::all();
        $type_id = Type::where('name', $name)->first();

        $products = Product::with('tags')->withCount('comments')->orderBy('id', 'desc')->where('type_id', $type_id->id)->get();

        return view('products/index', compact('products', 'tags', 'types'));
    }

    public function loadMore(Request $request, $name_or_id, $id = null)
    {
        $limit = 2;
        $products = Product::where('id', '<', $name_or_id)->withCount('comments')->orderBy('id', 'desc')->get();

        if (str_contains($request->fullUrl(), 'planet')) {
            $products = Product::with('tags')->withCount('comments')
                ->orderBy('id', 'desc')->whereHas('tags', function ($q) use ($name_or_id) {
                    $q->where('name', $name_or_id);
                })->where('id', '<', $id)->orderBy('id', 'desc')->get();
        }

        if (str_contains($request->fullUrl(), 'media')) {
            $type_id = Type::where('name', $name_or_id)->first();
            $products = Product::with('tags')->withCount('comments')->orderBy('id', 'desc')
                ->where('type_id', $type_id->id)->where('id', '<', $id)->get();
        }

        foreach ($products->take($limit) as $product) {
            echo "<div id='products'>
                    <a href='/explore/" . $product->slug . "' class='each-product' data-id=" . $product->id . ">
                        <img src=" . $product->thumbnail . " width='100'>
                        <h3>" . $product->name . "</h3>
                        <p>" . $product->tagline . "</p>
                        <p>" . $product->comments_count . " Komentar</p>";

            foreach ($product->tags as $tag) {
                echo "<span>#" . $tag->name . "</span>";
            }
            echo "</a>
                </div>";
        }

        if ($products->count() > $limit)
            echo "<a class='button is-primary load-more'> Explore Lagi </a>";
    }

    public function create()
    {
        $tags = Tag::all();
        $field = $this->setFieldViews();

        return view('products.form', compact('tags', 'field'));
    }

    public function post(Request $request)
    {
        $productData = $request->all();

        if (array_key_exists('product_id', $productData)) {
            $productSlug = $this->updateProduct($productData);
            $message = 'Berhasil DiUpdate!';
        } else {
            $productSlug = $this->addNewProduct($productData);
            $message = 'Terima kasih kontribusinya!';
        }

        $request->session()->flash('success', $message);
        return response()->json(route('product.view', $productSlug), 200);
    }

    private function updateProduct($productData)
    {
        $id = $productData['product_id'];
        $product = Product::find($id);
        $makers = Maker::where('product_id', $id);

        foreach ($productData['info'] as $key => $val) {
            $product[$key] = $val;
        }

        $slug = strtolower(str_replace(' ', '-', $product->name));
        //if slug already exists
        if (Product::where('slug', $slug)->first() != null) {
            $slug .= '-' . time();
        }

        $product->slug = $slug;
        $product->thumbnail = $productData['thumbnail'];
        $product->images = json_encode($productData['images']);
        $product->type_id = $productData['type_id'];
        $product->save();

        if($makers->count()){
            foreach ($makers as $maker){
                foreach ($productData['owner'] as $key => $val) {
                    $maker[$key] = $val;
                }

                $maker->save();
            }
        } else{
            $maker = new Maker();

            foreach ($productData['owner'] as $key => $val) {
                $maker[$key] = $val;
            }

            $product->makers()->save($maker);
        }

        $numSavedTag = ProductTag::where('product_id', $id)->count();
        if($numSavedTag !== count($productData['tag_id'])){
            ProductTag::where('product_id', $id)->delete();

            foreach ($productData['tag_id'] as $tag) {
                $tag = Tag::find($tag);
                $tag->products()->attach($product);
            }
        }

        return $product->slug;
    }

    private function addNewProduct($productData)
    {
        $user = User::find(Auth::user()->id);

        $product = new Product();
        foreach ($productData['info'] as $key => $val) {
            $product[$key] = $val;
        }

        $maker = new Maker();
        if($productData['owner']['name']){
            foreach ($productData['owner'] as $key => $val) {
                $maker[$key] = $val;
            }
        }

        //add user point
        $user->point = $user->point + 10;
        $user->save();

        $slug = strtolower(str_replace(' ', '-', $product->name));
        //if slug already exists
        if (Product::where('slug', $slug)->first() != null) {
            $slug .= '-' . time();
        }

        $product->slug = $slug;
        $product->thumbnail = $productData['thumbnail'];
        $product->images = json_encode($productData['images']);
        $product->type_id = $productData['type_id'];
        $user->products()->save($product);
        $product->makers()->save($maker);
        $product->save();

        foreach ($productData['tag_id'] as $tag) {
            $tag = Tag::find($tag);
            $tag->products()->attach($product);
        }

        return $product->slug;
    }

    public function edit($productId)
    {
        $product = Product::find($productId);

        if (!$product || $product->user_id !== Auth::user()->id) {
            abort(403);
        }

        $makers = $product->makers;
        $tags = $product->tags;

        $field = $this->setFieldViews($product, $tags, $makers);

        $tags = Tag::all();
        return view('products.form', compact('tags', 'field'));
    }

    //TODO
    private function setFieldViews($product = null, $tags = null, $makers = null)
    {
        $field = [
            'type_id' => '',
            'info' => [
                'name' => '',
                'link' => '',
                'tagline' => '',
                'subject' => ''
            ],
            'tag_id' => [],
            'thumbnail' => '',
            'images' => [],
            'owner' => [
                'name' => '',
                'twitter_username' => ''
            ]
        ];

        if ($product && $tags && $makers) {
            $field['product_id'] = $product->id;
            $field['type_id'] = $product->type_id;

            foreach (array_keys($field['info']) as $key) {
                $field['info'][$key] = $product[$key];
            }

            $field['thumbnail'] = $product['thumbnail'];
            $field['images'] = json_decode($product['images']);

            foreach ($tags as $tag) {
                $field['tag_id'][] = $tag->id;
                $field['tag_name'][] = $tag->name;
            }

            foreach (array_keys($field['owner']) as $key) {
                $field['owner'][$key] = $makers[0][$key]; //TODO enable more thane one makers
            }
        }

        return $field;
    }

    //get instagram feed last via ajax
    public function load_instagram()
    {
        $client = new Client();
        $res = $client->request('GET', 'https://www.instagram.com/wissenspace/media/')
                     ->getBody();

        $insta_feed = json_decode($res)->items[0];
        $feed =  [
            'last_image' => $insta_feed->images->standard_resolution->url,
            'url' => $insta_feed->link
        ];

        return response($feed);
    }
}
