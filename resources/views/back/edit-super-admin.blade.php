<?php
	/* Translation */
	$TR = "admin_panel.AESP";
?>

@extends('back.master')
@section('title', trans('admin_panel.APT.T13'))

@section('content')
	<div id="">
		@include('includes.back-error')
		@include('includes.flash-message')

		<div class="panel panel-default">
			<div class="panel-heading">{{ trans("$TR.T1") }}</div>
			<div class="panel-body">
				{!! Form::open(["url"=>"/admin/edit-super-admin"]) !!}
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label("", trans("$TR.T2")) !!}
								{!! Form::text("name", $super_admin->name, ["class"=>"form-control"]) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label("", trans("$TR.T3")) !!}
								{!! Form::email("email", $super_admin->email, ["class"=>"form-control"]) !!}
							</div>
						</div>
					</div>	
					<hr>
					<div class="form-group">
						<div class="checkbox">
							<label>
								{!! Form::hidden("change_password", 0) !!}
								{!! Form::checkbox("change_password", 1, null, ["class"=>"checkbox"]) !!}
								<b>{{ trans("$TR.T4") }}</b>
							</label>
						</div>
					</div>
					<div class="form-group">
						{!! Form::label("", trans("$TR.T5")) !!}
						{!! Form::password("old_password", ["class"=>"form-control"]) !!}
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label("", trans("$TR.T6")) !!}
								{!! Form::password("new_password", ["class"=>"form-control"]) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label("", trans("$TR.T7")) !!}
								{!! Form::password("new_password_confirmation", ["class"=>"form-control"]) !!}
							</div>
						</div>
					</div>	
					{!! Form::submit(trans("$TR.T8"), ["class"=>"btn btn-default"]) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop