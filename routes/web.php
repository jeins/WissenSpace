<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Auth::routes();

Route::get('/login/redirect/{provider}', ['as' => 'auth.redirect', 'uses' => 'Auth\SocialController@getRedirect']);
Route::get('/login/handle/{provider}', ['as' => 'auth.handle', 'uses' => 'Auth\SocialController@getHandler']);

Route::get('/home', ['as' => 'public.home', 'uses' => 'HomeController@index']);

// User Routes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');
});


// Admin Routes
Route::prefix('admin')->group(function(){
    Route::get('/login', ['as' => 'admin.login', 'uses' => 'Auth\AdminLoginController@loginView']);
    Route::post('/login', ['as' => 'admin.login.submit', 'uses' => 'Auth\AdminLoginController@doLogin']);
    Route::get('/logout', ['as' => 'admin.logout', 'uses' => 'Auth\AdminLoginController@doLogout']);

    Route::get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin\AdminDashboardController@indexView']);
});