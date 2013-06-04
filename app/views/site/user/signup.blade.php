{{ Former::open( (Confide::checkAction('UserController@store')) ?: URL::to('user') ) }}
    {{ Former::hidden('_token', csrf_token()) }}
    <fieldset>
        {{ Former::text('username', trans('site/login.label.username')) }}

        {{ Former::text('email', trans('site/login.label.email'))->inlineHelp(trans('site/login.hint.confirmation_required')) }}

        {{ Former::password('password', trans('site/login.label.password')) }}

        {{ Former::password('password_confirmation', trans('site/login.label.password_confirmation')) }}

        @if ( Session::get('notice') )
            <div class="alert">{{ Session::get('notice') }}</div>
        @endif

        {{ Former::actions()->large_primary_submit('site/login.button.signup')
                            ->large_success_link(trans('site/login.button.already_registered?'), '/user/login') }}

    </fieldset>
{{ Former::close() }}
