<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Image;

class ImageController extends Controller
{
    const USER_TYPE = 'u';
    const PRODUCT_TYPE = 'p';
    const WISSENSPACE_TYPE = 'ws';
    const USER_PHOTO_PATH = '/images/user/';
    const PRODUCT_IMAGES_PATH = '/images/product/';
    const WISSENSPACE_IMAGES_PATH = '/images/ws/';

    public static function upload($type)
    {
        if(Input::hasFile('file')){
            $file = Input::file('file');

            $imagePath = $type === self::USER_TYPE ? self::USER_PHOTO_PATH : self::PRODUCT_IMAGES_PATH;
            $imageFullPath = storage_path() . $imagePath . '/';
            $fileName = md5(uniqid('', true)) . '.' . $file->getClientOriginalExtension();

            File::makeDirectory($imageFullPath, $mode = 0755, true, true);
            Image::make($file)->save($imageFullPath . $fileName);

            return response()->json(['image_url' => route('image.view', ['type' => $type, 'image' => $fileName]), 'image' => $fileName], 200);
        }

        return response()->json(false, 200);
    }

    public function show($type, $image, $width = null, $height = null)
    {
        if($type !== 'u' && $type !== 'p' && $type !== 'ws'){
            abort(403);
        }

        $imagePath = '';

        switch ($type)
        {
            case self::USER_TYPE: $imagePath = self::USER_PHOTO_PATH; break;
            case self::PRODUCT_TYPE: $imagePath = self::PRODUCT_IMAGES_PATH; break;
            case self::WISSENSPACE_TYPE: $imagePath = self::WISSENSPACE_IMAGES_PATH; break;
        }

        if($imagePath){
            $image = Image::make(storage_path() . $imagePath . $image);

            if($width && $height){
                $image->fit($width, $height, function($constraint){
                    $constraint->upsize();
                });
            }

            return $image->response();
        }

        return false;
    }

    //TODO check security
    public function delete($type, $image)
    {
        $imagePath = $type === self::USER_TYPE ? self::USER_PHOTO_PATH : self::PRODUCT_IMAGES_PATH;
        $imageFullPath = storage_path() . $imagePath . '/';

        Image::make($imageFullPath . $image)->destroy();
    }
}
