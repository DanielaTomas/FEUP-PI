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
Route::get('/events', 'EventController@list')->name('events'); //TODO: mudar nome de funcao?? ou de controller??
Route::get('/event/{id}', 'EventController@show')->name('event');
Route::get('/tags/{id}/events', 'TagController@show')->name('tags.events');
Route::get('/categories/events', 'CategoryController@showEventCategories')->name('categories.events');
Route::get('/organicunits/{id}/events', 'OrganicUnitController@show')->name('organics.events');

// SERVICES

Route::get('/services','ServiceController@list')->name('services');
//Route::get('/service/{id}','ServiceController@createServiceForm')->name('create.service');
Route::get('/service/{id}','ServiceController@show')->name('show.service');
Route::get('/service/{id}/create','ServiceController@createServiceForm')->name('create.service');
Route::post('/create.service', 'ServiceController@createService')->name('create.service');
Route::get('/delete.service/{id}', 'ServiceController@deleteService')->name('delete.service');
Route::get('/show.service/{id}', 'ServiceController@showServiceForm')->name('show.service');
Route::get('/edit.service/{id}', 'ServiceController@editServiceForm')->name('edit.service');
Route::post('/edit.service/{id}', 'ServiceController@editService')->name('edit.service');
Route::post('/new.service', 'ServiceController@createNewService')->name('new.service');



//SEARCH
Route::get('/users/search', 'UserController@search')->name('users.search');





// Admin
///Events
/*
Route::get('/admin', function () {
    Route::get('/', 'EventController@show')->name('home');
});*/
Route::get("/admin", 'AdminController@show');
Route::get('/admin/events', function () {
    return view("pages.adminEvents");
});
Route::get('/admin/eventsCurrent', 'EventControllerAdmin@showCurrent');
Route::get('/admin/eventsPending', 'EventControllerAdmin@showPending');
Route::post('/requests/{id}/{action}', 'EventControllerAdmin@updateStatus')->name('requests.status.update')->where(['action' => '(Accepted|Rejected)']);
Route::get("/admin/user/{id}/assign/gi", 'userControllerAdmin@assignGI')->name('users.assignRole');

//TODO: adicionar permission checks as routes por baixo
Route::get('/create_event', 'EventController@createEventForm')->name('create.event');
Route::post('/create_event', 'EventController@createEvent')->name('create.event');
Route::get('/edit_event/{id}', 'EventController@editEventForm')->name('edit.event');
Route::post('/edit_event/{id}', 'EventController@editEvent')->name('edit.event');
Route::get('/delete_event/{id}', 'EventController@deleteEvent')->name('delete.event');






Route::get("/admin/services", function () {
    $organicunits = app('App\Http\Controllers\OrganicUnitController')->getOrganicUnits();
    return view("pages.adminServices", ['organicunits' => $organicunits]);
});
Route::get("/admin/gis", function () {
    $organicunits = app('App\Http\Controllers\OrganicUnitController')->getOrganicUnits();
    return view('pages.adminGis', ['organicunits' => $organicunits]);
});

/* TODO: substituir as duas routes de cima por estas
Route::get('/admin/services', 'EventController@adminDashboardServices')->name('admin.services');
Route::get('/admin/gis', 'EventController@adminDashboardGis')->name('admin.gis');
*/


// Tags
Route::get('/create_tag', 'TagController@createTagForm')->name('create.tag');
Route::post('/create_tag', 'TagController@createTag')->name('create.tag');



// USER
Route::get('/my_requests', 'UserController@showRequests')->name('my.requests');



// Authentication
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// RSS
Route::feeds();

//Static pages
Route::get("/about", function () {
    return view("pages.about");
});
Route::get("/faq", function () {
    return view("pages.faq");
});
Route::get("/contacts", function () {
    return view("pages.contact");
});
