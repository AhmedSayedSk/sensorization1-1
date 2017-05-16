<?php
	/* Translation */
	$TR = "admin_panel.ASSP";
?>

@extends('back.master')
@section('title', trans('admin_panel.APT.T14'))

@section('content')
	<div id="">
		@include('includes.back-error')
		@include('includes.flash-message')

		<div class="panel panel-default">
			<div class="panel-heading">{{ trans("$TR.T1") }}</div>
			<div class="panel-body">
				{!! Form::open(["url"=>"/admin/site-setting"]) !!}
					<p><u>{{ trans("$TR.T7") }}</u></p>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label("", trans("$TR.T2")) !!}
								{!! Form::text("site_name", $site_setting->site_name, ["class"=>"form-control"]) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label("", trans("$TR.T3")) !!}
								{!! Form::text("site_category", $site_setting->site_category, ["class"=>"form-control"]) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label("", trans("$TR.T5")) !!}
								{!! Form::text("customer_service_number", $site_setting->customer_service_number, ["class"=>"form-control"]) !!}
							</div>
						</div>
					</div>
					<hr>
					<p><u>{{ trans("$TR.T8") }}</u></p>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label("", trans("$TR.T4")) !!}
								{!! Form::select("main_currency", $currencies, $site_setting->main_currency, ["class"=>"form-control"]) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label("", trans("$TR.T9")) !!}
								{!! Form::select("newStatusTimeOff", $newStatusTimeOff, $site_setting->newStatusTimeOff, ["class"=>"form-control"]) !!}
							</div>
						</div>
					</div>	
					{!! Form::submit(trans("$TR.T6"), ["class"=>"btn btn-default pull-right"]) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop