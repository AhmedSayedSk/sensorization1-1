<?php
	/* Translation */
	$TR = "admin_panel.ACPS";
?>

@extends('back.master')
@section('title', trans('admin_panel.APT.T11'))

@section('content')
	<div id="">
		@include('includes.back-error')
		@include('includes.flash-message')

		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans('$TR.T9') }}
				<a class="btn btn-default pull-right" href="{{ route('admin.clients.admins.accounts.index') }}">{{ trans('$TR.T10') }}</a>
			</div>
			<div class="panel-body">
				{!! Form::open(["url"=> route('admin.clients.admins.accounts.update', $admin->id), "method"=>"PATCH"]) !!}
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label("", trans('$TR.T11')) !!}
								{!! Form::text("user_name", $admin->name, ["class"=>"form-control"]) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label("", trans('$TR.T12')) !!}
								{!! Form::email("user_email", $admin->email, ["class"=>"form-control", "disabled"=>"disabled"]) !!}
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							{{ trans('$TR.T13') }}
						</div>
						<div class="panel-body">
							@include('back.add-ons.roles-form')
						</div>
					</div>
					{!! Form::submit(trans('$TR.T8'), ["class"=>"btn btn-primary"]) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop