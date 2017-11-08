<?php

namespace App\Repositories;

use App\Models\Social;
use App\Models\User;
use App\Repositories\Interfaces\IUser;

class UserRepository implements IUser
{

    public function getAll()
    {
        return User::with('social')->with('products')->get();
    }

    public function get($id)
    {
        // TODO: Implement get() method.
    }

    public function getStatistic()
    {
        $activatedUser = User::where('activated', '=', true)->count();
        $inactivatedUser = User::where('activated', '=', false)->count();

        $socialMedias = Social::select('provider')->groupBy('provider')->get();
        $totalLoginMedia = [];
        foreach ($socialMedias as $socialMedia){
            $totalLoginMedia[$socialMedia->provider] = Social::where('provider', '=', $socialMedia->provider)->count();
        }

        return [
            'activeUser' => $activatedUser,
            'inactiveUser' => $inactivatedUser,
            'mediaLogin' => $totalLoginMedia
        ];
    }
}