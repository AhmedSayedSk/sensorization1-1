@if($product->is_real)
	@if(!is_null($product->carousel_name))
		<img src='{{ asset("uploaded/products/carousel_gallery/small/$product->carousel_name") }}' height="150px">
	@else
		<img src='{{ asset("assets/images/no-image.png") }}' width="120px">
	@endif
@else
	<img src='http://placehold.it/320x120/2d2d2d/FFF'>
@endif