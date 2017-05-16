<!DOCTYPE html>
<html lang="en">
<head>
	<base href='<?= URL::to('./'); ?>'>
    <script>var base = '<?= URL::to('./'); ?>';</script>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="./front/icons/logo-icon.png">
    <meta name="author" content="Development: Ahmed Sayed Omar">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>@yield('title')</title>

	<link rel="stylesheet" type="text/css" href="./packages/bootstrap/css/bootstrap.min.css">
	@yield('head-css')
	<link rel="stylesheet" type="text/css" href="./assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="./back/assets/css/main.css">

	@if(App::getLocale('locale') == 'ar')
		<link rel="stylesheet" href="./packages/bootstrap-rtl/dist/css/bootstrap-rtl.min.css">
		<link rel="stylesheet" type="text/css" href="./assets/css/langs/ar/main.css">
		<link rel="stylesheet" type="text/css" href="./back/assets/css/langs/ar/main.css">
	@endif

	<script type="text/javascript" src="./assets/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="./packages/bootstrap/js/bootstrap.min.js"></script>
	@yield('head-js')
	<script type="text/javascript" src="./back/assets/js/main.js"></script>
	<script type="text/javascript" src="./assets/js/main.js"></script>

	@if(App::getLocale('locale') == 'ar')
		<script type="text/javascript" src="./back/assets/js/langs/ar/main.js"></script>
	@endif
</head>
<body>
	@include('back.add-ons.navbar-1')

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3" id="left-nav">
				@include('back.add-ons.left-nav')
			</div>
			<div class="col-md-9" id="content">
				@yield('content')
			</div>
		</div>
	</div>		

	<footer id="footer">
		<div class="container footer-bottom">
			<span>© 2016 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></span> ·
			<span>Sensorization demo project</span>
		</div>
	</footer>

	@yield('footer-js')
	<script type="text/javascript" src="./assets/js/token.js"></script>
</body>
</html>




