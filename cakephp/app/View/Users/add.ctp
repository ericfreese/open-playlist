<div class="row-fluid">
	<div class="span4"></div>
	<div class="span4">
		<div class="row-fluid">
			<div class="span12">
				<?php echo $this->TB->flashes(array('closable' => true)); ?>
			</div>
		</div>
		<?php echo $this->Form->create('User', array('type' => 'post')); ?>
			<fieldset id="user">
				<legend>Add User</legend>
				<div class="row-fluid">
					<div class="span12">
						<?php echo $this->TB->input('Username', array(
							'label' => 'Username',
							'type' => 'text',
							'class' => 'input-block-level'
						)); ?>
						<?php echo $this->TB->input('Password', array(
							'label' => 'Password',
							'type' => 'password',
							'class' => 'input-block-level'
						)); ?>
						<?php echo $this->TB->button('Save', array('style' => 'primary')); ?>
					</div>
				</div>
			</fieldset>
		<?php echo $this->Form->end(); ?>
	</div>
</div>