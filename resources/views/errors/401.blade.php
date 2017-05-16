<?php
	/* Translation */
	$TR = "errors.401";
?>

<!DOCTYPE html>
<html>
<head>
	<title>{{ trans("$TR.T1") }}</title>
	<style type="text/css">
		body {
			padding-top: 80px;
			/*background: linear-gradient(to bottom, #E3F2FD , #FFF) no-repeat;*/
			background: #FCFCFC;
			color: #2d2d2d;
			height: 500px;
			font-family: 'Open Sans', sans-serif;
		}
	</style>
</head>
<body>
	<center>
		<h1>{{ trans("$TR.T2") }}</h1>
		<img src="{{ asset('assets/icons/stop.png') }}">
		<h3><a href="/admin">{{ trans("$TR.T3") }}</a></h3>
	</center>
</body>
</html>