<?php

use Illuminate\Support\Facades\Route;


Auth::routes();
//login Route
Route::get('/login',function(){
     return redirect()->to('/');
})->name('login');
Route::get('/register',function(){
     return redirect()->to('/');
})->name('register');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user-logout', [App\Http\Controllers\HomeController::class, 'userLogout'])->name('user.logout');
Route::post('/featured_subcategory_product',[App\Http\Controllers\Front\FrontendController::class,'featuredSubcategoryProduct']);

Route::group(['namespace'=>'App\Http\Controllers\Front'],function(){
     //frontend route----------
    Route::get('/','FrontendController@Frontend')->name('frontend');
    Route::get('/single-product/{slug}','FrontendController@ProductDetails')->name('single.product');
     //Review route---------
     Route::post('/review-store','ReviewController@reviewStore')->name('review.store');

     //wishlist route---------
    Route::get('/wishlist','WishlistController@wishlist')->name('wishlist');
    Route::get('/add-to-wishlist/{id}','WishlistController@addWishlist');
    Route::get('/count-wishlist','WishlistController@countWishlist')->name('count.wishlist');
    Route::get('/wishlist-remove/{id}','WishlistController@WishlistRemove')->name('wishlist.remove');
    Route::get('/wishlist-clear','WishlistController@destroy')->name('wishlist.clear');
     //shop page route--------
    Route::get('/shop-page','ProductController@getProduct')->name('shop.page');
    Route::get('/shop/{category_slug?}/{subcategory_slug?}','ProductController@FilterProduct')->name('shop');
    Route::post('/product-filter','ProductController@productFilter');
     //user profile route--------
    Route::get('/user/logout','ProfileController@Logout')->name('logout');
    Route::post('/user/profile-update','ProfileController@prfileUpdate')->name('profile.update');
    Route::post('/user/password-update','ProfileController@userPasswordUpdate')->name('user.password.update');

    //product-quick-view
    Route::get('/product-quick-view/{id}','FrontendController@quickView');
});



