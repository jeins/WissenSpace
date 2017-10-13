<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Image;

class ImageController extends Controller
{
    public static function uploadTmpImage($file)
    {
        $globalTmpImagePath = storage_path() . '/tmp/images/user/' . Auth::user()->id . '/';
        $fileName = md5(uniqid('', true)) . '.' . $file->getClientOriginalExtension();

        File::makeDirectory($globalTmpImagePath, $mode = 0755, true, true);
        Image::make($file)->resize(200, 200)->save($globalTmpImagePath . $fileName);

        // $this->updateDataToDb();

        return $fileName;
    }

    public function viewTmpImage($userId, $image)
    {
        return Image::make(storage_path() . '/tmp/images/user/' . $userId . '/' . $image)->response();
    }
}
