<div class="well">
{{ Former::open('user/login') }}
{{ Former::hidden('_token', csrf_token()) }}

    {{ Former::text('email', trans('site/login.label.username_e_mail'))->placeholder(trans('site/login.label.username_e_mail')) }}

    {{ Former::password('password', trans('site/login.label.password')) }}

    {{ Former::checkbox('remember', trans('site/login.label.remember')) }}

    {{ Former::success_submit(trans('site/login.button.signin')) }}
    {{ Button::danger_link('user/forgot', trans('site/login.button.forgot')) }}

    <label style="text-align:center;margin-top:5px">{{ trans('app.or') }}</label>
    <input disabled class="btn btn-primary btn-block" type="button" id="sign-in-facebook" value="{{ trans('site/login.button.facebook') }}">
    <input disabled class="btn btn-primary btn-block" type="button" id="sign-in-google" value="{{ trans('site/login.button.google') }}">
    <input disabled class="btn btn-primary btn-block" type="button" id="sign-in-twitter" value="{{ trans('site/login.button.twitter') }}">
{{ Former::close() }}
</div>