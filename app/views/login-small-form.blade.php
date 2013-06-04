<div class="well">
{{ Former::open('user/login') }}
{{ Former::hidden('_token', csrf_token()) }}

    {{ Former::text('email', trans('site.login.username_e_mail'))->placeholder(trans('site.login.username_e_mail')) }}

    {{ Former::password('password', trans('site.login.password')) }}

    {{ Former::checkbox('remember', trans('site.login.remember')) }}

    {{ Former::success_submit(trans('site.login.enter')) }}
    {{ Button::danger_link('user/forgot', trans('site.login.forgot')) }}

    <label style="text-align:center;margin-top:5px">{{ trans('general.or') }}</label>
    <input disabled class="btn btn-primary btn-block" type="button" id="sign-in-google" value="Sign In with Google">
    <input disabled class="btn btn-primary btn-block" type="button" id="sign-in-twitter" value="Sign In with Twitter">
{{ Former::close() }}
</div>