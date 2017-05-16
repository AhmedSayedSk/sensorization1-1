<?php
	// check for if coming from add-to-cart case
	if(isset($_GET['ref_to']) && !empty($_GET['ref_to'])){
		Session::set('referedToProduct', [
			'is' => 1,
			'value' => "/products/".$_GET['ref_to']
		]);
	}

	/* Translation */
	$TR = "auth.login";
?>

@extends("front.$frontendNumber.master")
@section('title', trans("$TR.T0"))

@section('content')
	<div id="login-form" class="container">
		@include('includes.flash-message')
		@include('includes.back-error')

		{!! Form::open(["url"=>"/login"]) !!}
			<div class="form-group">
				<span>
					<span class="glyphicon glyphicon-user"></span>
					{!! Form::label("emailAddress", trans("$TR.T1")) !!}
				</span>
				{!! Form::email("email", "", ["class"=>"form-control", "id"=>"emailAddress", "required"=>"required"]) !!}
				<span class="help-block access-accounts">
					super-admin@sen.com<br>
					normal-admin@sen.com<br>
					user@sen.com
				</span>
			</div>
			<div class="form-group">
				<span>
					<span class="glyphicon glyphicon glyphicon-sunglasses"></span>
					{!! Form::label("userPassword", trans("$TR.T2")) !!}
				</span>
				<input type="password" name="password" value="123456" class="form-control" id="userPassword" required>
				<span class="help-block">{{ trans("$TR.T2") }}: 123456</span>
			</div>
			@if(Session::has('referedToProduct'))
				{!! Form::hidden('isReferedToProduct', Session::get('referedToProduct')['is']) !!}
				{!! Form::hidden('refToProduct_value', Session::get('referedToProduct')['value']) !!}
			@endif
			{!! Form::submit(trans("$TR.T5"), ["class"=>"btn btn-default"]) !!}
			<span class="message right-text">
				{{ trans("$TR.T3") }} <a href="/register">{{ trans("$TR.T4") }}</a>
			</span>
		{!! Form::close() !!}
	</div>
@stop
