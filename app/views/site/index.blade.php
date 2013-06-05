@extends('site/layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
	{{ trans('site/index.title') }}
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>{{ trans('site/index.title' )}}</h3>
</div>

<div class="container">
@if($contacts->count() == 0)
	<div class="alert alert-info">{{ trans('site/index.msg.not_suscribed_to_any_business') }}</div>
		@include('site/business/list')
@else
<table class="table table-hover">
	<thead>
		<tr>
			<th class="span2">{{ trans('site/businesses.table.slug') }}</th>
			<th class="span4">{{ trans('site/businesses.table.name') }}</th>
			<th class="span4">{{ trans('site/businesses.table.description') }}</th>
			<th class="span2">{{ trans('site/businesses.table.website') }}</th>
			<th class="span3">{{ trans('site/businesses.table.created_at') }}</th>
			<th class="span2">{{ trans('table.actions') }}</th>
		</tr>
	</thead>
	<tbody>
	@foreach ($contacts as $contact)
		@if( Session::get('businessSlug') == $contact->business->slug )
		<tr class="success">
		@else
		<tr>
		@endif
			<td>{{ $contact->business->slug }}</td>
			<td>{{ $contact->business->name }}</td>
			<td>{{ $contact->business->description }}</td>
			<td>{{ $contact->business->website }}</td>
			<td>{{ $contact->business->created_at }}</td>
			<td>
				@if( Session::get('businessSlug') != $contact->business->slug )
				{{ Button::link_primary_mini($contact->business->slug, trans('button.enter')) }}
				@endif
				{{ Button::link_success_mini('site/reservations', trans('button.reservations')) }}
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
@endif
</div>

@if(!Entrust::hasRole('admin'))
{{ Former::open('site/request/ownership') }}
{{ Button::submit(trans('site/index.button.i_own_a_business')) }}
{{ Former::close() }}
@endif

@stop
