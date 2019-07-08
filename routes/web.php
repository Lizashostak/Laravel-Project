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

Route::get('', "WebPagesController@HomePage");


Route::prefix('shop')->group(function() {
    Route::get('/', "WebPagesController@GetCategories");
    Route::get('{cat_url}', "WebPagesController@GetAllProducts");
    Route::get('filter/{cat_url}/{gender}', "WebPagesController@GetAllProductsByGender");
    Route::get('{cat_url}/{product_url}', "WebPagesController@ViewProduct");
});

Route::prefix('cart')->group(function() {
    Route::get('addtocart', "WebPagesController@AddProductToCart");
    Route::get('viewcart', "WebPagesController@ViewCart");
    Route::get('updatecart', "WebPagesController@UpdateCart");
    Route::get('deletecart', "WebPagesController@DeleteCart");
    Route::get('saveorder', "WebPagesController@SaveOrder");
});

Route::prefix('user')->group(function() {
    Route::get('signin', "WebPagesController@SignIn");
    Route::get('signup', "WebPagesController@SignUp");
    Route::post('signin', "WebPagesController@SignInRequest");
    Route::post('signup', "WebPagesController@SignUpRequest");
    Route::get('useracount', "WebPagesController@GetAcount");
    Route::post('changepassword', "WebPagesController@UserChangePassword");
    Route::post('changedetailes', "WebPagesController@UserChangeDetailes");
    Route::post('changeemail', "WebPagesController@UserChangeEmail");
    Route::get('logout', "WebPagesController@LogOut");
    Route::post('contactus', "WebPagesController@ContactUs");
});

Route::middleware(['cmsgurd'])->group(function() {
    Route::prefix('cms')->group(function() {
        Route::get('dashboard', "CmsController@GetDashboard");
        Route::resource('categories', 'CategorieController');
        Route::resource('products', 'ProductController');
        Route::get('orders', "CmsController@GetOrders");
        Route::get('logout', "CmsController@LogOut");
        Route::resource('contents', 'ContentController');
        Route::get('messages', "CmsController@GetMessages");
        Route::get('messages/data', "CmsController@ReadMessages");
        Route::get('messages/delete', "CmsController@DeleteMessage");
    });
});

Route::get('{content}', "WebPagesController@GetContent");
