<?php
	/* Translation */
	$TR = "errors.US";
?>

<!DOCTYPE html>
<html>
<head>
	<title>{{ trans("$TR.T1") }}</title>
	<style type="text/css">
		body {
			padding-top: 80px;
			background: #FCFCFC;
			color: #2d2d2d;
			height: 500px;
			font-family: 'Open Sans', sans-serif;
		}
	</style>
</head>
<body>
	<center>
		<h1>{{ $msg }}</h1>
		<img src="{{ asset('assets/icons/404.png') }}">
		<h3><a href="/admin">{{ trans("$TR.T2") }}</a></h3>
	</center>
</body>
</html>