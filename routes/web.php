<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/explore', 'ProductController@index');
Route::get('/profile/{name}', 'ProfileController@show');
Route::get('/explore/{slug}', 'ProductController@show');
Route::get('/explore/planet/{name}', 'ProductController@filterTag');
Route::get('/explore/media/{name}', 'ProductController@filterMedia');
Route::get('/explore/load-more/{id}' , 'ProductController@loadMore');

// Authentication Routes
Auth::routes();

Route::get('/login/redirect/{provider}', ['as' => 'auth.redirect', 'uses' => 'Auth\SocialController@getRedirect']);
Route::get('/login/handle/{provider}', ['as' => 'auth.handle', 'uses' => 'Auth\SocialController@getHandler']);

Route::get('/home', ['as' => 'public.home', 'uses' => 'HomeController@index']);

// User Routes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
    Route::get('/kontribusi', ['as' => 'contribute', 'uses' => 'ProductController@add']);
    Route::post('/kontribusi', ['as' => 'contribute.post', 'uses' => 'ProductController@doAdd']);
    Route::post('/upload/tmp/images', ['as' => 'upload.tmp.image', 'uses' => 'ProductController@uploadThumbnail']);
    Route::get('/tmp/images/{userId}/{image}', ['as' => 'view.tmp.image', 'uses' => 'ImageController@viewTmpImage']);
    Route::post('/products/comment/{id}', 'ProductCommentController@save');
    Route::put('/products/comment/{id}', 'ProductCommentController@update');
    Route::get('/products/comment/{id}/edit', 'ProductCommentController@edit');
});


// Admin Routes
Route::prefix('admin')->group(function(){
    Route::get('/login', ['as' => 'admin.login', 'uses' => 'Auth\AdminLoginController@loginView']);
    Route::post('/login', ['as' => 'admin.login.submit', 'uses' => 'Auth\AdminLoginController@login']);
    Route::get('/logout', ['as' => 'admin.logout', 'uses' => 'Auth\AdminLoginController@logout']);

    Route::get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin\AdminDashboardController@indexView']);
});
