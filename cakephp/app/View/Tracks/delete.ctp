<div class="row-fluid">
	<div class="span12">
		<div class="hero-unit">
			<h1>Not so fast!</h1>
			<p>You're about to permanently remove this track.</p>
			<p>There's no undo. Are you sure you want to continue?</p>
			
			<?php echo $this->Form->create(false, array('type' => 'delete')); ?>
				<fieldset>
					<?php echo $this->Form->input('t_TrackID', array('type' => 'hidden', 'value' => $trackId)); ?>
					<div class="alert alert-error">
						<?php echo $this->TB->input('confirm', array(
							'type' => 'checkbox',
							'label' => false,
							'checkbox_label' => '<b>Yes, permanently delete this track</b>'
						)); ?>
					</div>
					<?php echo $this->TB->button('Delete Track', array('style' => 'danger')); ?>
					<?php echo $this->Html->link('Cancel', $this->request->referer(), array('class' => 'btn')); ?>
				</fieldset>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
