<?php
	/* Translation */
	$TR = "admin_panel.ACPS";
?>

@extends('back.master')
@section('title', trans('admin_panel.APT.T9'))

@section('content')
	<div id="users-view-page">
		<div class="panel panel-default">
			<div class="panel-heading">{{ trans("$TR.T1") }}</div>
			<div class="panel-body">
				@if(count($users) > 0)
					<div class="container-fluid">
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
									@foreach($users as $user)
										<tr>
											<td data-title='{{ trans("$TR.T2") }}'>{{ $user->name }}</td>
											<td data-title='{{ trans("$TR.T3") }}'>{{ $user->email }}</td>
											<td data-title='{{ trans("$TR.T4") }}'>
												{!! Form::open(["url"=>"/admin/clients/users/accounts/$user->id", "method"=>"DELETE"]) !!}
													{!! Form::submit('Delete', ['class' => 'btn btn-default btn-sm']) !!}
												{!! Form::close() !!}
											</td>
										</tr>
									@endforeach				
								</tbody>
							</table>
						</div>
					</div>
				@else
					<div class="text-center">
						<h3>{{ trans("$TR.T5") }}</h3>
					</div>
				@endif	
			</div>
			<div class="text-center">
				{!! $users->render() !!}
			</div>	
		</div>
		<?php /*
		<div class="text-right">
			<a href="/admin/users-accounts" class="btn btn-default">Users accounts</a>
			<a href="/admin/admins-accounts" class="btn btn-default">Admins accounts</a>
		</div>
		*/?>	
	</div>
@stop