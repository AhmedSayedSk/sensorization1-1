<?php
	/* Translation */
	$TR = "frontend.$frontendNumber.UP.CVP";
?>

@extends("front.$frontendNumber.user.master")
@section('title', trans("frontend.$frontendNumber.PT.T5"))

@section('content')
	<div id="cart-view-page">
		<div class="panel panel-default">
			<div class="panel-heading">
				<b>{{ trans("$TR.T1") }}</b>
			</div>
			<div class="panel-body">
				@if(Cart::isEmpty())
				<div class="container-fluid empty-cart">
					<div class="text-center">
						<img src="./front/helper_images/empty-cart.png">
						<h3 class="text-center">
							<a href="/products">{{ trans("$TR.T2") }}</a>
						</h3>
					</div>
				</div>
				@else
					<div class="container-fluid">
						{!! Form::open(["url"=>"/paypal-payment"]) !!}
						<?php $i = 1; ?>
						<div id="response-table">
							<table class="table table-hover table-bordered table-striped">
								<thead>
									<tr>
										<th>{{ trans("$TR.T3") }}</th>
										<th>{{ trans("$TR.T4") }}</th>
										<th>{{ trans("$TR.T5") }}</th>
										<th>{{ trans("$TR.T6") }}</th>
										<th>{{ trans("$TR.T7") }}</th>
										<th>{{ trans("$TR.T8") }}</th>
										<th>{{ trans("$TR.T9") }}</th>
										<th>{{ trans("$TR.T10") }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($cart_total_items as $item)
										<tr>
											<td data-title='{{ trans("$TR.T3") }}'>
												@if($item->attributes->is_real)
													<img src='{{ asset("uploaded/products/images/$item->id/".$item->attributes->image_name) }}'>
												@else
													<img src='http://placehold.it/80x80/2d2d2d/FFF'>
												@endif
											</td>
											<td data-title='{{ trans("$TR.T4") }}'>{{ $item->name }} {{ Form::hidden("item_name_$i", $item->name) }}</td>
											<td data-title='{{ trans("$TR.T5") }}'>{{ $item->attributes->discount_percentage }}</td>
											<td data-title='{{ trans("$TR.T6") }}'>
												{{ $item->quantity }}
												{{ Form::hidden("item_quantity_$i", $item->quantity) }}
											</span>
											</td>
											<td data-title='{{ trans("$TR.T7") }}'>
												<del>{{ number_format($item->price) }}</del><br>
												<span>
													{{ number_format($item->attributes->discountPrice) }}
													{{ Form::hidden("item_price_$i", $item->attributes->discountPrice) }}
												</span>
											</td>
											<td data-title='{{ trans("$TR.T8") }}'>
												<del>{{ number_format($item->price * $item->quantity) }}</del><br>
												<span>{{ number_format($item->attributes->discountPrice * $item->quantity) }}</span>
											</td>
											<td data-title='{{ trans("$TR.T9") }}'>
												{{ $main_currency }}
											</td>
											<td class="options" data-title='{{ trans("$TR.T10") }}'>
												<span class="remove-item btn btn-default btn-xs" aria-label="Left Align" item-id="{{ $item->id }}">
													<span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>
												</span>
												<?php $product_name = implode("-", explode(" ", $item->name)); ?>
												<a href="/products/{{ $item->attributes->product_serial_number }}/{{ $product_name }}">
													<span class="btn btn-default btn-xs" aria-label="Left Align" item-id="{{ $item->id }}">
														<span class="glyphicon glyphicon-eye-open text-primary" aria-hidden="true"></span>
													</span>
												</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="extra">
							<p class="total-price">
								{{ trans("$TR.T11") }}
								<b>{{ number_format($totalPrice) }} {{ $main_currency }}</b>
								{{ Form::hidden("total_price", $totalPrice) }}
							</p>

							{!! Form::hidden("items_number", $itemsCount) !!}
							{!! Form::submit(trans("$TR.T12"), ["class"=>"btn btn-default"]) !!}
							{!! Form::close() !!}

							{!! Form::open(["url"=>"/on-delivery-payment", 'class'=>"on-delivery"]) !!}
								{!! Form::submit(trans("$TR.T13"), ["class"=>"btn btn-default on-delivery-payment"]) !!}
							{!! Form::close() !!}

							<a href="/my-cart/clear-cart" class="btn btn-default">
								<span class="text-danger">{{ trans("$TR.T14") }}</span>
							</a>
							<a href="/products" class="btn btn-link">{{ trans("$TR.T15") }}</a>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>

    <script type="text/javascript">
	    $(document).ready(function(){
	        cartRemoveItem();
	    });
	</script>
@stop
