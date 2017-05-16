<div id="carousel" class="carousel slide" data-ride="carousel">

	<!-- Indicators -->
	<ol class="carousel-indicators">
		<?php $y = "active"; $i = 0; ?>
		@foreach($products_carousel as $product)
			<li data-target="#carousel" data-slide-to="{{ $i }}" class="{{ $y }}"></li>
			<?php $y = ""; $i++ ?>
		@endforeach
	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">
		<?php $x = "active" ?>
		@foreach($products_carousel as $product)
			<div class="item {{ $x }}">
				<a href='/products/{{ $product->serial_number }}/{{ $product_name = implode("-", explode(" ", $product->name)) }}'>
					@if($product->is_real)
						<img src='{{ asset("uploaded/products/carousel_gallery/$product->carousel_image_name") }}'>
					@else
						<?php $colors = ['F44336', 'E91E63', '9C27B0', '009688'] ?>
						<img src='http://placehold.it/1500x450/{{ $colors[array_rand($colors)] }}/FFF'>
					@endif
				</a>
				<div class="carousel-caption">
					<h4>{{ $product->name }}</h4>
				</div>
			</div>
			<?php $x = "" ?>
		@endforeach
	</div>

	<!-- Controls -->
	<a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#carousel" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>