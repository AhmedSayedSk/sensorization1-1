<?php
	/* Translation */
	$TR = "admin_panel.APTVP";
?>

@extends('back.master')
@section('title', trans('admin_panel.APT.T6'))

@section('content')
	<div id="tag-products-view-page">
		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans("$TR.T1") }}
				<a href="{{ route('APT.view-append-modal') }}" class="btn btn-default btn-sm pull-right" data-toggle="modal" data-target="#Modal" data-remote="false" title='{{ trans("$TR.T11") }}'>
					<span class="glyphicon glyphicon-plus"></span>
					&nbsp;
					{{ trans("$TR.T11") }}
				</a>
			</div>
			<div class="panel-body">
				<div class="container-fluid">
					<div id="response-table">
						<table class="table table-striped table-hover sortable ps-view">
							<thead>
								<tr>
									<th>{{ trans("$TR.T2") }}</th>
									<th colspan="2">{{ trans("$TR.T3") }}</th>
									<th>{{ trans("$TR.T7") }}</th>
								</tr>
								<tr>
									<th></th>
									<th width="15%" class="success">{{ trans("$TR.T4") }}</th>
									<th width="15%" class="warning">
										{{ trans("$TR.T5") }} 
										(<a href="/admin/products/search?isLive=1" target="_blank">{{ trans("$TR.T6") }}</a>)
									</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($tags as $inner)
									<tr data-tagId="{{ $inner->id }}">
										<td data-title='{{ trans("$TR.T2") }}' class="tag-name">
											{!! $inner->tag_name !!}
										</td>
										<td data-title='{{ trans("$TR.T4") }}' class="success">
											{!! $products_count_live = App\Models\Product\Tag::find($inner->id)->products()->users_roles()->count() !!}
										</td>
										<td data-title='{{ trans("$TR.T5") }}' class="warning">
											{!! App\Models\Product\Tag::find($inner->id)->products()->count() !!}
										</td>
										<td data-title='{{ trans("$TR.T7") }}'>
											<a href="/admin/products/tags/{{ $inner->tag_name }}" class="btn btn-default btn-xs" {{ $products_count_live <= '0' ? 'disabled' : '' }}>
												<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
											</a>
											<a href="#" class="btn btn-success btn-xs edit-tag">
												<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
											</a>
											{!! Form::open(["url"=>"/admin/products/tags/$inner->id", "method"=>"DELETE"]) !!}
												<button type="submit" class="btn btn-danger btn-xs delete-tag" aria-label="Left Align">
													<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
												</button>
												{!! Form::hidden("delete_products", 0, ["class"=>"delete-products"]) !!}
											{!! Form::close() !!}
										</td>
									</tr>
								@endforeach				
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="text-center">
			{!! $tags->render() !!}
		</div>
	</div>

	<!-- Default bootstrap modal example -->
	@include('standers.modal')
	
	<script type="text/javascript">
		tagModal(['{{ trans("$TR.T12") }}'], null, null, null, null);

		$('.delete-tag').on('click', function(){
			var input = $(this).parent().find('[type="hidden"].delete-products');
			if(confirm('{{ trans("$TR.T10") }}')) {
				if(confirm('{{ trans("$TR.T8") }}')){
					input.val(1);
				} else {
					input.val(0);
				}
			} else {
				return false;
			}
		});

		$('.edit-tag').on('click', function(e){
			e.preventDefault();

			function hide_inputBox(_this, selector, tag_value){
				_this.removeClass('active');
				selector.text(tag_value);
				_this.removeAttr('data-tagName');
			}

			var _this = $(this);
			var tag_name_selector = _this.parents('tr').find('.tag-name');
			var tag_name = $.trim(tag_name_selector.text());

			if(!_this.hasClass('active')){
				_this.addClass('active');
				_this.attr('data-tagName', tag_name);

				tag_name_selector.html('\
					<div class="input-group input-group-sm">\
				      <input type="text" class="tag-name form-control" value="'+tag_name+'" placeholder="{{ trans("$TR.T9") }}">\
				      <span class="input-group-btn">\
				        <button class="btn btn-default update-tag" type="button">{{ trans("$TR.T6") }}</button>\
				      </span>\
				    </div>\
			    ');
			} else {
				hide_inputBox(_this, tag_name_selector, _this.attr('data-tagName'));
			}

			$("body button.update-tag").one('click', function(e){
				var _this2 = $(this);
				var new_tagName = _this2.parents('.input-group').find('> input.tag-name').val();
				var tag_id = _this2.parents('tr').attr('data-tagId');
				
				$.ajax({
					url: "/admin/products/tags/"+tag_id,
					type: "PATCH",
					data: {
						tag_name: new_tagName
					},
					success: function(data){
						hide_inputBox(_this, tag_name_selector, data);
					}
				})
			});	
		});
	</script>
@stop

@section('head-css')
	<link rel="stylesheet" type="text/css" href="./packages/bootstrap-sortable/Contents/bootstrap-sortable.css">
@stop

@section('footer-js')
	<script type="text/javascript" src="./packages/bootstrap-sortable/Scripts/bootstrap-sortable.js"></script>
	<script type="text/javascript" src="./packages/bootstrap-sortable/Scripts/moment.min.js"></script>
@stop