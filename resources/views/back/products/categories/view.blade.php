<?php
	/* Translation */
	$TR = "admin_panel.APCVP";
?>

@extends('back.master')
@section('title', trans("admin_panel.APT.T4"))

@section('content')
	<div id="products-categories-view-page">
		<div class="panel panel-default">
			<div class="panel-heading">{{ trans("$TR.T2") }}</div>
			<div class="panel-body">
				<ul id="tree1">
		            @foreach($p_cats[0] as $cat1)
		            	<li>
		            		<a href="#">{{ $cat1->name }}</a>
		            		{!! Form::open(["url"=>"/admin/products/categories/1", "method"=>"DELETE", 'style'=>"display: inline-block"]) !!}
								{!! Form::hidden('cat_id', $cat1->id) !!}
								{!! Form::submit('delete', ['class' => 'delete-category btn btn-danger btn-xs', 'style'=>"display: none"]) !!}
							{!! Form::close() !!}
		            		<ul>
		            			@foreach($p_cats[1] as $cat2)
		            				@if($cat1->id == $cat2->related_id)
		            					<li>
		            						<a href="#">{{ $cat2->name }}</a>
		            						{!! Form::open(["url"=>"/admin/products/categories/2", "method"=>"DELETE", 'style'=>"display: inline-block"]) !!}
		            							{!! Form::hidden('cat_id', $cat2->id) !!}
												{!! Form::submit('delete', ['class' => 'delete-category btn btn-danger btn-xs', 'style'=>"display: none"]) !!}
											{!! Form::close() !!}
		                					<ul>
		                						@foreach($p_cats[2] as $cat3)
		                							@if($cat2->id == $cat3->related_id)
		                								<li>
		                									<a href="#">{{ $cat3->name }}</a>
		                									{!! Form::open(["url"=>"/admin/products/categories/3", "method"=>"DELETE", 'style'=>"display: inline-block"]) !!}
					                							{!! Form::hidden('cat_id', $cat3->id) !!}
																{!! Form::submit('delete', ['class' => 'delete-category btn btn-danger btn-xs', 'style'=>"display: none"]) !!}
															{!! Form::close() !!}
		                									<ul>
						                						@foreach($p_cats[3] as $cat4)
						                							@if($cat3->id == $cat4->related_id)
						                								<li>
							                								<a href="#" onclick="return false">{{ $cat4->name }}</a>
							                								{!! Form::open(["url"=>"/admin/products/categories/4", "method"=>"DELETE", 'style'=>"display: inline-block"]) !!}
									                							{!! Form::hidden('cat_id', $cat4->id) !!}
																				{!! Form::submit('delete', ['class' => 'delete-category btn btn-danger btn-xs', 'style'=>"display: none"]) !!}
																			{!! Form::close() !!}
						                								</li>
						                							@endif
						                						@endforeach
						                						<li>
						                							<a class="btn btn-default btn-xs" data-toggle="modal" data-target="#Modal" data-remote="false" data-cat-num="4" data-related-id="{{ $cat3->id }}">
																		<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {{ trans("$TR.T1") }}
																	</a>
						                						</li>
						                					</ul>
		                								</li>
		                							@endif
		                						@endforeach
		                						<li>
		                							<a class="btn btn-default btn-xs" data-toggle="modal" data-target="#Modal" data-remote="false" data-cat-num="3" data-related-id="{{ $cat2->id }}">
														<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {{ trans("$TR.T1") }}
													</a>
		                						</li>
		                					</ul>
		            					</li>
		            				@endif
		            			@endforeach
		            			<li>
        							<a class="btn btn-default btn-xs" data-toggle="modal" data-target="#Modal" data-remote="false" data-cat-num="2" data-related-id="{{ $cat1->id }}">
										<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {{ trans("$TR.T1") }}
									</a>
        						</li>
		            		</ul>
		            	</li>
		            @endforeach
		        	<li>
						<a class="btn btn-default btn-xs" data-toggle="modal" data-target="#Modal" data-remote="false" data-cat-num="1" data-related-id="0">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {{ trans("$TR.T1") }}
						</a>
					</li>
		        </ul>
			</div>
		</div>
	</div>

	<!-- Default bootstrap modal example -->
	@include('standers.modal')

	<script type="text/javascript">
		$('#tree1').treed();

		$(document).ready(function(){

			$('#tree1').delegate('a[data-toggle="modal"]', 'click', function(e){
				e.preventDefault();

				var _this = $(this);
				var cat_num = _this.attr('data-cat-num');
				var related_id = _this.attr('data-related-id');

				var data = {
		    		table_number: cat_num,
		    		related_id: related_id
		    	};

				window.current_append_btn = _this;

				if(cat_num > 4){
					alert('{{ trans("$TR.T5") }}');
					return false;
				}

				tagModal([
					"Append new item with category <span>"+cat_num+"</span>"
				], "{{ route('admin.products.categories..create') }}", 'GET', data);
			});

			$('.delete-category').click(function(e) {
				if(!confirm('{{ trans("$TR.T6") }}'))
					e.preventDefault();
			});
		});
	</script>
@stop