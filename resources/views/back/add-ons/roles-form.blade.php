<div id="admins-roles-form">
	@foreach($roles as $role)
		<div class="checkbox">
			<label>
				{!! Form::hidden($role."_ROLE", 0) !!}
				{!! Form::checkbox($role."_ROLE", 1, isset($admin_roles) ? in_array($role, $admin_roles) ? "checked" : null : null, ["class"=>"checkbox"]) !!}
				<b>{{ str_replace('_', ' ', $role) }}?</b>
			</label>
		</div>
	@endforeach
</div>