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

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes...
Route::get('girisyap', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('girisyap', 'Auth\LoginController@login');
Route::get('cikisyap', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('kayitol', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('kayitol', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('sifre/sifirla', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('sifre/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('sifre/guncelle/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('sifre/guncelle', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes...
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify'); // v6.x
/* Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify'); // v5.x */
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::get('/anasayfa', 'HomeController@index')->name('home');
Route::get('/panel', 'UserController@index')->name('panel');

Route::get('/admin/anasayfa', 'AdminController@index')->name('admin');
Route::get('/admin/uye/{id}', 'AdminController@uye')->name('admin.user');
Route::get('/admin/uyeler', 'AdminController@users')->name('admin.users');
Route::get('/admin/urunler', 'AdminController@products')->name('admin.products');
