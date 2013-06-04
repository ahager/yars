@extends('admin/layouts/default')

{{-- Web site Title --}}
@section('title')
DELETE CONTACT ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h3>
		DELETE CONTACT

		<div class="pull-right">
			<a href="{{{ URL::to('admin/contacts') }}}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> {{ trans('button.back') }}</a>
		</div>
	</h3>
</div>

<!-- Tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab">{{ trans('button.delete') }}</a></li>
</ul>
<!-- ./ tabs -->
<form class="form-horizontal" method="post" action="" autocomplete="off">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <input type="hidden" name="id" value="{{ $contact->id }}" />
    <!-- ./ csrf token -->

    <!-- Form Actions -->
    <div class="control-group">
        <div class="controls">
            <a class="btn btn-link" href="{{{ URL::to('admin/blogs') }}}">{{ trans('button.cancel') }}</a>
            <button type="submit" class="btn btn-danger">{{ trans('button.delete') }}</button>
        </div>
    </div>
    <!-- ./ form actions -->
</form>
@stop
