<?php
	/* Translation */
	$TR = "payments.paypal";
?>

@extends("front.$frontendNumber.master")
@section("title", trans("frontend.$frontendNumber.PT.T4"))

@section("content")
	<div class="container">
		<h3 class="text-center">
			<p>{{ trans("$TR.T1")}}</p>
			<p><a href="/">{{ trans("$TR.T2")}}</a></p>
			<p><a href="/my-cart">{{ trans("$TR.T3")}}</a></p>
		</h3>
	</div>
@stop