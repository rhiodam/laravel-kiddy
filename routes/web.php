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



Route::get('/', function () {
    return view('layouts.index');
});
Route::get('/page2', function () {
    return view('pages.page2');
});

Route::resource('kontak','KontakController');


//email
Route::get('/email', function () {
    return view('mail.send_email');
});
Route::post('/sendEmail', 'mail\SendEmailController@sendEmail');


Route::get('/account/home_user', 'AccountController@index');
Route::get('/account/login', 'AccountController@login');
Route::post('/account/loginPost', 'AccountController@loginPost');
Route::get('/account/register', 'AccountController@register');
Route::post('/account/registerPost', 'AccountController@registerPost');
Route::get('/account/logout', 'AccountController@logout');