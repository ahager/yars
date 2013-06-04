@extends('admin/layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
:: Mis Negocios
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>
		Mis negocios

		<div class="pull-right">
			<a href="{{ URL::to('admin/businesses/create') }}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i> {{ trans('button.new') }}</a>
		</div>
	</h3>
</div>

<table class="table table-hover">
	<thead>
		<tr>
			<th class="span2">{{ trans('admin/businesses/table.slug') }}</th>
			<th class="span4">{{ trans('admin/businesses/table.name') }}</th>
			<th class="span2">{{ trans('admin/businesses/table.website') }}</th>
			<th class="span3">{{ trans('admin/businesses/table.created_at') }}</th>
			<th class="span3">{{ trans('admin/businesses/table.contacts') }}</th>
			<th class="span2">{{ trans('table.actions') }}</th>
		</tr>
	</thead>
	<tbody>
	@foreach ($businesses as $business)
		@if( Session::get('businessSlug') == $business->slug )
		<tr class="success">
		@else
		<tr>
		@endif
			<td>{{ HTML::link($business->slug, $business->slug) }}</td>
			<td>{{ $business->name }}</td>
			<td>{{ $business->website }}</td>
			<td>{{ $business->created_at }}</td>
			<td>{{ $business->contacts()->count() }}</td>
			<td>
				<a href="{{{ URL::to('admin/businesses/' . $business->id . '/edit') }}}" class="btn btn-mini">{{{ trans('button.edit') }}}</a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
@stop
