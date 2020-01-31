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

//Route::get('/', function () {
//    return view('welcome');
//});


Route::namespace('Backend')->group(function () {
    Route::prefix('nedmin')->group(function () {
        Route::get('/dashboard', 'DefaultController@index')->name('nedminIndex')->middleware('admin');
        Route::get('', 'DefaultController@login')->name('nedminLogin');
        Route::get('logout', 'DefaultController@logout')->name('nedminLogout');
        Route::post('login', 'DefaultController@authenticate')->name('nedminAuth');
    });

    Route::middleware(['admin'])->group(function () {
        Route::prefix('nedmin/settings')->group(function () {
            Route::get('/', 'SettingsController@index')->name('settingsIndex');
            Route::post('', 'SettingsController@sortable')->name('settingsSortable');
            Route::get('/delete/{id}', 'SettingsController@destroy');
            Route::get('/edit/{id}', 'SettingsController@edit')->name('settingsEdit');
            Route::post('/{id}', 'SettingsController@update')->name('settingsUpdate');
        });
    });
});

Route::namespace('Backend')->group(function () {
    Route::prefix('nedmin')->group(function () {
        Route::middleware(['admin'])->group(function () {

            //BLOG
            Route::post('/blog/sortable', 'BlogController@sortable')->name('blogSortable');
            Route::resource('blog', 'BlogController');
            //PAGE
            Route::post('/page/sortable', 'PageController@sortable')->name('pageSortable');
            Route::resource('page', 'PageController');
            //SLIDER
            Route::post('/slider/sortable', 'SliderController@sortable')->name('sliderSortable');
            Route::resource('slider', 'SliderController');
            //ADMIN
            Route::post('/user/sortable', 'UserController@sortable')->name('userSortable');
            Route::resource('user', 'UserController');
        });
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('frontend')->group(function () {
    Route::get('/', 'DefaultController@index')->name('homeIndex');
//    BLOG
    Route::get('/blog', 'BlogController@index')->name('blogIndex');
    Route::get('/blog/{slug}', 'BlogController@detail')->name('blogDetail');
//    PAGE
    Route::get('/page/{slug}', 'PageController@detail')->name('pageDetail');

    //CONTACT
    Route::get('/contact', 'DefaultController@contact')->name('contact');
});

