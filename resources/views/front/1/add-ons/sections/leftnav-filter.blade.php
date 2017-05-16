<?php

	use App\Models\Product\Category1;
	use App\Logic\Product\SearchFormat;
	use Hashids\Hashids;

	$searchFormat = new SearchFormat;
	$SF_price = $searchFormat->price();
	$SF_sales = $searchFormat->sales(.15, .70);

	$hashids = new Hashids('', 6, '0123456789CtNuoA');
	$main_categories = Category1::lists('name', 'id');

	/* Translation */
	$TR = "frontend.$frontendNumber.add-ons.LNF1";

?>

<div id="filter-bar">
	<div class="panel panel-default">
		<div class="panel-heading">{{ trans("$TR.T1") }}</div>
		<div class="panel-body">
			{!! Form::open(["url"=>"/products/search", "method"=>"get", "target"=>"_blank"]) !!}
				<div class="form-group" data-type="name" data-values="1">
					<label>
						<span class="glyphicon glyphicon-pencil"></span>
						<b>{{ trans("$TR.T5") }}</b>
					</label>
					{!! Form::text("", "", ["class"=>"form-control name1", "placeholder"=>""]) !!}
				</div>
				<div class="form-group" data-type="price" data-values="2">
					<label>
						<span class="glyphicon glyphicon-piggy-bank"></span>
						<b>{{ trans("$TR.T6") }}</b>
					</label>
					<div class="input-group">
						{!! Form::text("", "", ["class"=>"form-control price1 from", "placeholder" => trans("$TR.T8", ['price'=>$SF_price->min, 'currency'=>$main_currency])]) !!}
						<span class="input-group-btn" style="width: 0px;"></span>
						{!! Form::text("", "", ["class"=>"form-control price2 to", "placeholder" => trans("$TR.T9", ['price'=>$SF_price->max, 'currency'=>$main_currency]) ]) !!}
					</div>
					<span class="help-block">{{ trans("$TR.T7") }}</span>
				</div>
				<div class="form-group" data-type="category">
					<label>
						<b>{{ trans("$TR.T12") }}</b>
					</label>
					<select class="form-control">
						<option>{{ trans("$TR.T11") }}</option>
						@foreach($main_categories as $key => $cat)
							<option value="{{ $hashids->encode($key) }}">{{$cat}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group" data-type="sales_range">
					<label>
						<b>{{ trans("$TR.T10") }}</b>
					</label>
					<select class="form-control">
						<option value="0">Show all</option>
						@foreach($SF_sales as $key => $value)
							<option value="{{ $key }}">{{ $value['title'] }} {{ $value['salesCount'] > 0 ? " - ".$value['salesCount'] : '' }}</option>
						@endforeach
					</select>
				</div>
				<div>
					<span class="help-block">{{ trans("$TR.T13") }}</span>
					{!! Form::submit(trans("$TR.T3"), ["class"=>"btn btn-default"]) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
	