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

Route::group(['prefix' => 'admin-panel', 'namespace' => 'Admin', 'as' => 'admin.'], function () {

    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::get('/login', 'LoginController@index')->name('auth.login');
        Route::post('/login', 'LoginController@store')->name('auth.login.process');
        Route::get('/logout','LogoutController@index')->name('auth.logout');
    });

    Route::group(['middleware' => ['admin.auth', 'admin.globalvariable']], function () {

        Route::group(['middleware' => ['redirect.not.admin']], function () {
            Route::get('/', 'Dashboard\DashboardController@index')->name('index');
    //        Route::get('/', 'Setting\SettingController@index')->name('index');
            Route::resource('category_gallery', 'Gallery\CategoryGalleryController');
            Route::resource('gallery', 'Gallery\ImageController');
            Route::resource('gallery_video', 'Gallery\VideoController');
            // Route::resource('category_article', 'Article\CategoryArticleController');
            // Route::resource('article', 'Article\ArticleController');
            Route::resource('slider', 'Slider\SliderController');
            Route::resource('inbox', 'Inbox\InboxController');
            Route::resource('contact', 'Contact\ContactController');

            // Route::resource('fitur', 'Fitur\FiturController');
            // Route::resource('program', 'Program\ProgramController');
            // Route::resource('kontributor', 'Kontributor\KontributorController');
            Route::resource('service', 'Service\ServiceController');
            Route::resource('whyus', 'WhyUs\WhyUsController');

            // Setting
            Route::resource('setting', 'Setting\SettingController');
            // Profile FKG UHT
            Route::resource('profile', 'ProfileFkg\ProfileFkgController');

            // Social Media
            // Route::resource('social_media', 'SocialMedia\SocialMediaController');

            // Sub Category
            Route::resource('sub_category', 'SubCategory\SubCategoryController');

            Route::resource('/user', 'Setting\UserController');
        });

        Route::get('/change-password', 'Setting\ChangePasswordController@index')->name('password.index');
        Route::post('/change-password', 'Setting\ChangePasswordController@store')->name('password.store');
    });
});
