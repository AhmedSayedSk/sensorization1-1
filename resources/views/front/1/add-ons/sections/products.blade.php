<?php
	/* Translation */
	$TR = "frontend.$frontendNumber.add-ons.PS1";
?>

<div class="row">
	@foreach($products as $product)
		<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
			<div class="panel" product-id="{{ $product->id }}" serial-number="{{ $product->serial_number }}">
				@if($product->is_new)
					<div class="edge-corner">
						<img src="front/helper_images/new-corner.png">
					</div>
				@endif
				<div class="panel-body">
					<a href='/products/{{ $product->serial_number }}/{{ $product_name = implode("-", explode(" ", $product->name)) }}'>
						@if($product->is_real)
							<img src='./uploaded/products/images/$product->id/$product->image_name'>
						@else
							<?php $r_colors = ['F44336', 'E91E63', '9C27B0', '009688', 'EEEEEE', '2d2d2d'] ?>
							<img src='http://placehold.it/200x200/{{ $r_colors[array_rand($r_colors)] }}/FFF'>
						@endif
					</a>
				</div>
				<div class="panel-footer">
					<p class="p-name">{{ $product->name }}</p>
					<p class="p-price">
						@if($product->discount_percentage > 0)
							<del>{{ $product->price }} {{ $main_currency }}</del>
							&nbsp;
						@endif
						<b class="text-success">{{ $product->discountPrice }} {{ $main_currency }}</b>
					</p>
					<p class="p-sales">{{ trans("$TR.T1") }} {{ $product->sales }}</p>
					<p class="p-amount">{{ trans("$TR.T4") }} {{ $product->amount }}</p>
					<div class="options">
						<div class="add-to-cart">
							<button class="btn btn-link" title="{{ trans("$TR.T3") }}" aria-hidden="true" data-toggle="tooltip" data-placement="top">
								<span class="glyphicon glyphicon-shopping-cart"></span>
							</button>
						</div>
						<div class="product-details">
							<a class="btn btn-link" href='/products/{{ $product->serial_number }}/{{ $product_name }}'>
								{{ trans("$TR.T2") }}
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endforeach
</div>

<script type="text/javascript">
	$(document).ready(function(){
		product_addToCart([
			'you need to login first, Login now?',
			'The request was cancelled',
			'Detect product quantity'
		]);
	});
</script>
