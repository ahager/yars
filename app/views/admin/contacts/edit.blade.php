@extends('admin/layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
	{{ trans('admin/contacts/title.edit') }}
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>
		{{ trans('admin/contacts/title.edit') }}
		<div class="pull-right">
			{{ Button::link_inverse_small('admin/contacts', trans('button.back'))->with_icon('circle-arrow-left icon-white') }}
		</div>
	</h3>
</div>

<!-- Tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-contact" data-toggle="tab"> {{ trans('admin/contacts/table.tabs.general') }}</a></li>
	<li><a href="#tab-extra" data-toggle="tab">{{ trans('admin/contacts/table.tabs.extra') }}</a></li>
	<li><a href="#tab-channels" data-toggle="tab">{{ trans('admin/contacts/table.tabs.channels') }}</a></li>
</ul>
<!-- ./ tabs -->

{{ Former::populate($contact) }}

{{ Former::horizontal_open()->autocomplete('off') }}
	<!-- CSRF Token -->
	{{ Former::hidden('_token', csrf_token()) }}

	<!-- Tabs Content -->
	<div class="tab-content">
		<!-- General tab -->
		<div class="tab-pane active" id="tab-contact">
			<!-- First Name -->
			{{ Former::text('first_name', _('admin/contacts/contacts.first_name')) }}
			<!-- Last Name -->
			{{ Former::text('last_name', _('admin/contacts/contacts.last_name')) }}
			<!-- Gender -->
			{{ Former::select('gender', _('admin/contacts/contacts.gender'))->options(['female'=>trans('general.female'), 'male'=>trans('general.male') ]) }}
			<!-- Birthdate -->
			<div class="control-group {{ $errors->has('birthdate') ? 'error' : '' }}">
				<label class="control-label" for="birthdate">{{ trans('admin/contacts/contacts.birthdate')}}</label>
				<div class="controls">
					<div class="input-append date" data-date="{{ Input::old('birthdate') }}" data-date-format="yyyy-mm-dd" data-date-viewmode="decade">
						<input type="text" name="birthdate" id="birthdate" value="{{ Input::old('birthdate', $contact->birthdate) }}" />
						<span class="add-on"><i class="icon-calendar"></i></span>
					</div>
					{{ $errors->first('birthdate', '<span class="help-inline">:message</span>') }}
				</div>
			</div>
		</div>

		<div class="tab-pane" id="tab-extra">
			<!-- Job -->
			{{ Former::text('job', _('admin/contacts/contacts.job')) }}		
			<!-- Postal Address -->
			{{ Former::text('postal_address', _('admin/contacts/contacts.postal_address')) }}
			<!-- Notes -->
			{{ Former::textarea('notes', _('admin/contacts/contacts.notes')) }}
			<!-- NIN -->
			{{ Former::text('nin', _('admin/contacts/contacts.nin')) }}
		</div>
	
		<div class="tab-pane" id="tab-channels">
			@include('admin/contacts/channels')
		</div>

	<!-- Form Actions -->
	{{ Former::actions()->primary_submit( trans('button.update') )->reset( trans('button.reset') ) }}
	{{ HTML::link('admin/contacts', trans('button.cancel')) }}
</div>
{{ Former::close() }}
@stop

@section('scripts')
<script>
	$(document).ready(function(){
		$("div.date").datepicker({startView:'decade', autoclose: true});
	});
</script>
@stop