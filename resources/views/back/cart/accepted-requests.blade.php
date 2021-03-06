<?php
	/* Translation */
	$TR = "admin_panel.ACVAIP";
?>

@extends("back.master")
@section('title', trans("admin_panel.APT.T7"))

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
									</tr>
								</thead>
								<tbody>
									@foreach($cart_items as $item)
										<tr>
											<td data-title='{{ trans("$TR.T5") }}'>
												@if($item->status == "real")
													<img src='{{ asset("uploaded/products/images/$item->id/$item->image_name") }}' style="width: 100px">
												@else
													<img src='http://placehold.it/50x50/2d2d2d/FFF'>
												@endif
											</td>
											<td data-title='{{ trans("$TR.T6") }}'>{{ $item->product_name }}</td>
											<td data-title='{{ trans("$TR.T7") }}'>{{ $item->product_price }} {{ $global_setting->main_currency }}</td>
											<td data-title='{{ trans("$TR.T8") }}'>{{ $item->product_quantity }}</td>
											<td data-title='{{ trans("$TR.T9") }}'>{{ $item->payment_method }}</td>
											<td data-title='{{ trans("$TR.T10") }}'>{{ $item->created_at }}</td>
											<td data-title='{{ trans("$TR.T11") }}'>{{ date("d/m/Y", $item->accepted_at_timestamps) }}</td>
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