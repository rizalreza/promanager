<?php if(session()->has('success')): ?>
	<div class="alert alert-dismisable alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<strong>
			<?php echo session()->get('success'); ?>

		</strong>
	</div>
<?php endif; ?>