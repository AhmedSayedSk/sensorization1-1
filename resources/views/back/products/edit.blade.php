<?php
	/* Translation */
	$TR = "admin_panel.ACPP";
?>

@extends('back.master')
@section('title', trans('admin_panel.APT.T14'))

@section('content')
	<div id="product-edit-page">
		@include('includes.flash-message')
		@include('includes.back-error')

		<div class="panel panel-default">
			<div class="panel-heading">
				<b><u>{{ trans('admin_panel.APEP.T1') }}</u> {{ $product->name }}</b>
				<a href="{{ route('admin.products..show', $product->id) }}" class="btn btn-default btn-sm pull-right" title="{{ trans('admin_panel.APEP.T2') }}">
					show &nbsp;
					<span class="glyphicon glyphicon-eye-open"></span>
				</a>
				@include('standers.add-ons.live-status-btn')
				@include('standers.add-ons.carousel-status-btn')
				@include('standers.add-ons.new-product-status-btn')
			</div>
			<div class="panel-body">
				<div id="product-edit">
					{!! Form::open(["url"=>"/admin/products/$product->id", "method"=>"PATCH", "files"=>"true"]) !!}
						<div class="form-group">
							{!! Form::label("productName", trans("$TR.T5")) !!}
							{!! Form::text("product_name", $product->name, ["class"=>"form-control", "id"=>"productName"]) !!}
						</div>
						<div class="form-group">
							{!! Form::label("productDescription", trans("$TR.T7")) !!}
							{!! Form::textarea("product_description", $product->description, ["class"=>"form-control", "id"=>"productDescription"]) !!}
						</div>
						<div class="form-group">
							{!! Form::label("", trans("$TR.T9")) !!}
							{!! Form::text("serial_number", $product->serial_number, ["class"=>"form-control"]) !!}
						</div>
						<hr>
						<div class="form-group" id="categories" data-max-categories="{{ count($product_trueCats) }}">
							<label>{{ trans('admin_panel.APEP.T3') }}</label>
							<p>my list is: <?= implode('</span> -> <span>', $product_categories_list) ?></p>
							<p><u>please choose new category tree:</u></p>

							<?php $i = 0; $counter = 1; ?>
							@foreach($product_trueCats as $arr)
								<select name="p_cat{{$counter}}" class="form-control p-cat" data-table-num="{{$counter}}">
									<option value="0" selected>{{ trans("$TR.T12") }}</option>
									@foreach($arr as $cat)
										<option value="{{ $cat->id }}"
											@if(isset($product_categories_list[$i]) && $product_categories_list[$i] == $cat->name)
												selected
												<?php $i++; $category_id = $cat->id ?>
											@endif>
											{{ $cat->name }}
										</option>
									@endforeach
								</select>
								<?php $counter++ ?>
							@endforeach

							{!! Form::hidden("category_id", $category_id, ["class"=>"category-id"]) !!}
							{!! Form::hidden("category_table_number", $i, ["class"=>"cat-table-number"]) !!}
						</div>
						<hr>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									{!! Form::label("productPrice", trans("$TR.T15")) !!}
									<div class="input-group">
										{!! Form::text("product_price", $product->price, ["class"=>"form-control", "id"=>"productPrice", "aria-label"=>"Amount (to the nearest dollar)"]) !!}
										<span class="input-group-addon">{{ $global_setting->main_currency }}</span>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									{!! Form::label("priceDiscount", trans("$TR.T17")) !!}
									<div class="input-group">
										{!! Form::text("discount_percentage", $product->discount_percentage, ["class"=>"form-control", "id"=>"priceDiscount"]) !!}
										<span class="input-group-addon">%</span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							{!! Form::label("productAmount", trans("$TR.T18")) !!}
							{!! Form::text("product_amount", $product->amount, ["class"=>"form-control", "id"=>"productAmountText"]) !!}
							<div class="checkbox">
								<label>
									{!! Form::hidden("is_amount_unlimited", 0) !!}
									{!! Form::checkbox("is_amount_unlimited", $product->is_amount_unlimited, $product->is_amount_unlimited ? 'checked' : null, ["class"=>"checkbox", "id"=>"productAmountStatus"]) !!}
									<b>{{ trans("$TR.T19") }}</b>
								</label>
							</div>
						</div>
						<hr>
						<div class="form-group start-at">
							{!! Form::label("startAtData", trans("$TR.T20")) !!}
							{!! Form::date("start_at", date("Y-m-d", $product->start_at), ["class"=>"form-control", "id"=>"startAtData"]) !!}
							<span></span>
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
							{!! Form::date("expires_at", date("Y-m-d", $product->expires_at), ["class"=>"form-control"]) !!}
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
						<hr>
						<div class="form-group">
							<div class="checkbox">
								<label>
									{!! Form::hidden("is_payment_on_delivery", 0) !!}
									{!! Form::checkbox("is_payment_on_delivery", 1, $product->is_payment_on_delivery ? "checked" : null, ["class"=>"checkbox"]) !!}
									<b>{{ trans("$TR.T36") }}</b>
								</label>
							</div>
							<div class="checkbox">
								<label>
									{!! Form::hidden("is_payment_by_paypal", 0) !!}
									{!! Form::checkbox("is_payment_by_paypal", 1, $product->is_payment_by_paypal ? "checked" : null, ["class"=>"checkbox"]) !!}
									<b>{{ trans("$TR.T37") }}</b>
								</label>
							</div>
						</div>
						{!! Form::submit(trans("admin_panel.APEP.T5"), ["class"=>"btn btn-success"]) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			optimizeCategories();

			enable_disable_input($("#productAmountStatus"), $("#productAmountText"));
			enable_disable_input($("#startAtStatus"), $("#startAtData"));
		})
	</script>
@stop
