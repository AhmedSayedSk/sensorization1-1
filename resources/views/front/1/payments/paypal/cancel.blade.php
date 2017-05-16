<?php
	/* Translation */
	$TR = "payments.paypal";
?>

@extends("front.$frontendNumber.master")
@section("title", trans("frontend.$frontendNumber.PT.T4"))

@section("content")
	<div class="container">
		<h3 class="text-center">
			<span>{{ trans("$TR.T4")}}</span> 
			<a href="/my-cart">{{ trans("$TR.T3")}}</a>
		</h3>
	</div>
@stop