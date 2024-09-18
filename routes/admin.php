<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'AdminLogin'])->name('admin.login');
//Golbal Route Here---------
 Route::get('/get-childcategory/{id}',[App\Http\Controllers\admin\CategoryController::class, 'getchildcategory']);

Route::group(['namespace'=>'App\Http\Controllers\Admin','middleware'=>'is_admin', 'prefix'=>'admin'],function(){
    Route::get('/home','AdminController@Admin')->name('admin.home');
    Route::get('/logout','AdminController@adminLogout')->name('admin.logout');
    Route::get('/password-change','AdminController@passwordChange')->name('password.change');
    Route::post('/password-update','AdminController@passwordUpdate')->name('password.update');
    Route::get('/profile','AdminController@AdminProfile')->name('admin.profile');
    Route::post('/profile-update','AdminController@profileUpdate')->name('admin.profile.update');

    //cateroy route here------
    Route::group(['prefix'=>'category'],function()
    {
        Route::get('/','CategoryController@index')->name('category');
        Route::post('/store','CategoryController@store')->name('category.store');
        Route::get('/edit/{id}','CategoryController@edit');
        Route::post('/update','CategoryController@update')->name('category.update');
        Route::delete('/delete/{id}','CategoryController@destroy')->name('category.delete');
    });
    //subcateroy route here------
    Route::group(['prefix'=>'subcategory'],function()
    {
        Route::get('/','SubcategoryController@index')->name('subcategory');
        Route::post('/store','SubcategoryController@store')->name('subcategory.store');
        Route::get('/edit/{id}','SubcategoryController@edit');
        Route::post('/update','SubcategoryController@update')->name('subcategory.update');
        Route::delete('/delete/{id}','SubcategoryController@destroy')->name('subcategory.delete');
    });
    //childcateroy route here------
    Route::group(['prefix'=>'childcategory'],function()
    {
        Route::get('/','ChildcategoryController@index')->name('childcategory');
        Route::post('/store','ChildcategoryController@store')->name('childcategory.store');
        Route::get('/edit/{id}','ChildcategoryController@edit');
        Route::post('/update','ChildcategoryController@update')->name('childcategory.update');
        Route::delete('/delete/{id}','childcategoryController@destroy')->name('childcategory.delete');
    });
    //Brand route here------
    Route::group(['prefix'=>'brand'],function()
    {
        Route::get('/','BrandController@index')->name('brand');
        Route::post('/store','BrandController@store')->name('brand.store');
        Route::get('/edit/{id}','BrandController@edit');
        Route::post('/update','BrandController@update')->name('brand.update');
        Route::delete('/delete/{id}','BrandController@destroy')->name('brand.delete');
    });
    //Color route here------
    Route::group(['prefix'=>'color'],function()
    {
        Route::get('/','ColorController@index')->name('color');
        Route::post('/store','ColorController@store')->name('color.store');
        Route::get('/edit/{id}','ColorController@edit');
        Route::post('/update','ColorController@update')->name('color.update');
        Route::delete('/delete/{id}','ColorController@destroy')->name('color.delete');
    });
    //Color route here------
    Route::group(['prefix'=>'warehouse'],function()
    {
        Route::get('/','WarehouseController@index')->name('warehouse');
        Route::post('/store','WarehouseController@store')->name('warehouse.store');
        Route::get('/edit/{id}','WarehouseController@edit');
        Route::post('/update','WarehouseController@update')->name('warehouse.update');
        Route::delete('/delete/{id}','WarehouseController@destroy')->name('warehouse.delete');
    });
    //Warehouse route here------
    Route::group(['prefix'=>'warehouse'],function()
    {
        Route::get('/','WarehouseController@index')->name('warehouse');
        Route::post('/store','WarehouseController@store')->name('warehouse.store');
        Route::get('/edit/{id}','WarehouseController@edit');
        Route::post('/update','WarehouseController@update')->name('warehouse.update');
        Route::delete('/delete/{id}','WarehouseController@destroy')->name('warehouse.delete');
    });
    //Pickuppoint route here------
    Route::group(['prefix'=>'pickuppoint'],function()
    {
        Route::get('/','PickuppointController@index')->name('pickuppoint');
        Route::post('/store','PickuppointController@store')->name('pickuppoint.store');
        Route::get('/edit/{id}','PickuppointController@edit');
        Route::post('/update','PickuppointController@update')->name('pickuppoint.update');
        Route::delete('/delete/{id}','PickuppointController@destroy')->name('pickuppoint.delete');
    });
    
    //Product Route here--------
    Route::group(['prefix'=>'product'],function()
    {
        Route::get('/','ProductController@index')->name('product');
        Route::get('/digital','ProductController@digital')->name('digital.product');
        Route::get('/create','ProductController@create')->name('create.product');
        Route::post('/store','ProductController@store')->name('product.store');
        Route::get('/edit/{id}','ProductController@edit')->name('product.edit');
        Route::post('/update','ProductController@update')->name('product.update');
        Route::delete('/delete/{id}','ProductController@destroy')->name('product.delete');
        Route::get('/status-active/{id}','ProductController@statusActive');
        Route::get('/status-deactive/{id}','ProductController@statusDeactive');
        Route::get('/featured-active/{id}','ProductController@featuredActive');
        Route::get('/featured-deactive/{id}','ProductController@featuredDeactive');
        Route::get('/today-deal-active/{id}','ProductController@todaydealActive');
        Route::get('/today-deal-deactive/{id}','ProductController@todaydealDeactive');
    });

    //Blog Category route here------
    Route::group(['prefix'=>'blog-category'],function()
    {
        Route::get('/','BlogcategoryController@index')->name('blog.category');
        Route::post('/store','BlogcategoryController@store')->name('blogcategory.store');
        Route::get('/edit/{id}','BlogcategoryController@edit');
        Route::post('/update','BlogcategoryController@update')->name('blogcategory.update');
        Route::delete('/delete/{id}','BlogcategoryController@destroy')->name('blogcategory.delete');
    });
    //Blog post route here------
    Route::group(['prefix'=>'blog-post'],function()
    {
        Route::get('/','BlogpostController@index')->name('blog.post');
        Route::post('/store','BlogpostController@store')->name('blog.post.store');
        Route::get('/edit/{id}','BlogpostController@edit');
        Route::post('/update','BlogpostController@update')->name('blog.post.update');
        Route::delete('/delete/{id}','BlogpostController@destroy')->name('blog.post.delete');
    });
    //Coupon route here------
    Route::group(['prefix'=>'coupon'],function()
    {
        Route::get('/','CouponController@index')->name('coupon');
        Route::post('/store','CouponController@store')->name('coupon.store');
        Route::get('/edit/{id}','CouponController@edit')->name('coupon.edit');
        Route::post('/update','CouponController@update')->name('coupon.update');
        Route::delete('/delete/{id}','CouponController@destroy')->name('coupon.delete');
    });
    //Campaing route here------
    Route::group(['prefix'=>'campaing'],function()
    {
        Route::get('/','CampaingController@index')->name('campaing');
        Route::post('/store','CampaingController@store')->name('campaing.store');
        Route::get('/edit/{id}','CampaingController@edit')->name('campaing.edit');
        Route::post('/update','CampaingController@update')->name('campaing.update');
        Route::delete('/delete/{id}','CampaingController@destroy')->name('campaing.delete');
    });
    //Shipping Country Route here--------
    Route::group(['prefix'=>'shipping-country'],function()
    {
        Route::get('/','CountryController@index')->name('shipping.country');
        Route::post('/store','CountryController@store')->name('shipping.country.store');
        Route::get('/edit/{id}','CountryController@edit');
        Route::post('/update','CountryController@update')->name('shipping.country.update');
        Route::delete('/delete/{id}','CountryController@destroy')->name('shipping.country.delete');
        Route::get('/hide/{id}','CountryController@hide');
        Route::get('/show/{id}','CountryController@show');
    });
    //Shipping State Route here--------
    Route::group(['prefix'=>'shipping-state'],function()
    {
        Route::get('/','StateController@index')->name('shipping.state');
        Route::post('/store','StateController@store')->name('shipping.state.store');
        Route::get('/edit/{id}','StateController@edit');
        Route::post('/update','StateController@update')->name('shipping.state.update');
        Route::delete('/delete/{id}','StateController@destroy')->name('shipping.state.delete');
        Route::get('/hide/{id}','StateController@hide');
        Route::get('/show/{id}','StateController@show');
    });
    //Shipping City Route here--------
    Route::group(['prefix'=>'shipping-city'],function()
    {
        Route::get('/','CityController@index')->name('shipping.city');
        Route::post('/store','CityController@store')->name('shipping.city.store');
        Route::get('/edit/{id}','CityController@edit');
        Route::post('/update','CityController@update')->name('shipping.city.update');
        Route::delete('/delete/{id}','CityController@destroy')->name('shipping.city.delete');
        Route::get('/hide/{id}','CityController@hide');
        Route::get('/show/{id}','CityController@show');
    });

    //Shipping Route here--------
    Route::group(['prefix'=>'shipping'],function()
    {
        Route::get('/','ShippingController@index')->name('shipping');
        Route::post('/store','ShippingController@store')->name('shipping.store');
        Route::get('/edit/{id}','ShippingController@edit');
        Route::post('/update','ShippingController@update')->name('shipping.update');
        Route::delete('/delete/{id}','ShippingController@destroy')->name('shipping.delete');
    });

    //Page Route here--------
    Route::group(['prefix'=>'page'],function()
    {
        Route::get('/','PageController@index')->name('page');
        Route::post('/store','PageController@store')->name('page.store');
        Route::get('/edit/{id}','PageController@edit');
        Route::post('/update','PageController@update')->name('page.update');
        Route::delete('/delete/{id}','PageController@destroy')->name('page.delete');
    });
    //Tax Route here--------
    Route::group(['prefix'=>'tax'],function()
    {
        Route::get('/','TaxController@index')->name('tax');
        Route::post('/store','TaxController@store')->name('tax.store');
        Route::get('/edit/{id}','TaxController@edit');
        Route::post('/update','TaxController@update')->name('tax.update');
        Route::delete('/delete/{id}','TaxController@destroy')->name('tax.delete');
        Route::get('/deactive/{id}','TaxController@deactive');
        Route::get('/active/{id}','TaxController@active');
    });
    //language Route here--------
    Route::group(['prefix'=>'language'],function()
    {
        Route::get('/','LanguageController@index')->name('language');
        Route::post('/store','LanguageController@store')->name('language.store');
        Route::get('/edit/{id}','LanguageController@edit');
        Route::post('/update','LanguageController@update')->name('language.update');
        Route::delete('/delete/{id}','LanguageController@destroy')->name('language.delete');
        Route::get('/deactive/{id}','LanguageController@deactive');
        Route::get('/active/{id}','LanguageController@active');
    });
    //currency Route here--------
    Route::group(['prefix'=>'currency'],function()
    {
        Route::get('/','CurrencyController@index')->name('currency');
        Route::post('/store','CurrencyController@store')->name('currency.store');
        Route::get('/edit/{id}','CurrencyController@edit');
        Route::post('/update','CurrencyController@update')->name('currency.update');
        Route::delete('/delete/{id}','CurrencyController@destroy')->name('currency.delete');
        Route::get('/deactive/{id}','CurrencyController@deactive');
        Route::get('/active/{id}','CurrencyController@active');
    });
    //banner Route here--------
    Route::group(['prefix'=>'banner'],function()
    {
        Route::get('/','bannerController@index')->name('banner');
        Route::get('/create','bannerController@create')->name('banner.create');
        Route::post('/store','bannerController@store')->name('banner.store');
        Route::get('/edit/{id}','bannerController@edit')->name('banner.edit');
        Route::post('/update/{id}','bannerController@update')->name('banner.update');
        Route::delete('/delete/{id}','bannerController@destroy')->name('banner.delete');
        Route::get('/active/{id}','bannerController@active');
        Route::get('/deactive/{id}','bannerController@deactive');
    });
    //setting Route here--------
    Route::group(['prefix'=>'setting'],function()
    {
        //SEO setting Route here--------
        Route::get('/seo','SettingController@seoSetting')->name('seo.setting');
        Route::post('/seo-update/{id}','SettingController@update')->name('seo.setting.update');

        //smtp setting route here-----------
        Route::get('/smtp','SettingController@smtpSetting')->name('smtp');
        Route::post('/smtp-update/{id}','SettingController@smtpUpdate')->name('smtp.setting.update');
    });
    //Website Route here--------
    Route::group(['prefix'=>'website-setting'],function()
    {
        //Footer setting Route here--------
        Route::get('/','WebsiteController@index')->name('website.setting');
        Route::post('/update/{id}','WebsiteController@websiteUpdate')->name('website.update');
        Route::get('/footer','WebsiteController@Footer')->name('footer');
        Route::post('/footer-widget-update/{id}','WebsiteController@update')->name('footer.widget.update');
        Route::post('/about-widget-update/{id}','WebsiteController@aboutUpdate')->name('about.widget.update');
        Route::post('/contact-widget-update/{id}','WebsiteController@contactUpdate')->name('contact.widget.update');
        Route::post('/footer-bottom-update/{id}','WebsiteController@footerBottomUpdate')->name('footer.bottom.update');
    });
});
