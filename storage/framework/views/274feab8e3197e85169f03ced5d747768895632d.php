<?php if(session()->has('comments')): ?>
	<div class="alert alert-dismisable alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<strong>
			<?php echo session()->get('comments'); ?>

		</strong>
	</div>
<?php endif; ?>