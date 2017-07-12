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

Route::group(['middleware'=>'auth'],function(){
    Route::get('/', function () {
        return view('home');
    })->name('home');
//    Route::any('user/create','UserController@create')->name('user.store');
//    Route::get('user','UserController@index')->name('user.index');
    Route::resource('user', 'UserController');
  
    Route::resource('urlgroups', 'UrlGroupController');
    Route::resource('urls', 'UrlController');
    Route::resource('usertypes', 'UserTypeController');
    Route::any('batchUpdate','UserTypeController@batchUpdate')->name('usertypes.batchUpdate');
    Route::post('language-switcher','LanguageController@switchLanguage');
    Route::post('/language/',array(
                                    'before' => 'csrf' ,
                                    'as' => 'language-switcher' ,
                                    'uses' => 'LanguageController@switchLanguage'
                                   )
    );
});


Route::get('/login', function () {
    return view('auth.login');
});

Route::group(['namespace'=>'Auth'],function(){
    Route::post('/login', ['uses'=>'LoginController@login'])->name('login.post');
    Route::get('/logout', ['uses'=>'LoginController@logout'])->name('auth.logout');
});


