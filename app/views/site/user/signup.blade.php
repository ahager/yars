{{ Former::open( (Confide::checkAction('UserController@store')) ?: URL::to('user') ) }}
    {{ Former::hidden('_token', csrf_token()) }}
    <fieldset>
        {{ Former::text('username', trans('site.login.username')) }}

        {{ Former::text('email', trans('site.login.email'))->inlineHelp(trans('site.login.confirmation_required')) }}

        {{ Former::password('password', trans('site.login.password')) }}

        {{ Former::password('password_confirmation', trans('site.login.password_confirmation')) }}

        @if ( Session::get('notice') )
            <div class="alert">{{ Session::get('notice') }}</div>
        @endif

        {{ Former::actions()->large_primary_submit('button.submit')
                            ->large_success_link(trans('site.login.already_registered?'), '/user/login') }}

    </fieldset>
{{ Former::close() }}
