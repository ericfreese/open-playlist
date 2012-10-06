<div class="row-fluid">
	<div class="span12">
		<div class="page-header">
			<h1>Add Show Instance</h1>
		</div>
		<?php echo $this->Form->create(false, array('type' => 'post', 'class' => 'form-horizontal')); ?>
			<fieldset id="scheduled-show-instance">
				<?php echo $this->Form->input('ScheduledShowInstance.sei_ScheduledEventId', array('type' => 'hidden')); ?>
				<div class="row-fluid">
					<div class="span12">
						<?php echo $this->TB->input('ScheduledShowInstance.sei_StartDateTime', array(
							'label' => 'Start Time (Mountain Time)',
							'type' => 'datetime',
							'class' => 'input-small'
						)); ?>
						<?php echo $this->TB->input('ScheduledShowInstance.sei_Duration', array(
							'label' => 'Duration (min)',
							'type' => 'text',
							'pattern' => '[0-9]*',
							'class' => 'input-small'
						)); ?>
						<?php echo $this->TB->input('ScheduledShowInstance.sei_ShortDescription', array(
							'label' => 'Short Description',
							'type' => 'text'
						)); ?>
						<?php echo $this->TB->input('ScheduledShowInstance.sei_LongDescription', array(
							'label' => 'Long Description',
							'type' => 'textarea'
						)); ?>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div class="form-actions">
					<?php echo $this->TB->button('Save', array('style' => 'primary')); ?>
					<?php echo $this->Html->link('Cancel', $this->request->referer(), array('class' => 'btn')); ?>
				</div>
			</fieldset>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
