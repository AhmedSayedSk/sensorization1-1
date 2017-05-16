<?php

	$pendingRequestsCount = App\Models\CartItem::where('is_accepted', 0)->count();
	$acceptedRequestsCount = App\Models\CartItem::where('is_accepted', 1)->count();

	/* Translation */
	$TR = "admin_panel.AN";
?>

<div class="list-group">
	<div class="panel panel-default">
		<div class="panel-heading">{{ trans("$TR.T6") }}</div>
		<div class="panel-body">
			<a href="/admin" class="list-group-item">{{ trans("$TR.T3") }}</a>
			<a href="/admin/products" class="list-group-item">{{ trans("$TR.T5") }}</a>
			<a href="/admin/products/create/step/1" class="list-group-item">{{ trans("$TR.T7") }}</a>
			<a href="/admin/products/categories" class="list-group-item">{{ trans("$TR.T8") }}</a>
			<a href="/admin/products/carousel" class="list-group-item">{{ trans("$TR.T9") }}</a>
			<a href="/admin/products/tags" class="list-group-item">{{ trans("$TR.T10") }}</a>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">{{ trans("$TR.T11") }}</div>
		<div class="panel-body">
			<a href="/admin/review-cart/pending-requests" class="list-group-item">
				{{ trans("$TR.T12") }} ({{ trans("$TR.T13") }})
				<span class="badge">{{ $pendingRequestsCount }}</span>
			</a>
			<a href="/admin/review-cart/accepted-requests" class="list-group-item">
				{{ trans("$TR.T12") }} ({{ trans("$TR.T14") }})
				<span class="badge">{{ $acceptedRequestsCount }}</span>
			</a>
			<a href="/admin/clients/users/accounts" class="list-group-item">{{ trans("$TR.T15") }}</a>
			<a href="/admin/clients/admins/accounts" class="list-group-item">{{ trans("$TR.T16") }}</a>
		</div>
	</div>
	@if($personType == "super_admin")
		<div class="panel panel-default">
			<div class="panel-heading">{{ trans("$TR.T17") }}</div>
		  	<div class="panel-body">
		  		<a href="/admin/edit-super-admin" class="list-group-item">{{ trans("$TR.T19") }}</a>
		    	<a href="/admin/clients/admins/accounts/create" class="list-group-item">{{ trans("$TR.T20") }}</a>
				<a href="/admin/site-setting" class="list-group-item">{{ trans("$TR.T21") }}</a>
		  	</div>
		</div>
	@endif
</div>

<script type="text/javascript">
	$(document).ready(function(){
		navLinkActivation('/{{Request::path()}}');
	});
</script>
