@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ trans('user/user.forgot_password') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h1>{{{ trans('user/user.forgot_password') }}}</h1>
</div>

@include('notifications')

{{ Former::open( (Confide::checkAction('UserController@do_forgot_password')) ?: URL::to('/user/forgot') ) }}
    {{ Former::hidden('_token', csrf_token()) }}

    <label for="email">{{{ trans('app.email') }}}</label>
    <div class="input-append">
        <input placeholder="{{{ trans('app.email') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">

        <input class="btn" type="submit" value="{{{ trans('button.submit_forgot') }}}">
    </div>

    @if ( Session::get('error') )
        <div class="alert alert-error">{{{ Session::get('error') }}}</div>
    @endif

    @if ( Session::get('notice') )
        <div class="alert">{{{ Session::get('notice') }}}</div>
    @endif

{{ Former::close() }}
@stop
