<?php
	/* Translation */
	$TR = "admin_panel.ACPS";
?>

@extends('back.master')
@section('title', trans('admin_panel.APT.T10'))

@section('content')
	<div id="admins-view-page">
		@include('includes.back-error')
		@include('includes.flash-message')
		
		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans("$TR.T6") }}
				<a href="{{ route('admin.clients.admins.accounts.create') }}" class="btn btn-default pull-right" {{ $personType == "super_admin" ? "" : "disabled" }}>{{ trans("$TR.T7") }}</a>
			</div>
			<div class="panel-body">
				<div class="container-fluid">
					@if(count($admins) > 0)
						<div id="response-table">
							<table class="table table-condensed table-bordered ps-view">
								<thead>
									<tr>
										<th>{{ trans("$TR.T2") }}</th>
										<th>{{ trans("$TR.T3") }}</th>
										<th>{{ trans("$TR.T4") }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($admins as $admin)
										<tr>
											<td data-title='{{ trans("$TR.T2") }}'>{{ $admin->name }}</td>
											<td data-title='{{ trans("$TR.T3") }}'>{{ $admin->email }}</td>
											<td data-title='{{ trans("$TR.T4") }}'>
												@if($personType == "super_admin")
													<a href="{{ route('admin.clients.admins.accounts.edit', $admin->id) }}" class="btn btn-default btn-sm">{{ trans("$TR.T8") }}</a>
													{!! Form::open(["url"=> route('admin.clients.admins.accounts.destroy', $admin->id), "method"=>"DELETE"]) !!}
														{!! Form::submit('Delete', ['class' => 'btn btn-default btn-sm']) !!}
													{!! Form::close() !!}
												@else 
													-
												@endif
											</td>
										</tr>
									@endforeach				
								</tbody>
							</table>
						</div>
					@else
						<div class="text-center">
							<h3>{{ trans("$TR.T5") }}</h3>	
						</div>
					@endif	
				</div>
			</div>
			<div class="text-center">
				{!! $admins->render() !!}
			</div>
		</div>
	</div>
@stop