<?php
	/* Translation */
	$TR = "auth.register";
?>

@extends("front.$frontendNumber.master")
@section('title', trans("$TR.T0"))

@section('content')
	<div id="register-form" class="container">
		@include('includes.flash-message')
		@include('includes.back-error')

		{!! Form::open(["url"=>"/register"]) !!}
			<div class="form-group">
				{!! Form::label("userName", trans("$TR.T1")) !!}
				{!! Form::text("name", "", ["class"=>"form-control", "id"=>"userName"]) !!}
				<p class="help-block">{{ trans("sub_validation.register.T1") }}</p>
			</div>
			<div class="form-group">
				{!! Form::label("emailAddress", trans("$TR.T7")) !!}
				{!! Form::email("email", "", ["class"=>"form-control", "id"=>"emailAddress"]) !!}
			</div>
			<div class="form-group">
				{!! Form::label("userPassword", trans("$TR.T2")) !!}
				{!! Form::password("password", ["class"=>"form-control", "id"=>"userPassword"]) !!}
				<p class="help-block">{{ trans("sub_validation.register.T3") }}</p>
			</div>
			<div class="form-group">
				{!! Form::label("confirmationPassword", trans("$TR.T2")) !!}
				{!! Form::password("password_confirmation", ["class"=>"form-control", "id"=>"confirmationPassword"]) !!}
			</div>
			{!! Form::submit(trans("$TR.T3"), ["class"=>"btn btn-default"]) !!}

			<span class="message right-text">
				{{ trans("$TR.T4") }} <a href="/login">{{ trans("$TR.T5") }}</a>
			</span>
		{!! Form::close() !!}
	</div>
@stop