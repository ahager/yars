@extends('admin/layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
	{{ trans('admin/business.title.create') }}
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>
		{{ trans('admin/business.title.create') }}
		<div class="pull-right">
			{{ Button::link_inverse_small('admin/businesses', trans('button.back'))->with_icon('circle-arrow-left icon-white') }}
		</div>
	</h3>
</div>

{{ Former::horizontal_open()->autocomplete('off') }}
	<!-- CSRF Token -->
	{{ Former::hidden('_token', csrf_token()) }}

			<!-- First Name -->
			{{ Former::text('name', trans('admin/business.label.name')) }}
			<!-- Slug -->
			{{ Former::text('slug', trans('admin/business.label.slug')) }}

			{{ Former::text('description', trans('admin/business.label.description')) }}
			<!-- Website -->
			{{ Former::text('website', trans('admin/business.label.website')) }}

	<!-- Form Actions -->
	{{ Former::actions()->primary_submit( trans('button.create') )->reset( trans('button.reset') ) }}
	{{ HTML::link('admin/businesses', trans('button.cancel')) }}
</div>
{{ Former::close() }}
@stop