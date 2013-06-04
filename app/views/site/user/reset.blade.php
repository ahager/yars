@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ trans('user/user.forgot_password') }}} ::
@parent
@stop

@include('notifications')

{{-- Content --}}
@section('content')
<div class="page-header">
	<h1>Forgot Password</h1>
</div>
{{ Confide::makeResetPasswordForm($token)->render() }}
@stop
