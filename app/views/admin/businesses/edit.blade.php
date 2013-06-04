@extends('admin/layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
	{{ trans('admin/businesses/title.edit') }}
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>
		{{ trans('businesses/businesses.title.edit') }}
		<div class="pull-right">
			{{ Button::link_inverse_small('admin/businesses', trans('button.back'))->with_icon('circle-arrow-left icon-white') }}
		</div>
	</h3>
</div>

{{ Former::horizontal_open()->autocomplete('off') }}
	<!-- CSRF Token -->
	{{ Former::hidden('_token', csrf_token()) }}

			<!-- First Name -->
			{{ Former::text('name', trans('businesses/businesses.name')) }}
			<!-- Slug -->
			{{ Former::text('slug', trans('businesses/businesses.slug'))->readonly() }}
			<!-- Slug -->
			{{ Former::text('description', trans('admin/businesses/businesses.description')) }}
			<!-- Website -->
			{{ Former::text('website', trans('businesses/businesses.website')) }}
			<!-- location -->
			{{ Former::text('location', trans('businesses/businesses.location')) }}
			<!-- phone -->
			{{ Former::text('phone', trans('businesses/businesses.phone')) }}

	<!-- Form Actions -->
	{{ Former::actions()->primary_submit( trans('button.update') )->reset( trans('button.reset') ) }}
	{{ HTML::link('admin/businesses', trans('button.cancel')) }}
</div>
{{ Former::close() }}
@stop