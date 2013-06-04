@extends('site.layouts.default')

{{-- Content --}}
@section('content')

@foreach ($businesses as $business)
<div class="row">
	<div class="span2">{{ HTML::link($business->slug, $business->name) }}</div>
	<div class="span2">{{ $business->name }}</div>
	<div class="span2">{{ $business->website }}</div>
</div>
@endforeach

@stop
