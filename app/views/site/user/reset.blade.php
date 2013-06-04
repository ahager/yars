@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{ trans('site/login.title.forgot_password') }}
@parent
@stop

@include('notifications')

{{-- Content --}}
@section('content')
<div class="page-header">
	<h1>{{ trans('site/login.title.forgot') }}</h1>
</div>

{{ Confide::makeResetPasswordForm($token)->render() }}

@stop
