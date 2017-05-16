@if(session('flashMessage'))
	<div class="alert alert-{{ session('flashMessage')['type'] }}" role="alert">
		<b>{{ session('flashMessage')['content'] }}</b>
	</div>
@endif