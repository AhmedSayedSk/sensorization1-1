<?php

	use App\Logic\Product\SearchFormat;

	$searchFormat = new SearchFormat;
	$SF_price = $searchFormat->price();
	$SF_sales = $searchFormat->sales(.15, .70);

	/* Translation */
	$TR = "admin_panel.APFS";

?>

<div id="filter-bar" class="container-fluid">
	<div class="panel panel-default">
		<div class="panel-heading">{{ trans("$TR.T1") }}</div>
		<div class="panel-body">
			{!! Form::open(['url'=>'/admin/products/search', "method"=>"get", "target"=>"_blank"]) !!}
				<div class="form-group" data-type="name" data-values="1" data-status="0">
					<label>
						<span class="glyphicon glyphicon-pencil"></span>
						<b>{{ trans("$TR.T5") }}</b>
					</label>
					{!! Form::text("", "", ["class"=>"form-control name1"]) !!}
				</div>
				<div class="form-group" data-type="price" data-values="2" data-status="0">
					<label>
						<span class="glyphicon glyphicon-piggy-bank"></span>
						<b>{{ trans("$TR.T6") }}</b>
					</label>
					<div class="input-group">
						{!! Form::text("", "", ["class"=>"form-control price1 from", "placeholder" => 
							trans("$TR.T8", [
								'price' => $SF_price->min, 
								'currency' => $main_currency
							])
						]) !!}
						<span class="input-group-btn" style="width: 0px;"></span>
						{!! Form::text("", "", ["class"=>"form-control price2 to", "placeholder" => 
							trans("$TR.T9", [
								'price' => $SF_price->max, 
								'currency' => $main_currency
							])
						]) !!}
					</div>
					<span class="help-block">{{ trans("$TR.T7") }}</span>
				</div>
				<div class="form-group" data-type="sales_range" data-status="0">
					<label>
						<b>{{ trans("$TR.T10") }}</b>
					</label>
					<select class="form-control">
						<option value="0">{{ trans("$TR.T11") }}</option>
						@foreach($SF_sales as $key => $value)
							<option value="{{ $key }}">{{ $value['title'] }} {{ $value['salesCount'] > 0 ? " - ".$value['salesCount'] : '' }}</option>
						@endforeach
					</select>
				</div>
				<!-- checkboxes -->
				<div class="form-group" data-status="0">
					<div class="checkbox">
						<label>
							{!! Form::checkbox("isLive", 1, isset($_GET['isLive']) ? 1 : null, ["class"=>"checkbox"]) !!}
							<b>{{ trans("$TR.T2") }}</b>
						</label>
					</div>
					<div class="checkbox">
						<label>
							{!! Form::checkbox("isDiscounted", 1, isset($_GET['isDiscounted']) ? 1 : null, ["class"=>"checkbox"]) !!}
							<b>{{ trans("$TR.T4") }}</b>
						</label>
					</div>
				</div>
				<button type="submit" class="btn btn-default">
					{{ trans("$TR.T3") }} <span class="icomoon-arrow-10"></span>
				</button>

				@if(isset($redirectFrom) && $redirectFrom == 'tags')
					{!! Form::hidden("ids", $productsIds) !!}
				@endif
			{!! Form::close() !!}
		</div>
	</div>
</div>