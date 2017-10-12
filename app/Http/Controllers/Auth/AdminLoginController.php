<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    /**
     * display login form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loginView()
    {
        return view('auth.admin-login');
    }

    /**
     * handle login request
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:10'
        ]);

        if (Auth::guard('admin')->attempt(['email', $request->email, 'password' => $request->password])) {
            return redirect()->intended(route('admin.dashboard'));
        }
    }

    /**
     * handle logout request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function doLogout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
