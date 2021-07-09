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

use Illuminate\Support\Facades\Mail;

Route::group(['namespace' => 'Website', 'middleware' => ['globalvariable']], function () {
    Route::get('/','Home\HomeController@index')->name('landing.index');

    Route::get('/about','About\AboutController@index')->name('about.index');
    Route::get('/program','Program\ProgramController@index')->name('program.index');
    Route::get('/program/{id}/{title}','Program\ProgramController@show')->name('program.show');
    Route::get('/fitur','Fitur\FiturController@index')->name('fitur.index');
    Route::get('/fitur/{id}/{title}','Fitur\FiturController@show')->name('fitur.show');
    Route::get('/article', 'Article\ArticleController@index')->name('article.index');
    Route::get('/article/{slug}', 'Article\ArticleController@show')->name('article.show');
    Route::get('/article/category/{slug}', 'Article\ArticleController@category')->name('article.category');
    Route::get('/gallery','Gallery\PhotoController@index')->name('gallery.index');
    Route::get('/gallery/{slug}', 'Gallery\PhotoController@show')->name('gallery.show');
    Route::get('/gallery/{slug}', 'Gallery\SubCategoryController@index')->name('gallery.sub_gallery');
    Route::get('/contact','Contact\ContactController@index')->name('contact.index');
    Route::post('/contact/store', 'Contact\ContactController@store')->name('contact.store');

    Route::get('/profile','ProfileFkg\ProfileFkgController@index')->name('profile.index');

    Route::get('/email', function () {
        Mail::raw(
            "Test"
            , function ($message) {
            $message->to('emosekolah@gmail.com');
            $message->from('dentisphere@aksamedia.com');
            $message->subject("Message from contact us");
        });
    });

    Route::get('/flash-file-too-big', function () {
        return redirect()->route('full_text.index')->with(['status' => 'danger', 'message' => 'File size too large']);
    })->name('flash.max');
});
