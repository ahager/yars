<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::group(array('prefix' => 'api'), function() {
    Route::get('businesses', function() {
        $businesses = Business::all(['id','name'])->toArray();
        return Response::JSON( $businesses );
    });
});

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('comment', 'Comment');
Route::model('post', 'Post');
Route::model('role', 'Role');
Route::model('contact', 'Contact');
Route::model('business', 'Business');

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{

    # User Management
    Route::get('users/{user}/show', 'AdminUsersController@getShow')
        ->where('user', '[0-9]+');
    Route::get('users/{user}/edit', 'AdminUsersController@getEdit')
        ->where('user', '[0-9]+');
    Route::post('users/{user}/edit', 'AdminUsersController@postEdit')
        ->where('user', '[0-9]+');
    Route::get('users/create', 'AdminUsersController@getCreate');
    Route::get('users/{contact}/create-for-contact', 'AdminUsersController@getCreate')
        ->where('contact', '[0-9]+');
    Route::post('users/create', 'AdminUsersController@postCreate');
    Route::post('users/{contact}/create-for-contact', 'AdminUsersController@postCreate')
        ->where('contact', '[0-9]+');
    Route::get('users/{user}/delete', 'AdminUsersController@getDelete')
        ->where('user', '[0-9]+');
    Route::post('users/{user}/delete', 'AdminUsersController@postDelete')
        ->where('user', '[0-9]+');
    Route::controller('users', 'AdminUsersController');

    # User Role Management
    Route::get('roles/{role}/show', 'AdminRolesController@getShow')
        ->where('role', '[0-9]+');
    Route::get('roles/{role}/edit', 'AdminRolesController@getEdit')
        ->where('role', '[0-9]+');
    Route::post('roles/{role}/edit', 'AdminRolesController@postEdit')
        ->where('role', '[0-9]+');
    Route::get('roles/{role}/delete', 'AdminRolesController@getDelete')
        ->where('role', '[0-9]+');
    Route::post('roles/{role}/delete', 'AdminRolesController@postDelete')
        ->where('role', '[0-9]+');
    Route::controller('roles', 'AdminRolesController');

    # Contacts
    Route::get('contacts', 'AdminContactsController@getIndex');
    Route::get('contacts/create', 'AdminContactsController@getCreate');
    Route::post('contacts/create', 'AdminContactsController@postCreate');
    Route::get('contacts/{contact}/show', 'AdminContactsController@getShow')
        ->where('contact', '[0-9]+');
    Route::get('contacts/{contact}/edit', 'AdminContactsController@getEdit')
        ->where('contact', '[0-9]+');
    Route::post('contacts/{contact}/edit', 'AdminContactsController@postEdit')
        ->where('contact', '[0-9]+');
    Route::get('contacts/{contact}/delete', 'AdminContactsController@getDelete')
        ->where('contact', '[0-9]+');
    Route::post('contacts/{contact}/delete', 'AdminContactsController@postDelete')
        ->where('contact', '[0-9]+');
    Route::get('contacts/{criteria}/search', 'AdminContactsController@getSearch')
        ->where('criteria', '[A-z0-9]+');
    Route::get('contacts/{contact}/link', 'AdminContactsController@getLinkUser')
        ->where('contact', '[0-9]+');
    Route::post('contacts/{contact}/link', 'AdminContactsController@postLinkUser')
        ->where('contact', '[0-9]+');
    Route::controller('contacts', 'AdminContactsController');

    # Business
    Route::get('businesses', 'AdminBusinessesController@getIndex');
    Route::get('businesses/create', 'AdminBusinessesController@getCreate');
    Route::post('businesses/create', 'AdminBusinessesController@postCreate');
    Route::get('businesses/{business}/show', 'AdminBusinessesController@getShow')
        ->where('business', '[0-9]+');
    Route::get('businesses/{business}/edit', 'AdminBusinessesController@getEdit')
        ->where('business', '[0-9]+');
    Route::post('businesses/{business}/edit', 'AdminBusinessesController@postEdit')
        ->where('business', '[0-9]+');
    Route::get('businesses/{business}/delete', 'AdminBusinessesController@getDelete')
        ->where('business', '[0-9]+');
    Route::post('businesses/{business}/delete', 'AdminBusinessesController@postDelete')
        ->where('business', '[0-9]+');
    Route::controller('businesses', 'AdminBusinessesController');

    # Admin Dashboard
    Route::controller('/', 'AdminDashboardController');
});

Route::group(array('prefix' => 'site', 'before' => 'auth'), function()
{
    Route::post('request/ownership', function(){
        if (!Confide::user()->hasRole('admin')) Confide::user()->saveRoles([1]);
        return Redirect::back()->with('success', 'Ya podes crear comercios');
    });

    Route::get('reservations', 'SiteController@getReservations');
    Route::get('/', 'SiteController@getIndex');
});

/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */

//:: User Account Routes ::
Route::post('user/{user}/edit', 'UserController@postEdit')
    ->where('user', '[0-9]+');

//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');

# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');

// Application Routes
Route::get('directory', function()
{
    $businesses = Business::all();
    return View::make('index', compact('businesses'));
});

# Business Switch
Route::get('{businessSlug}', function($businessSlug)
{
    // Return about us page
    $business = Business::getBySlug($businessSlug);
    if (!$business) return Redirect::to('directory')->with('error', Lang::get('site.messages.business_not_found', ['business'=>$businessSlug]) );
    Session::put('businessSlug', $businessSlug);
    return Redirect::to('site')->with('success', Lang::get('site.messages.welcome_to', ['business'=>$businessSlug]));
})->where('businessSlug', '[A-z0-9\-]+');

Route::get('/', function() {
    if (Auth::guest()) return Redirect::to('directory');
    return Redirect::to('site');
});
