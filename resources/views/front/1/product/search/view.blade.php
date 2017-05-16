<?php
	/* Translation */
	$TR = "frontend.$frontendNumber.PSV1";
?>

@extends("front.$frontendNumber.master")
@section("title", trans("frontend.$frontendNumber.PT.T3"))

@section('content')

	<div id="products-view">
		@if(count($products) > 0)
			<div class="container-fluid content">
				<h4>{{ trans("$TR.T1", ["result_count"=>count($products)]) }}</h4>
				<div class="row">
					<div class="col-md-3">
						@include("front.$frontendNumber.add-ons.sections.leftnav-filter")
					</div>
					<div class="col-md-9">
						<div id="products-container">
							@include("front.$frontendNumber.add-ons.sections.products")
						</div>
					</div>
				</div>
			</div>

			<div class="container text-center">
				{!! $products->appends($searchParameters)->render() !!}
			</div>
		@else
			<div class="text-center opc-7">
				<h2>{{ trans("$TR.T2") }}</h2>
				<h3>{{ trans("$TR.T3") }}</h3>
			</div>
		@endif

	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			search_status();
		});
	</script>
@stop
