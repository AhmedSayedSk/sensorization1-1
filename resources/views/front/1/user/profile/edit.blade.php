<?php 
	/* Translation */
	$TR = "frontend.$frontendNumber.UP.EI"; 
?>

@extends("front.$frontendNumber.user.master")
@section('title', trans("frontend.$frontendNumber.PT.T7"))

@section('content')
	<div id="edit-information">
		@include('includes.flash-message')
		@include('includes.back-error')
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<b>{{ trans("$TR.T1") }}</b>
			</div>
			<div class="panel-body">
				<div class="container-fluid">
					{!! Form::open(["url"=>"/profile/update-information"]) !!}
						<div class="form-group">
							{!! Form::label("userName", trans("$TR.T2")) !!}
							<span class="text-danger">*</span>
							{!! Form::text("name", $user->name, ["class"=>"form-control", "id"=>"userName", "required"]) !!}
						</div>
						<div class="form-group">
							{!! Form::label("emailAddress", trans("$TR.T3")) !!} 
							<span class="text-danger">*</span>
							{!! Form::email("email", $user->email, ["class"=>"form-control", "id"=>"emailAddress", "readonly", "required"]) !!}
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label("country", trans("$TR.T4")) !!}
									{!! Form::select("country_id", $countries, $user->country_id > 0 ? $user->country_id : 2, ["class"=>"form-control", "id"=>"country"]) !!}
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									{!! Form::label("address", trans("$TR.T5")) !!}
									{!! Form::text("address", $user->address, ["class"=>"form-control", "id"=>"address"]) !!}
									<p class="help-block">{{ trans("$TR.T6") }}</p>
								</div>
							</div>
						</div>

						@if(isset($_GET['payment']))
							{!! Form::hidden('payment', 'true') !!}
						@endif

						{!! Form::submit(trans("$TR.T7"), ["class"=>"btn btn-default"]) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>		
	</div>
@stop