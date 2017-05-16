<?php
	/* Translation */
	$TR = "frontend.$frontendNumber.APCVP";
?>

@extends("front.$frontendNumber.master")
@section('title', trans("frontend.$frontendNumber.PT.T2"))

@section('content')
	<div id="products-view">
		<div class="container-fluid content">
			@if(count($products) == 0)
				<h2 class="text-center opc-6">{{ trans("$TR.T1") }}</h2>
			@else
			<div class="row">
				<div class="col-md-3">
					@include("front.$frontendNumber.add-ons.sections.leftnav-filter")
				</div>
				<div class="col-md-9">
					<div id="products-container">
						@if(isset($title1))
							<div class="well">{!! $title1 !!}</div>
						@endif
						@include("front.$frontendNumber.add-ons.sections.products")
					</div>
					<div class="text-center">
						{!! $products->render() !!}
					</div>
				</div>
			</div>
			@endif
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			search_status();
		});
	</script>
@stop
