<div class="row-fluid">
	<div class="span12">
		<?php echo $this->Form->create('Album', array('type' => 'put', 'class' => 'form-horizontal')); ?>
			<fieldset>
				<legend>Edit Album</legend>
				<?php echo $this->Form->input('a_AlbumID', array('type' => 'hidden')); ?>
				<?php echo $this->TB->input('a_CDCode', array(
					'label' => 'CD Code',
					'type' => 'text',
					'pattern' => '[0-9]*',
					'class' => 'input-large'
				)); ?>
				<?php echo $this->TB->input('a_Title', array(
					'label' => 'Album Title',
					'class' => 'input-large'
				)); ?>
				<?php echo $this->TB->input('a_Compilation', array(
					'label' => 'Compilation',
					'checkbox_label' => 'Is this album a compilation of tracks by various artists?'
				)); ?>
				<?php echo $this->TB->input('a_Artist', array(
					'label' => 'Artist',
					'class' => 'input-large'
				)); ?>
				<?php echo $this->TB->input('a_GenreID', array(
					'label' => 'Genre',
					'empty' => true,
					'options' => $genres
				)); ?>
				<?php echo $this->TB->input('a_Label', array(
					'label' => 'Label',
					'class' => 'input-large'
				)); ?>
				<?php echo $this->TB->input('a_DiscCount', array(
					'label' => 'Disc Count',
					'type' => 'text',
					'pattern' => '[0-9]*',
					'class' => 'input-large'
				)); ?>
				<?php echo $this->TB->input('a_AlbumArt', array(
					'label' => 'Album Art URL',
					'class' => 'input-large',
					'placeholder' => 'http://'
				)); ?>
				<?php echo $this->TB->input('a_Location', array(
					'label' => 'Location',
					'options' => array(
						'Gnu Bin' => 'Gnu Bin',
						'Personal' => 'Personal',
						'Library' => 'Library',
						'Digital Library' => 'Digital Library'
					)
				)); ?>
				<?php echo $this->Form->hidden('a_ITunesId'); ?>
				<div class="form-actions">
					<?php echo $this->TB->button('Save Album', array('style' => 'primary')); ?>
					<?php echo $this->Html->link('Cancel', $this->request->referer(), array('class' => 'btn')); ?>
				</div>
			</fieldset>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
