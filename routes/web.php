<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
})->name('home');

/*Route::get('/events', function () {
    return view('pages.events');
});*/

Route::get('/events', 'EventController@list')->name('events');//TODO: mudar nome de funcao?? ou de controller??
Route::get('/event/{id}', 'EventController@show')->name('event');
/*
Route::get('/admin', function () {
    Route::get('/', 'EventController@show')->name('home');
});*/

Route::get('/admin', 'AdminController@show')->name('admin_home');

// Authentication
Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
Route::post('/login','Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');