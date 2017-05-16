<a href="/admin/products/{{ $product->id }}" class="btn btn-default btn-sm" title="{{ trans('admin_panel.A3') }}" aria-hidden="true" data-toggle="tooltip" data-placement="top">
	<span class="glyphicon glyphicon-eye-open"></span>
</a>

@include('standers.add-ons.live-status-btn')

<a href="/admin/products/{{ $product->id }}/edit" class="btn btn-default btn-sm" title="{{ trans('admin_panel.A4') }}" aria-hidden="true" data-toggle="tooltip" data-placement="top">
	<span class="glyphicon glyphicon-pencil"></span>
</a>

@include('standers.add-ons.carousel-status-btn')

{!! Form::open(["url"=>"admin/products/$product->id", "method"=>"DELETE"]) !!}
  	<button type="submit" class="btn btn-default btn-sm" title="{{ trans('admin_panel.A5') }}" aria-hidden="true" data-toggle="tooltip" data-placement="top">
  		<span class="glyphicon glyphicon-remove"></span>
  	</button>
{!! Form::close() !!}

@include('standers.add-ons.new-product-status-btn')