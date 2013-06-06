<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

// Check for role on all admin routes
Entrust::routeNeedsRole( 'admin*', array('admin'), Redirect::to('site') );

App::before(function($request)
{

});

App::after(function($request, $response)
{
	
});


/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		Session::put('loginRedirect', Request::url());
		return Redirect::to('user/login');
		# return Redirect::guest('login');
	}
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/* Before going into the Admin panel we must check the user is Admin and owns the selected Business (businessSlug) */
Route::filter('business', function()
{
	if (Entrust::hasRole('admin'))
	{
		 $business = Business::getBySlug(Session::get('businessSlug', false));
		 # No Business or incorrect Business selected
		 if (!$business) return Redirect::to('admin/business')->with('warning', trans('site/msg.select_a_business_first'));
		 # The selected business is not owned, don't allow admin access
		 if (!Auth::user()->businesses->contains($business->id)) throw new NotAllowedException;
	}
});

/*
|--------------------------------------------------------------------------
| Role Permissions
|--------------------------------------------------------------------------
|
| Access filters based on roles.
|
*/




/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('user/login/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


