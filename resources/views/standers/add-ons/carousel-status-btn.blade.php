<button class="carousel-status btn-{{ $product->carousel_status == 1 ? 'success' : 'danger'}} btn btn-sm pull-right" product-id="{{ $product->id }}" data-status="{{ $product->carousel_status }}" title="{{ trans('admin_panel.APVP.T17') }}" aria-hidden="true" data-toggle="tooltip" data-placement="top">
	<span class="glyphicon glyphicon-picture"></span>
	&nbsp;
	@if($product->carousel_status == 1)
		<span class="glyphicon glyphicon-ok-sign switch"></span>
	@else
		<span class="glyphicon glyphicon-remove-sign switch"></span>
	@endif
</button>

<script type="text/javascript">
	$(document).ready(function(){	
		onOff_status('.carousel-status', '/admin/products/carousel/live-status');
	});
</script>