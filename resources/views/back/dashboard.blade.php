<?php
	/* Translation */
	$TR = "admin_panel.ADP";
?>

@extends('back.master')
@section('title', trans('admin_panel.APT.T1'))

@section('content')
	<div id="dashboard-page">
		<div class="panel panel-default">
			<div class="panel-heading">
				<b>{{ trans("$TR.T8") }}</b>
			</div>
			<div class="panel-body">
				<p>{{ trans("$TR.T1") }}: <b>{{ $products_count }}</b></p>
				<p>{{ trans("$TR.T2") }}: <b>{{ $live_products_count }}</b></p>
				<p>
					{{ trans("$TR.T3", ['number' => $products_carousel_count]) }}
					<i class="help-block">{{ trans("$TR.T5") }}</i>
				</p>
				<p>{{ trans("$TR.T6", ['number' => $visitor_count]) }}</p>
				<p>{{ trans("$TR.T7", ['number' => $visitor_count_lastWeek]) }}</p>		
			</div>
		</div>
	</div>
@stop