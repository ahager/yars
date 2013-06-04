@extends('admin/layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
:: Contact Management
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>
		Contact Management

		<div class="pull-right">
			<a href="{{ URL::to('admin/contacts/create') }}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i> {{ trans('button.new') }}</a>
		</div>
	</h3>
</div>

<table class="table table-hover">
	<thead>
		<tr>
			<th class="span2">{{ trans('admin/contacts/table.username') }}</th>
			<th class="span4">{{ trans('admin/contacts/table.fullname') }}</th>
			<th class="span2">{{ trans('admin/contacts/table.nin') }}</th>
			<th class="span1">{{ trans('admin/contacts/table.age') }}</th>
			<th class="span3">{{ trans('admin/contacts/table.birthdate') }}</th>
			<th class="span3">{{ trans('admin/contacts/table.created_at') }}</th>
			<th class="span2">{{ trans('table.actions') }}</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($contacts as $contact)
		<tr>
			<td>
				@if ($contact->user)
					<a href="{{{ URL::to('admin/users/' . $contact->user->id . '/edit') }}}" class="btn btn-mini btn-success">{{ $contact->username }}</a>
				@else
					<a href="{{{ URL::to('admin/contacts/' . $contact->id . '/link') }}}" class="btn btn-mini btn-primary">{{{ trans('button.link') }}}</a>
				@endif
			</td>
			<td>
				{{ HTML::image("/assets/img/icon-gender-{$contact->gender}-small.png") }}&nbsp;
				
				<a href="{{{ URL::to('admin/contacts/' . $contact->id . '/show') }}}">{{ $contact->inverseFullname }}</a>
			</td>
			<td>{{ $contact->nin }}</td>
			<td>{{ $contact->age }}</td>
			<td>{{ $contact->birthdate }}</td>
			<td>{{ $contact->created_at() }}</td>
			<td>
				<a href="{{{ URL::to('admin/contacts/' . $contact->id . '/edit') }}}" class="btn btn-mini">{{{ trans('button.edit') }}}</a>

				@if (Auth::user()->id != $contact->id )
				<a href="{{{ URL::to('admin/contacts/' . $contact->id . '/delete') }}}" class="btn btn-mini btn-danger">{{{ trans('button.delete') }}}</a>
				@endif
			</td>

		</tr>
		@endforeach
	</tbody>
</table>
@stop
