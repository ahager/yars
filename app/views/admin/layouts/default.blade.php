<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8" />
		<title>
			@section('title')
			xbooking
			@show
		</title>
		<meta name="keywords" content="" />
		<meta name="author" content="alariva" />
		<meta name="description" content="" />

		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSS
		================================================== -->
        {{ Basset::show('admin-css.css') }}

		<style>
		@section('styles')
		body {
			padding: 60px 0;
		}
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
		<!-- Container -->
		<div class="container">
			<!-- Navbar -->
			<div class="navbar navbar-inverse navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<div class="nav-collapse collapse">
							<ul class="nav">
								<li{{ (Request::is('admin') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin') }}}"><i class="icon-home icon-white"></i> {{ Session::get('businessSlug'); }}</a></li>
								<li class="dropdown{{ (Request::is('admin/users*|admin/roles*') ? ' active' : '') }}">
									<a class="dropdown-toggle" data-toggle="dropdown" href="{{{ URL::to('admin/users') }}}">
										<i class="icon-user icon-white"></i> {{ trans('menu.users') }}<span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										<li{{ (Request::is('admin/users*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/users') }}}"><i class="icon-user"></i> {{ trans('menu.users') }}</a></li>
										<li{{ (Request::is('admin/roles*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/roles') }}}"><i class="icon-user"></i> {{ trans('menu.roles') }}</a></li>
										<li{{ (Request::is('admin/contacts*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/contacts') }}}"><i class="icon-user"></i> {{ trans('menu.contacts') }}</a></li>
										<li{{ (Request::is('admin/businesses*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/businesses') }}}"><i class="icon-rocket"></i> {{ trans('menu.businesses') }}</a></li>
									</ul>
								</li>
							</ul>
							<ul class="nav pull-right">
								<li><a href="{{{ URL::to('/') }}}">{{ trans('menu.view_homepage') }}</a></li>
								<li class="divider-vertical"></li>
								<li>
									<div class="btn-group">
										<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
											<i class="icon-user"></i> {{{ Auth::user()->username }}}	<span class="caret"></span>
										</a>
										<ul class="dropdown-menu">
											<li><a href="{{{ URL::to('user/settings') }}}"><i class="icon-wrench"></i> {{ trans('menu.settings') }}</a></li>
											<li class="divider"></li>
											<li><a href="{{{ URL::to('user/logout') }}}"><i class="icon-share"></i> {{ trans('menu.logout') }}</a></li>
										</ul>
									</div>
								</li>
							</ul>
						</div>
						<!-- ./ nav-collapse -->
					</div>
					<!-- ./ container-fluid -->
				</div>
				<!-- ./ navbar-inner -->
			</div>
			<!-- ./ navbar -->

			<!-- Notifications -->
			@include('notifications')
			<!-- ./ notifications -->

			<!-- Content -->
			@yield('content')
			<!-- ./ content -->
		</div>
		<!-- ./ container -->

		<!-- Javascripts
		================================================== -->
		{{ Basset::show('admin-js.js') }}        
        {{ basset_stylesheets('jquery-datepicker') }}
     	{{ basset_javascripts('jquery-datepicker') }}

        <script>
            $('.wysihtml5').wysihtml5();
        </script>
        @yield('scripts')

        <script type="text/javascript" charset="utf-8">
            $(prettyPrint);
        </script>
	</body>
</html>
