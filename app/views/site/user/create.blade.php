@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ trans('user/user.register') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h1>{{ trans('user/user.register') }}</h1>
</div>

@include('site/user/signup')

@stop
