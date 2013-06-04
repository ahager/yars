@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ trans('site/login.title.login') }}}
@parent
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h1>{{{ trans('site/login.title.login') }}}</h1>
</div>

{{ Former::populate(Input::old()) }}
{{ Former::open('user/login') }}
{{ Former::hidden('_token', csrf_token()) }}

<fieldset>
    {{ Former::text('email', trans('site/login.label.username_e_mail'))->placeholder(trans('site/login.label.username_e_mail')) }}

    {{ Former::password('password', trans('site/login.label.password')) }}

    {{ Former::checkbox('remember', trans('site/login.label.remember')) }}

    {{ Former::actions()->large_success_submit(trans('site/login.button.signin'))
                        ->large_danger_link(trans('site/login.button.forgot'), 'forgot')
    }}
</fieldset>

{{ Former::close() }}
@stop
