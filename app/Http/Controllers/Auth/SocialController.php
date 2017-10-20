<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Social;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    /**
     * get redirect url from selected provider (social media)
     * @param $provider
     * @return $this
     */
    public function getRedirect($provider)
    {
        $providerKey = Config::get('services.' . $provider);

        if (empty($providerKey)) {
            return view('pages.status')
                ->with('error', trans('auth.noProvider'));
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * setup login handler
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getHandler($provider)
    {
        $userObject = Socialite::driver($provider)->user();

        $socialUser = null;

        $getUserFromEmail = User::where('email', '=', $userObject->email)->first();

        if(empty($getUserFromEmail)){
            $getUserSocial = Social::where('social_id', '=', $userObject->id)
                ->where('provider', '=', $provider)
                ->first();

            if(empty($getUserSocial)){
                $social = new Social();
                $userName = $userObject->nickname;
                $userFullName = $userObject->name;

                if($userName === null){
                    $userName = strtolower(str_replace(' ', '', $userFullName));
                }

                if(!empty(User::where('name', '=', $userName)->first())){
                    $userName = $this->generateNewUserName($userName);
                }

                $user = User::create([
                    'name'      => $userName,
                    'full_name' => $userFullName,
                    'email'     => $userObject->email,
                    'token'     => $userObject->token,
                    'activated' => true
                ]);

                $social->social_id = $userObject->id;
                $social->provider = $provider;
                $user->social()->save($social);
                $user->save();

                $socialUser = $user;
            } else{
                $socialUser = $getUserSocial->user;
            }

            auth()->login($socialUser, true);

            return redirect('/explore')->with('success', trans('auth.registerSuccess'));
        }

        $socialUser = $getUserFromEmail;

        auth()->login($socialUser, true);

        return redirect('/explore');
    }

    private function generateNewUserName($userName)
    {
        //TODO generate new username if already exist!
        return $userName . '99';
    }
}
