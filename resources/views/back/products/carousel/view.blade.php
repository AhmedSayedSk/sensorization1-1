<?php
	/* Translation */
	$TR = "admin_panel.APCaVP";
?>

@extends('back.master')
@section('title', trans("admin_panel.APT.T5"))

@section('content')
	<div id="carousel-view-page">
		<div class="panel panel-default">
			<div class="panel-heading">{{ trans("$TR.T2") }}</div>
			<div class="panel-body">
				<div class="container-fluid">
					@if(count($products) <= 0)
						<div class="text-center empty-content">
							<h3>{!! trans("$TR.T1", ['link'=>"/admin/products"]) !!}</h3>
						</div>
					@else
						<div id="response-table">
							<table class="table table-striped sortable ps-view">
								<thead>
									<tr>
										<th>{{ trans("$TR.T3") }}</th>
										<th>{{ trans("$TR.T4") }}</th>
										<th>{{ trans("$TR.T5") }}</th>
										<th>{{ trans("$TR.T6") }}</th>
										<th>{{ trans("$TR.T7") }}</th>
										<th width="15.1%">{{ trans("$TR.T8") }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($products as $product)
										<tr>
											<td data-title='{{ trans("$TR.T3") }}'>
												@include('includes.image-view')
											</td>
											<td data-title='{{ trans("$TR.T4") }}'>
												@include('includes.carousel-view')
											</td>
											<td data-title='{{ trans("$TR.T5") }}'>{{ $product->name }}</td>
											<td data-title='{{ trans("$TR.T6") }}'>{{ $product->sales }}</td>
											<td data-title='{{ trans("$TR.T7") }}'>{{ $product->price }} {{ $main_currency }}</td>
											<td data-title='{{ trans("$TR.T8") }}' class="options">
												@include('standers.products.basic-options')
											</td>
										</tr>
									@endforeach				
								</tbody>
							</table>
						</div>
					@endif
				</div>
			</div>
		</div>
		<div class="text-center">
			{!! $products->render() !!}
		</div>
	</div>
@stop

@section('head-css')
	<link rel="stylesheet" type="text/css" href="./packages/bootstrap-sortable/Contents/bootstrap-sortable.css">
@stop

@section('footer-js')
	<script type="text/javascript" src="./packages/bootstrap-sortable/Scripts/bootstrap-sortable.js"></script>
	<script type="text/javascript" src="./packages/bootstrap-sortable/Scripts/moment.min.js"></script>
@stop