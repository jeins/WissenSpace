<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function isAllowToEdit($userId)
    {
        $isAdmin = Auth::guard('admin')->check();
        $isSameUser = false;

        if(Auth::user()){
            $isSameUser = ($userId === Auth::user()->id);
        }

        if ($isAdmin || $isSameUser) {
            return true;
        }

        return false;
    }
}
