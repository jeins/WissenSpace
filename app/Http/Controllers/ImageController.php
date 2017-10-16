<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Image;

class ImageController extends Controller
{
    const USER_TYPE = 'u';
    const PRODUCT_TYPE = 'p';
    const USER_PHOTO_PATH = '/images/user/';
    const PRODUCT_IMAGES_PATH = '/images/product/';

    public static function upload($type)
    {
        if(Input::hasFile('file')){
            $file = Input::file('file');

            $imagePath = $type === self::USER_TYPE ? self::USER_PHOTO_PATH : self::PRODUCT_IMAGES_PATH;
            $imageFullPath = storage_path() . $imagePath . '/';
            $fileName = md5(uniqid('', true)) . '.' . $file->getClientOriginalExtension();

            File::makeDirectory($imageFullPath, $mode = 0755, true, true);
            Image::make($file)->resize(200, 200)->save($imageFullPath . $fileName);

            return response()->json(['image_url' => route('image.view', ['type' => $type, 'image' => $fileName]), 'image' => $fileName], 200);
        }

        return response()->json(false, 200);
    }

    public function show($type, $image)
    {
        if($type !== 'u' && $type !== 'p'){
            abort(403);
        }

        $imagePath = $type === self::USER_TYPE ? self::USER_PHOTO_PATH : self::PRODUCT_IMAGES_PATH;

        return Image::make(storage_path() . $imagePath . $image)->response();
    }
}
