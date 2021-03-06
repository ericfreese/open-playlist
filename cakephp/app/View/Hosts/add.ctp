<div class="row-fluid">
	<div class="span12">
		<div class="page-header">
			<h1>Add Host</h1>
		</div>
		<?php echo $this->Form->create('Host', array('type' => 'post', 'class' => 'form-horizontal')); ?>
			<fieldset id="show">
				<div class="row-fluid">
					<div class="span12">
						<?php echo $this->TB->input('Name', array(
							'label' => 'Name',
							'type' => 'text',
							'class' => 'input-large'
						)); ?>
						<?php echo $this->TB->input('Internal', array(
							'label' => 'Internal',
							'type' => 'checkbox',
							'checkbox_label' => 'Is this an internal host?'
						)); ?>
						<?php echo $this->TB->input('Active', array(
							'label' => 'Active',
							'type' => 'checkbox',
							'checkbox_label' => 'Is the host active?'
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
