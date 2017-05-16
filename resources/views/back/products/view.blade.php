<?php
	/* Translation */
	$TR = "admin_panel.APVP";
?>

@extends('back.master')
@section('title', trans("admin_panel.APT.T2"))

@section('content')
	<div id="products-view-page">
		@include('back.products.add-ons.filter-bar')

		<div class="panel panel-default">
			<div class="panel-heading">
				<b>{{ trans("$TR.T1") }}</b>
				<a href="{{ route('admin.products..create') }}/step/1" class="btn btn-default btn-sm pull-right" title='{{ trans("$TR.T2") }}'>
					<span class="glyphicon glyphicon-plus"></span>
				</a>
				<a href="/admin/products/carousel" class="btn btn-default btn-sm pull-right" title='{{ trans("$TR.T3") }}'>
					<span class="glyphicon glyphicon-picture"></span>
				</a>
			</div>
			<div class="panel-body">
				<div class="container-fluid">
					@if(count($products) == 0)
						<div class="text-center empty-content">
							<h3>{{ trans("$TR.T5") }}</h3>
						</div>
					@else
						<div id="response-table">
							<table class="table table-striped table-hover sortable ps-view">
								<thead>
									<tr>
										<th>{{ trans("$TR.T6") }}</th>
										<th width="20%">{{ trans("$TR.T7") }}</th>
										<th>{{ trans("$TR.T8") }}</th>
										<th>{{ trans("$TR.T9") }}</th>
										<th class="bg-success">{{ trans("$TR.T10") }}</th>
										<th>{{ trans("$TR.T11") }} </th>
										<th width="15.1%">{{ trans("$TR.T12") }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($products as $product)
										<tr>
											<td data-title='{{ trans("$TR.T6") }}' class="image">
												@include('includes.image-view')
											</td>
											<td data-title='{{ trans("$TR.T7") }}'>{{ $product->name }}</td>
											<td data-title='{{ trans("$TR.T8") }}'>
												{{ number_format($product->discountPrice) }} {{ $main_currency }}
												@if($product->discount_percentage > 0)
													<label class="label label-default">{{ trans("$TR.T13", ['number' => $product->discount_percentage]) }}</label>
												@endif
											</td>
											<td data-title='{{ trans("$TR.T9") }}'>{{ $product->amount }}</td>
											<td data-title='{{ trans("$TR.T10") }}' class="bg-success">{{ $product->sales }}</td>
											<td data-title='{{ trans("$TR.T11") }}' class="live-time">
												{{ trans("$TR.T14") }} <br>
												{{ $product->start_at }}
												<hr>
												{{ trans("$TR.T15") }} <br>
												{{ $product->expires_at }}
											</td>
											<td data-title='{{ trans("$TR.T12") }}' class="options">
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
			@if(isset($searchParameters))
				<!-- For search sections -->
				{!! $products->appends($searchParameters)->render() !!}
			@else
				<!-- For normal view -->
				{!! $products->render() !!}
			@endif
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			search_status();
		});
	</script>
@stop

@section('head-css')
	<link rel="stylesheet" type="text/css" href="./packages/bootstrap-sortable/Contents/bootstrap-sortable.css">
@stop

@section('footer-js')
	<script type="text/javascript" src="./packages/bootstrap-sortable/Scripts/bootstrap-sortable.js"></script>
	<script type="text/javascript" src="./packages/bootstrap-sortable/Scripts/moment.min.js"></script>
@stop
