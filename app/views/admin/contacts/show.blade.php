@extends('admin/layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
:: Contact Info
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>Contact Info
		<div class="pull-right">
			<a href="{{ URL::to('admin/contacts/create') }}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i> Create</a>
		</div>
	</h3>
</div>

<div class="container">

@if($contact)
<div class="span4 well">
	<div class="row">
		<div class="span1"><a href="http://critterapp.pagodabox.com/others/admin" class="thumbnail"><img src="http://critterapp.pagodabox.com/img/user.jpg" alt=""></a></div>
		<div class="span3">
			<p>{{ $contact->username }}</p>
          	<p><strong>{{ $contact->fullname }}</strong></p>
			<span class="badge badge-important">8 inasistencias</span> <span class="badge badge-success">78 asistencias</span>
		</div>
	</div>
</div>
@endif

@if($contact)
<table class="table table-condensed table-hover span4" cellspacing="0" cellpadding="0" border="0">
	<tbody>
	<tr>
		<th class="title"><label title="name">{{ trans('admin/contacts/contacts.fullname') }}</label></th>
		<td class="value" title="{{ $contact->inverseFullname }}">{{ $contact->fullname }}&nbsp;
			<img src="/assets/img/icon-gender-{{ $contact->gender }}-small.png" title="{{{ trans('app.'.$contact->gender) }}}" />
		</td>
	</tr>

	@if($contact->age)
	<tr>
		<th class="title"><label title="age">{{ trans('admin/contacts/contacts.age') }}</label></th>
		<td class="value" title="{{ $contact->birthdate }}">{{ $contact->age }}</span></td>
	</tr>
	@endif

	@if($contact->nin)
	<tr>
		<th class="title"><label title="nin">{{ trans('admin/contacts/contacts.nin') }}</label></th>
		<td class="value">{{ $contact->nin }}</td>
	</tr>
	@else
	<tr>
		<th class="title"><label title="nin">{{ trans('admin/contacts/contacts.nin') }}</label></th>
		<td class="value"><span class="badge badge-info"><i class="icon icon-exclamation-sign icon-white"></i>&nbsp;{{ trans('msg.suggest_get_nin') }}</span></td>
	</tr>
	@endif

	@if($contact->job)
	<tr>
		<th class="title"><label>{{ trans('admin/contacts/contacts.job') }}</label></th>
		<td class="value">{{ $contact->job }}</td>
	</tr>
	@endif

	@if($contact->martial_status)
	<tr>
		<th class="title"><label>{{ trans('admin/contacts/contacts.martial_status') }}</label></th>
		<td class="value">{{ $contact->martial_status }}</td>
	</tr>
	@endif

	<tr>
		<th class="title"><label>{{ trans('admin/contacts/contacts.username') }}</label></th>
		<td class="value">{{ $contact->username }}</td>
	</tr>

</tbody>
</table>
@endif

<table class="table table-condensed table-hover span3" cellspacing="0" cellpadding="0" border="0">
	<tbody>
	@foreach($contact->channels as $channel)
	<tr>
		<th class="title"><label title="">{{ $channel->type }}</label></th>
		<td class="value" title="{{ $channel->type }}">{{ $channel->value }}</td>
	</tr>
	@endforeach
</tbody>
</table>

@stop

</div> <!-- container -->