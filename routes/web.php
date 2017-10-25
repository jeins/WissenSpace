<?php

Route::get('/', 'HomeController@welcome');
Route::get('/faq', 'HomeController@faq');
Route::get('/team', 'HomeController@team');
Route::get('/tentang', 'HomeController@about');
Route::get('/explore', 'ProductController@index');
Route::get('explore/load/instagram', 'ProductController@load_instagram');
Route::get('/profile/{name}', ['as' => 'profile.show', 'uses' => 'ProfileController@show']);
Route::get('/explore/{slug}', ['as' => 'product.view', 'uses' => 'ProductController@show']);
Route::get('/explore/planet/{name}', 'ProductController@filterTag');
Route::get('/explore/media/{name}', 'ProductController@filterMedia');
//LoadMore
Route::get('/explore/load-more/{id}' , 'ProductController@loadMore');
Route::get('/explore/planet/{name}/load-more/{id}' , 'ProductController@loadMore');
Route::get('/explore/media/{name}/load-more/{id}' , 'ProductController@loadMore');

// Authentication Routes
Auth::routes();

Route::get('/login/redirect/{provider}', ['as' => 'auth.redirect', 'uses' => 'Auth\SocialController@getRedirect']);
Route::get('/login/handle/{provider}', ['as' => 'auth.handle', 'uses' => 'Auth\SocialController@getHandler']);

Route::get('/image/{type}/{image}', ['as' => 'image.view', 'uses' => 'ImageController@show']);

// User Routes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
    Route::get('/kontribusi', ['as' => 'contribute', 'uses' => 'ProductController@create']);
    Route::post('/kontribusi', ['as' => 'contribute.post', 'uses' => 'ProductController@post']);
    Route::post('/upload/image/{type}', ['as' => 'image.upload', 'uses' => 'ImageController@upload']);
    Route::post('/products/comment/{id}', ['as' => 'product.comment.post', 'uses' => 'ProductCommentController@save']);
    Route::put('/products/comment/{id}', 'ProductCommentController@update');
    Route::get('/products/comment/{id}/edit', 'ProductCommentController@edit');
    Route::get('/products/edit/{id}', ['as' => 'product.edit', 'uses' => 'ProductController@edit']);

    Route::post('/profile/update/{userId}', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
});


// Admin Routes
Route::prefix('admin')->group(function(){
    Route::get('/login', ['as' => 'admin.login', 'uses' => 'Auth\AdminLoginController@loginView']);
    Route::post('/login', ['as' => 'admin.login.submit', 'uses' => 'Auth\AdminLoginController@login']);
    Route::get('/logout', ['as' => 'admin.logout', 'uses' => 'Auth\AdminLoginController@logout']);

    Route::get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'Admin\AdminDashboardController@indexView']);
});
