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

Route::get('/', 'HomeController@index');
Route::get('/anasayfa', 'HomeController@index')->name('home');
Route::get('/profil/{username?}', 'UserController@index')->name('profile');


Route::group(['prefix' => 'admin',  'middleware' => 'role'], function(){
    Route::get('anasayfa', 'adminController@index')->name('admin');
    Route::group(['prefix' => 'uye',  'middleware' => 'admin'], function(){
        Route::get('list', 'admin\UserController@index')->name('admin.users');
        Route::get('edit/{id}', 'admin\UserController@edit')->name('admin.user');
        Route::put('edit/{id}', 'admin\UserController@edit');
        Route::post('new', 'admin\UserController@new')->name('admin.newUser');
        Route::post('delete', 'admin\UserController@delete')->name('admin.deleteUser');
    });
    Route::prefix('urun')->group(function () {
        Route::get('list', 'admin\ProductController@index')->name('admin.products');
        Route::get('new', 'admin\ProductController@new')->name('admin.newProduct');
        Route::post('new', 'admin\ProductController@new');
        Route::get('verisons/{slug}', 'admin\ProductController@versions')->name('admin.vProduct');
        Route::post('verisons/{slug}', 'admin\ProductController@versions');
        Route::get('download/{id}', 'admin\ProductController@download')->name('admin.downloadVersion');
        Route::get('edit/{slug}', 'admin\ProductController@edit')->name('admin.product');
        Route::post('edit/{slug}', 'admin\ProductController@edit');
    });
    Route::prefix('kategori')->group(function () {
        Route::get('list', 'admin\CategoryController@index')->name('admin.categories');
        Route::post('list', 'admin\CategoryController@index');
    });
});


// Authentication Routes...
Route::get('girisyap', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('girisyap', 'Auth\LoginController@login');
Route::get('cikisyap', 'Auth\LoginController@logout')->name('logout');
Route::get('kayitol', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('kayitol', 'Auth\RegisterController@register');
Route::get('sifre/sifirla', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('sifre/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('sifre/guncelle/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('sifre/guncelle', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes...
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify'); // v6.x
/* Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify'); // v5.x */
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
