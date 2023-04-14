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

Route::get('/', 'HomeController@list')->name('home');

/*Route::get('/events', function () {
    return view('pages.events');
});*/

// Events
Route::get('/events', 'EventController@list')->name('events');//TODO: mudar nome de funcao?? ou de controller??
Route::get('/event/{id}', 'EventController@show')->name('event');
Route::get('/tags/{id}/events', 'TagController@show')->name('tags.events');
Route::get('/create_event', 'EventController@createEventForm')->name('create.event');
Route::post('/create_event', 'EventController@createEvent')->name('create.event');
Route::get('/edit_event/{id}', 'EventController@editEventForm')->name('edit.event');
Route::post('/edit_event/{id}', 'EventController@editEvent')->name('edit.event');
Route::get('/delete_event/{id}', 'EventController@deleteEvent')->name('delete.event');
/*
Route::get('/admin', function () {
    Route::get('/', 'EventController@show')->name('home');
});*/
Route::get("/admin", function(){
    return view("pages.admin");
 });

Route::get('/admin/events', 'EventController@adminDashboardEvents')->name('admin.events');

Route::get("/admin/services", function(){
    return view("pages.adminServices");
});
Route::get("/admin/gis", function(){
    return view("pages.adminGis");
});

/* TODO
Route::get('/admin/events', 'EventController@')->name('admin.events');
Route::get('/admin/services', 'EventController@')->name('admin.services');
Route::get('/admin/gis', 'EventController@')->name('admin.gi');
*/
Route::post('/requests/{id}/{action}', 'EventController@updateStatus')->name('requests.status.update')->where(['action' => '(Accepted|Rejected)']);

// Tags
Route::get('/create_tag', 'TagController@createTagForm')->name('create.tag');
Route::post('/create_tag', 'TagController@createTag')->name('create.tag');



// USER
Route::get('/my_requests', 'UserController@showRequests')->name('my.requests');



// Authentication
Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
Route::post('/login','Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Static pages
Route::get("/about", function(){
    return view("pages.about");
 });
 Route::get("/faq", function(){
    return view("pages.faq");
 });
 Route::get("/contacts", function(){
    return view("pages.contact");
 });
