<?php
	/* Translation */
	$TR = "frontend.$frontendNumber.UP.left-nav";
?>

<div class="list-group">
	<div class="panel panel-default">
		<div class="panel-heading">{{ trans("$TR.T1") }}</div>
		<div class="panel-body">
			<a href="/profile" class="list-group-item">{{ trans("$TR.T2") }}</a>
			<a href="/my-cart" class="list-group-item">{{ trans("$TR.T3") }}</a>
			<a href="/profile/edit-my-information" class="list-group-item">{{ trans("$TR.T4") }}</a>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		navLinkActivation('/{{Request::path()}}');
	});
</script>