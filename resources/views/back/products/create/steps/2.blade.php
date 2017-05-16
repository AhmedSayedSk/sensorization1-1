<?php
	/* Translation */
	$TR = "admin_panel.ACPP";
?>

@extends('back.master')
@section('title', trans("admin_panel.APT.T3", ['number'=>2]))

@section('content')

	<div id="product-create-page">
		@include('includes.flash-message')
		@include('includes.back-error')

		<div class="alert alert-warning" role="alert">
			<span>{!! trans("$TR.H26") !!}</span>
			<span class="pull-right"><a href="#">{!! trans("$TR.T27") !!}</a></span>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<b>{{ trans("$TR.T1", ['number'=>'II']) }}</b>
			</div>
			<div class="panel-body">
				<div class="container-fluid tabs-wrap">
				    <div class="draggable-container">
					    <ul class="nav nav-tabs draggable" role="tablist">
					        <li class="active">
					        	<a href="#product-images" aria-controls="upload-images-carousel" aria-expanded="true" role="tab" data-toggle="tab">
					        		<span class="icon-fontello-n4"></span>
					        		{{ trans("$TR.T28") }}
					        	</a>
					        </li>
					        <li>
					        	<a href="#tags" aria-controls="tags" aria-expanded="true" role="tab" data-toggle="tab">
					        		<span class="icon-fontello-n5"></span>
					        		{{ trans("$TR.T29") }}
					        	</a>
					        </li>
					        <li>
					        	<a href="#options" aria-controls="options" aria-expanded="true" role="tab" data-toggle="tab">
					        		<span class="icon-fontello-n6"></span>
					        		{{ trans("$TR.T30") }}
					        	</a>
					        </li>
					    </ul>
				    </div>
				    <div id="create-product">
					    <div class="tab-content">
					        <div class="tab-pane active" id="product-images">
								<div class="dropzone-image">
									<label>{{ trans("$TR.T31") }} <span id="photoCounter-1"></span></label>
									<div class="form-group">
										<div class="droping">
									        {!! Form::open(['url' => route('image-upload'), 'class' => 'dropzone', 'files'=>true, 'id'=>'dropzone-1']) !!}
										        {!! Form::hidden('upload_type', 'image') !!}
										        {!! Form::hidden('parent_id', Session::get('products_step1')['product_id']) !!}
										        <div class="dz-message">
										        	<h3>{{ trans("$TR.T32") }}</h3>
										        </div>
										        <div class="fallback">
										            <input name="file" type="file" multiple>
										        </div>
										        <div class="dropzone-previews" id="dropzonePreview-1"></div>
									        {!! Form::close() !!}
										</div>
										@include('standers.dropzone.preview-template')
										<p class="help-block">{{ trans("$TR.T42", ['max_images' => Config::get('images.max_uploads')]) }}</p>
									</div>
								</div>
								<div class="dropzone-image">
									<label>{{ trans("$TR.T40") }} <span id="photoCounter-2"></span></label>
									<div class="form-group">
										<div class="droping">
									        {!! Form::open(['url' => route('carousel-upload'), 'class' => 'dropzone', 'files'=>true, 'id'=>'dropzone-2']) !!}
										        {!! Form::hidden('upload_type', 'carousel') !!}
										        {!! Form::hidden('parent_id', Session::get('products_step1')['product_id']) !!}
										        <div class="dz-message">
										        	<h3>{{ trans("$TR.T41") }}</h3>
										        </div>
										        <div class="fallback">
										            <input name="file" type="file" multiple>
										        </div>
										        <div class="dropzone-previews" id="dropzonePreview-2"></div>
									        {!! Form::close() !!}
										</div>
										@include('standers.dropzone.preview-template')
										<p class="help-block">{{ trans("$TR.T43", ['max_carousel' => Config::get('carousel.max_uploads')]) }}</p>
									</div>
								</div>	
								<button class="btn btn-default continue" type="button">{{ trans("$TR.T10") }} <span class="icomoon-arrow-10"></span></button>	
					        </div>	   
					        <div class="tab-pane" id="tags">
					        	{!! Form::open(["url"=>route("admin.products..store")."/store/step/2"]) !!}
					        	{!! Form::hidden('product_id', Session::get('products_step1')['product_id']) !!}
					        	<div class="form-group">
									{!! Form::label("", trans("$TR.T29")) !!} 
									&nbsp; [<a href="{{ route('APT.view-append-modal') }}" data-toggle="modal" data-target="#Modal" data-remote="false">{{ trans("$TR.T33") }}</a>]
									{!! Form::text("", "", ["class"=>"form-control tags_searcher"]) !!}
								</div>
								<div class="well p-tags">
									{!! Form::hidden("product_tags") !!}
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
					        <div class="tab-pane" id="options">
					        	<div class="form-group">
									<div class="checkbox">
										<label>
											{!! Form::hidden("is_new", 0) !!}
											{!! Form::checkbox("is_new", 1, null, ["class"=>"checkbox"]) !!}
											<b>{{ trans("$TR.T34") }}</b>
										</label>
									</div>
									<div class="checkbox">
										<label>
											{!! Form::hidden("is_live", 0) !!}
											{!! Form::checkbox("is_live", 1, "checked", ["class"=>"checkbox"]) !!}
											<b>{{ trans("$TR.T35") }}</b>
										</label>
									</div>
									<div class="checkbox">
										<label>
											{!! Form::hidden("is_carousel_live", 0) !!}
											{!! Form::checkbox("is_carousel_live", 1, "checked", ["class"=>"checkbox"]) !!}
											<b>{{ trans("$TR.T44") }}</b>
										</label>
									</div>
									<div class="checkbox">
										<label>
											{!! Form::hidden("is_payment_on_delivery", 0) !!}
											{!! Form::checkbox("is_payment_on_delivery", 1, "checked", ["class"=>"checkbox disabled"]) !!}
											<b>{{ trans("$TR.T36") }}</b>
										</label>
									</div>
									<div class="checkbox">
										<label>
											{!! Form::hidden("is_payment_by_paypal", 0) !!}
											{!! Form::checkbox("is_payment_by_paypal", 1, null, ["class"=>"checkbox"]) !!}
											<b>{{ trans("$TR.T37") }}</b>
										</label>
									</div>
									<div class="checkbox">
										<label>
											{!! Form::hidden("create_again", 0) !!}
											{!! Form::checkbox("create_again", 1, "checked", ["class"=>"checkbox"]) !!}
											<b>{{ trans("$TR.T38") }}</b>
										</label>
									</div>
								</div>
								{!! Form::hidden("primary_image_id", 1) !!}
								{!! Form::hidden("primary_carousel_id", 1) !!}
								<button type="button" class="btn btn-default back">
									<span class="icomoon-arrow-10 col-flip-180 flipped"></span>
									{{ trans("$TR.T13") }}
								</button>
					    		<button type="submit" class="btn btn-default continue">
					    			{{ trans("$TR.T39") }} 
					    			<span class="icomoon-arrow-10"></span>
					    		</button>
								{!! Form::close() !!}
					        </div>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
		
	<!-- Default bootstrap modal example -->
	@include('standers.modal')

	<script type="text/javascript">
		$(document).ready(function(){
			tags_searcher();

			tagModal([
				'{{ trans("$TR.T33") }}'
			], null, null, null);

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
	<link rel="stylesheet" type="text/css" href="./packages/dropzone/dropzone.css">
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
	<script type="text/javascript" src="./packages/dropzone/dropzone.js"></script>	
	<script type="text/javascript" src="./assets/js/dropzone-config.js"></script>
@stop