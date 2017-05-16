<?php
	/* Translation */
	$TR = "admin_panel.ACVPIP";
?>

@extends("back.master")
@section('title', trans("admin_panel.APT.T8"))

@section("content")
	<div id="cart-view-page">
		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans("$TR.T1") }} - {!! trans("$TR.T4") !!}
			</div>
			<div class="panel-body">
				@if(count($cart_items) == 0)
					<h3 class="text-center">
						{{ trans("$TR.T2") }}
						<a href="/admin/products">{{ trans("$TR.T3") }}</a>
					</h3>
				@else
					<div class="container-fluid">
						<div id="response-table">
							<table class="table table-striped table-bordered ps-view">
								<thead>
									<tr>
										<th>{{ trans("$TR.T5") }}</th>
										<th>{{ trans("$TR.T6") }}</th>
										<th>{{ trans("$TR.T7") }}</th>
										<th>{{ trans("$TR.T8") }}</th>
										<th>{{ trans("$TR.T9") }}</th>
										<th>{{ trans("$TR.T10") }}</th>
										<th>{{ trans("$TR.T11") }}</th>
										<th>{{ trans("$TR.T12") }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($cart_items as $item)
										<tr>
											<td data-title='{{ trans("$TR.T5") }}'>
												@if($item->is_real)
													@if(!is_null($item->image_name))
														<img src='{{ asset("uploaded/products/images/icon_size/$item->image_name") }}'>
													@else
														<img src='{{ asset("assets/images/no-image.png") }}'>
													@endif
												@else
													<img src='http://placehold.it/120x120/2d2d2d/FFF'>
												@endif
											</td>
											<td data-title='{{ trans("$TR.T6") }}' width="10%">{{ $item->product_name }}</td>
											<td data-title='{{ trans("$TR.T7") }}'>{{ $item->product_price }} {{ $global_setting->main_currency }}</td>
											<td data-title='{{ trans("$TR.T8") }}'>{{ $item->product_quantity }}</td>
											<td data-title='{{ trans("$TR.T9") }}'>{{ $item->current_amount }}</td>
											<td data-title='{{ trans("$TR.T10") }}'>{{ $item->payment_method }}</td>
											<td data-title='{{ trans("$TR.T11") }}'>{{ $item->created_at }}</td>
											<td data-title='{{ trans("$TR.T12") }}' width="12%">
												{!! Form::open(["url"=>route("admin.review-cart..store")]) !!}
													{!! Form::hidden('item_id', $item->id) !!}
													{!! Form::hidden('product_id', $item->product_id) !!}
													{!! Form::hidden('needed_quantity', $item->product_quantity) !!}
													<button type="submit" class="btn btn-primary btn-xs">{{ trans("$TR.T13") }}</button>
												{!! Form::close() !!}
												{!! Form::open(["url"=>"/admin/review-cart/$item->id", "method"=>"DELETE"]) !!}
													<button type="submit" class="btn btn-danger btn-xs" aria-label="Left Align">
														<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
													</button>
												{!! Form::close() !!}
											</td>
										</tr>
									@endforeach				
								</tbody>
							</table>
						</div>
					</div>
				@endif
			</div>
			<div class="text-center">
				{!! $cart_items->render() !!}
			</div>
		</div>
	</div>		
@stop