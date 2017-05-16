<?php
	/* Translation */
	$TR = "admin_panel.ACPP";
?>

@extends('back.master')
@section('title', trans("admin_panel.APT.T3", ['number'=>1]))

@section('content')

	<div id="product-create-page">
		@include('includes.flash-message')
		@include('includes.back-error')

		<div class="panel panel-default">
			<div class="panel-heading">
				<b>{{ trans("$TR.T1", ['number'=>'I']) }}</b>
			</div>
			<div class="panel-body">
				<div class="container-fluid tabs-wrap">
				    <div class="draggable-container">
					    <ul class="nav nav-tabs draggable" role="tablist">
					        <li class="active">
					        	<a href="#literal-data" aria-controls="literal-data" aria-expanded="true" role="tab" data-toggle="tab">
					        		<span class="icon-fontello-n1"></span>
					        		{{ trans("$TR.T2") }}
					        	</a>
					        </li>
					        <li>
					        	<a href="#categories" aria-controls="categories" aria-expanded="true" role="tab" data-toggle="tab">
					        		<span class="icon-fontello-n2"></span>
					        		{{ trans("$TR.T3") }}
					        	</a>
					        </li>
					        <li>
					        	<a href="#numerical-data" aria-controls="numerical-data" aria-expanded="true" role="tab" data-toggle="tab">
					        		<span class="icon-fontello-n3"></span>
					        		{{ trans("$TR.T4") }}
					        	</a>
					        </li>
					    </ul>
				    </div>
				    <div id="create-product">	
					    {!! Form::open(["url"=>route("admin.products..store")."/store/step/1", "files"=>"true"]) !!}
						    <div class="tab-content">
						        <div class="tab-pane active" id="literal-data">
						        	<div class="form-group">
										{!! Form::label("productName", trans("$TR.T5")) !!}
										{!! Form::text("product_name", $faker->sentence($nbWords = 3, $variableNbWords = true), ["class"=>"form-control", "id"=>"productName"]) !!}
										<span class="help-block">{{ trans("sub_validation.register.T4") }}</span>
									</div>
									<div class="form-group">
										{!! Form::label("productDetails", trans("$TR.T7")) !!}
										{!! Form::textarea("product_description", $faker->paragraph, ["class"=>"form-control", "id"=>"productDetails"]) !!}
										<span class="help-block">{{ trans("sub_validation.register.T1") }}</span>
									</div>
									<div class="form-group">
										{!! Form::label("serialNumber", trans("$TR.T9")) !!}
										{!! Form::number("serial_number", rand(10000000, 99999999), ["class"=>"form-control", "id"=>"serialNumber"]) !!}
									</div>
									<button class="btn btn-default continue" type="button">{{ trans("$TR.T10") }} <span class="icomoon-arrow-10"></span></button>
						        </div>
						        <div class="tab-pane categories" id="categories">
						        	<div class="form-group categories">
						        		<label>[<a href="/admin/products/categories" target="_blank">{{ trans("$TR.T11") }}</a>]</label>
										<select name="p_cat1" class="form-control p-cat" data-table-num="1">
											<option value="0" selected>{{ trans("$TR.T12") }}</option>
											@foreach($p_cat1 as $key=>$cat)
												<option value="{{$key}}">{{$cat}}</option>
											@endforeach
										</select>
										{!! Form::select("p_cat2", [], 0, ["class"=>"form-control p-cat", "data-table-num"=>"2"]) !!}
										{!! Form::select("p_cat3", [], 0, ["class"=>"form-control p-cat", "data-table-num"=>"3"]) !!}
										{!! Form::select("p_cat4", [], 0, ["class"=>"form-control p-cat", "data-table-num"=>"4"]) !!}
										{!! Form::select("p_cat5", [], 0, ["class"=>"form-control p-cat", "data-table-num"=>"5"]) !!}
										
										{!! Form::hidden("category_id", 1, ["class"=>"category-id"]) !!}
										{!! Form::hidden("category_table_number", 1, ["class"=>"cat-table-number"]) !!}
						        	</div>
						        	<button type="button" class="btn btn-default back">
						        		<span class="icomoon-arrow-10 flipped col-flip-180"></span> 
						        		{{ trans("$TR.T13") }}
						        	</button>
					    			<button type="button" class="btn btn-default continue">
					    				{{ trans("$TR.T14") }} 
					    				<span class="icomoon-arrow-10"></span>
					    			</button>
						        </div>
						        <div class="tab-pane" id="numerical-data">
						        	<div class="form-group">
										{!! Form::label("productPrice", trans("$TR.T15")) !!}
										<div class="input-group">
											{!! Form::text("product_price", rand(100, 9999), ["class"=>"form-control", "id"=>"productPrice", "aria-label"=>trans("$TR.T16")]) !!}
											<span class="input-group-addon">{{ $global_setting->main_currency }}</span>
										</div>				
									</div>
									<div class="form-group">
										{!! Form::label("priceDiscount", trans("$TR.T17")) !!}
										<div class="input-group">
									      {!! Form::text("discount_percentage", rand(1, 70), ["class"=>"form-control", "id"=>"priceDiscount"]) !!}
									      <span class="input-group-addon">%</span>
									    </div>
									</div>
									<div class="form-group product-amount">
										{!! Form::label("productAmount", trans("$TR.T18")) !!}
										{!! Form::text("product_amount", rand(1, 500), ["class"=>"form-control", "id"=>"productAmountText"]) !!}
										<div class="checkbox">
											<label>
												{!! Form::hidden("is_amount_unlimited", 0) !!}
												{!! Form::checkbox("is_amount_unlimited", 1, null, ["class"=>"checkbox", "id"=>"productAmountStatus"]) !!}
												<span>{{ trans("$TR.T19") }}</span>
											</label>
										</div>
									</div>
									<hr>
									<div class="form-group start-at">
										{!! Form::label("startAtData", trans("$TR.T20")) !!}
										{!! Form::date("start_at", "", ["class"=>"form-control", "id"=>"startAtData"]) !!}
										<div class="checkbox">
											<label>
												{!! Form::hidden("is_start_view_now", 0) !!}
												{!! Form::checkbox("is_start_view_now", 1, "checked", ["class"=>"checkbox", "id"=>"startAtStatus"]) !!}
												<span>{{ trans("$TR.T21") }}</span>
											</label>
										</div>				
									</div>	
									<div class="form-group">
										{!! Form::label("", trans("$TR.T22")) !!}
										{!! Form::date("expires_at", "", ["class"=>"form-control"]) !!}
										<div class="radio">
											<label>
												{!! Form::radio("expires_condition", "by_days", null, ["class"=>"checkbox"]) !!}
												<span>{!! trans("$TR.H23", ['inputClass'=>'wid-100', 'inputName'=>'expires_days', 'today' => date("d/m/Y", time())]) !!}</span>
											</label>
										</div>
										<div class="radio">
											<label>
												{!! Form::radio("expires_condition", "unlimited_expires", "checked", ["class"=>"checkbox"]) !!}
												<span>{{ trans("$TR.T24") }}</span>
											</label>
										</div>
									</div>
									<button type="button" class="btn btn-default back"><span class="icomoon-arrow-10 flipped col-flip-180"></span> {{ trans("$TR.T13") }}</button>
					    			<button type="submit" class="btn btn-default continue">{{ trans("$TR.T25") }} <span class="icomoon-arrow-10"></span></button>
						        </div>
						    </div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			var categories_id = [];

			optimizeCategories();

			enable_disable_input($("#productAmountStatus"), $("#productAmountText"));
			enable_disable_input($("#startAtStatus"), $("#startAtData"));

			$('.tab-pane .continue').click(function(){
			  $('.nav-tabs > .active').next('li').find('a').trigger('click');
			});

			$('.tab-pane .back').click(function(){
			  $('.nav-tabs > .active').prev('li').find('a').trigger('click');
			});
		})
	</script>

@stop

@section('head-css')
	<link rel="stylesheet" type="text/css" href="./assets/css/packages/fontello/numbers/css/fontello.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/packages/icomoon/arrows/style.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/packages/draggable-taps/draggable-taps.css">
@stop

@section('footer-js')
	<script type="text/javascript" src="./assets/js/jquery-ui/widget.js"></script>
	<script type="text/javascript" src="./assets/js/jquery-ui/mouse.js"></script>
	<script type="text/javascript" src="./assets/js/jquery-ui/data.js"></script>
	<script type="text/javascript" src="./assets/js/jquery-ui/plugin.js"></script>
	<script type="text/javascript" src="./assets/js/jquery-ui/safe-active-element.js"></script>
	<script type="text/javascript" src="./assets/js/jquery-ui/safe-blur.js"></script>
	<script type="text/javascript" src="./assets/js/jquery-ui/scroll-parent.js"></script>
	<script type="text/javascript" src="./assets/js/jquery-ui/widgets/draggable.min.js"></script>
	<script type="text/javascript" src="./assets/js/draggable-taps.min.js"></script>
@stop