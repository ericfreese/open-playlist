<div class="row-fluid">
	<div class="span12">
		<?php echo $this->Form->create('Track', array('class' => 'form-horizontal')); ?>
			<fieldset>
				<legend>Edit Track on <i><?php echo $this->Html->link($album['Album']['a_Title'], array('controller' => 'albums', 'action' => 'view', $track['Track']['t_AlbumID'])) ?></i></legend>
				<?php echo $this->Form->input('t_TrackID', array('type' => 'hidden')); ?>
				<?php echo $this->TB->input('t_DiskNumber', array(
					'type' => 'number',
					'label' => 'Disc',
					'class' => 'span3'
				)); ?>
				<?php echo $this->TB->input('t_TrackNumber', array(
					'type' => 'number',
					'label' => '#',
					'class' => 'span3'
				)); ?>
				<?php echo $this->TB->input('t_Title', array(
					'label' => 'Track Name',
					'class' => 'span3'
				)); ?>
				<?php echo $this->TB->input('t_Artist', array(
					'label' => 'Artist',
					'class' => 'span3'
				)); ?>
				<?php echo $this->TB->input('t_Duration', array(
					// 'type' => 'text',
					'label' => 'Duration (seconds)',
					'class' => 'span3'
				)); ?>
				<div class="form-actions">
					<?php echo $this->TB->button('Save Track', array('style' => 'primary')); ?>
				</div>
			</fieldset>
		<?php echo $this->Form->end(); ?>
	</div>
</div>

