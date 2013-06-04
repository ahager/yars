@extends('admin/layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
	{{ trans('admin/contacts/title.link-user') }}
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>{{ trans('admin/contacts/contacts.title.link_user') }}
		<div class="pull-right">
			{{ Button::link_inverse_small('admin/contacts', trans('button.back'))->with_icon('circle-arrow-left icon-white') }}
		</div>
	</h3>
</div>

<div class="container">
{{ Former::horizontal_open()->autocomplete('off') }}
	<!-- CSRF Token -->
	{{ Former::hidden('_token', csrf_token()) }}

	{{ Former::text('email', _('admin/contacts/contacts.email'))->placeholder(trans('admin/contacts/contacts.tip.email_of', ['name'=>$contact->fullname])) }}

	<!-- Form Actions -->
	{{ Former::actions()->primary_submit( trans('button.link') )->reset( trans('button.reset') ) }}
	{{ HTML::link('admin/contacts', trans('button.cancel')) }}
</div>
{{ Former::close() }}
@stop