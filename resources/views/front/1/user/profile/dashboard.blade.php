<?php 
	/* Translation */
	$TR = "frontend.$frontendNumber.UP.DB"; 
?>

@extends("front.$frontendNumber.user.master")
@section('title', trans("frontend.$frontendNumber.PT.T6"))

@section('content')
	<div id="dashboard-page">
		<div class="panel panel-default">
			<div class="panel-heading">
				<b>{{ trans("$TR.T1") }}</b>
			</div>
			<div class="panel-body">
				<div class="container-fluid">
					<span>{{ trans("$TR.T2", ['name'=>$user->name]) }}</span>
				</div>
			</div>
		</div>
	</div>
@stop