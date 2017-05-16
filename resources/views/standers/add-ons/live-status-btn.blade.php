<button class="live-status btn-{{ $product->is_live == 1 ? 'success' : 'danger'}} btn btn-sm pull-right" product-id="{{ $product->id }}" data-status="{{ $product->is_live }}" title="{{ trans('admin_panel.APVP.T16') }}" aria-hidden="true" data-toggle="tooltip" data-placement="top">
	<span class="glyphicon glyphicon-oil"></span>
	&nbsp;
	@if($product->is_live == 1)
		<span class="glyphicon glyphicon-ok-sign switch"></span>
	@else
		<span class="glyphicon glyphicon-remove-sign switch"></span>
	@endif
</button>

<script type="text/javascript">
	$(document).ready(function(){	
		onOff_status('.live-status', '/admin/products/live-status');
	});
</script>