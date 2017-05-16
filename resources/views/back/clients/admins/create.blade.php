<?php
	/* Translation */
	$TR = "admin_panel.ACPS";
?>

@extends('back.master')
@section('title', trans('admin_panel.APT.T12'))

@section('content')
	<div id="">
		@include('includes.back-error')
		@include('includes.flash-message')

		<div class="panel panel-default">
			<div class="panel-heading">{{ trans("$TR.T14") }}</div>
			<div class="panel-body">
				{!! Form::open(["url" => route('admin.clients.admins.accounts.store')]) !!}
					<div class="form-group">
						{!! Form::label("", trans("$TR.T15")) !!}
						<span class="text-danger">*</span>
						{!! Form::text("name", Faker\Factory::create()->name(), ["class"=>"form-control"]) !!}
					</div>
					<div class="form-group">
						{!! Form::label("", trans("$TR.T12")) !!}
						<span class="text-danger">*</span>
						{!! Form::email("email", Faker\Factory::create()->email(), ["class"=>"form-control"]) !!}
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label("", trans("$TR.T16")) !!}
								<span class="text-danger">*</span>
								<input type="password" name="password" value="123456" class="form-control">
								<span class="help-block">{{ trans("$TR.T16") }}: 123456</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label("", trans("$TR.T17")) !!}
								<span class="text-danger">*</span>
								<input type="password" name="password_confirmation" value="123456" class="form-control">
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<span>{{ trans("$TR.T13") }}</span><br>
							<small>{{ trans("$TR.T18") }}</small>
						</div>
						<div class="panel-body">
							@include('back.add-ons.roles-form')
						</div>
					</div>
					<div class="checkbox">
						<label>
							{!! Form::hidden("isCreateNew", 0) !!}
							{!! Form::checkbox("isCreateNew", 1, null, ["class"=>"checkbox"]) !!}
							<b>{{ trans("$TR.T20") }}</b>
						</label>
					</div>
					{!! Form::submit(trans("$TR.T19"), ["class"=>"btn btn-default"]) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop