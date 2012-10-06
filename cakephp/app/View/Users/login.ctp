<div class="row-fluid">
	<div class="span4"></div>
	<div class="span4">
		<div class="row-fluid">
			<div class="span12">
				<?php echo $this->TB->flashes(array('closable' => true)); ?>
			</div>
		</div>
		<?php echo $this->Form->create('User', array('type' => 'post')); ?>
			<fieldset id="login">
				<legend>Log In</legend>
				<div class="row-fluid">
					<div class="span12">
						<?php echo $this->TB->input('username', array(
							'label' => 'Username',
							'type' => 'text',
							'class' => 'input-block-level'
						)); ?>
						<?php echo $this->TB->input('password', array(
							'label' => 'Password',
							'type' => 'password',
							'class' => 'input-block-level'
						)); ?>
						<?php echo $this->TB->button('Log In', array('style' => 'primary')); ?> or <?php echo $this->Html->link('Register', array('controller' => 'users', 'action' => 'add')); ?>
					</div>
				</div>
			</fieldset>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
