<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8" />
		<title>
			@section('title')
			
			@show
		</title>
		<meta name="keywords" content="" />
		<meta name="author" content="" />
		<meta name="description" content="" />

		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSS
		================================================== -->
        {{ basset_stylesheets('public-css') }}

		<style>
		@section('styles')
		@show
		</style>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Favicons
		================================================== -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">
		<link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}">

		<link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
	</head>

	<body>
		<!-- To make sticky footer need to wrap in a div -->
		<div id="wrap">
		<!-- Navbar -->
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>

					<div class="nav-collapse collapse">
						<ul class="nav">
							<li {{ (Request::is('/') ? ' class="active"' : '') }}><a href="{{{ URL::to('site') }}}">{{Session::get('businessSlug')}}</a></li>
						</ul>

			                        <ul class="nav pull-right">
			                            @if (Auth::check())
                                        @if (Auth::user()->hasRole('admin'))
			                            <li>{{ HTML::link('admin', trans('site/nav.admin_panel')); }}</li>
                                        @endif
			                            <li><a href="{{{ URL::to('user') }}}">{{ trans('site/nav.logged_in_as', ['username' => Auth::user()->username]) }}</a></li>
			                            <li><a href="{{{ URL::to('user/logout') }}}">{{ trans('site/login.button.logout') }}</a></li>
			                            @else
                    					<li class="divider-vertical"></li>
                    					<li {{ (Request::is('user/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}">{{trans('site/login.button.signin')}}</a></li>
                    					<li class="dropdown">
                    					    <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon icon-user icon-white"></i> <strong class="caret"></strong></a>
                    					    <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
                    					        @include('login-small-form')
                    					    </div>
                    					</li>
			                            <li {{ (Request::is('user/register') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/create') }}}">{{trans('site/login.button.signup')}}</a></li>
			                            @endif
			                        </ul>
					</div>
					<!-- ./ nav-collapse -->
				</div>
			</div>
		</div>
		<!-- ./ navbar -->

		<!-- Container -->
		<div class="container">
			<!-- Notifications -->
			@include('notifications')
			<!-- ./ notifications -->

			<!-- Content -->
			@yield('content')
			<!-- ./ content -->
		</div>
		<!-- ./ container -->

		<!-- the following div is needed to make a sticky footer -->
		<div id="push"></div>
		</div>
		<!-- ./wrap -->


	    <div id="footer">
	      <div class="container">
	        <p class="muted credit">xbooking es un servicio de <a href="http://alariva.com/">alariva</a> software.</p>
	      </div>
	    </div>

		<!-- Javascripts
		================================================== -->
        @javascripts('public-js')
	</body>
</html>
