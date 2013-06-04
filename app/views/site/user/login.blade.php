@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ trans('user/user.login') }}}
@parent
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h1>{{{ trans('user/user.login') }}}</h1>
</div>

{{ Former::populate(Input::old()) }}
{{ Former::open('user/login') }}
{{ Former::hidden('_token', csrf_token()) }}

<fieldset>
    {{ Former::text('email', trans('site.login.username_e_mail'))->placeholder(trans('site.login.username_e_mail')) }}

    {{ Former::password('password', trans('site.login.password')) }}

    {{ Former::checkbox('remember', trans('site.login.remember')) }}

    {{ Former::actions()->large_success_submit(trans('site.login.enter'))
                        ->large_danger_link(trans('site.login.forgot'), 'forgot')
    }}
</fieldset>

{{ Former::close() }}
@stop
