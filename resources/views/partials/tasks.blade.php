@if (session()->has('tasks'))
	<div class="alert alert-dismisable alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<strong>
			{!! session()->get('tasks') !!}
		</strong>
	</div>
@endif