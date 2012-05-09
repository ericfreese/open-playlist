<div class="row-fluid">
	<div class="span12">
		<?php echo $this->Form->create('Album', array('class' => 'form-horizontal')); ?>
			<fieldset>
				<legend>Edit Album</legend>
				<?php echo $this->Form->input('a_AlbumID', array('type' => 'hidden')); ?>
				<?php echo $this->TB->input('a_Title', array(
					'label' => 'Album Title',
					'class' => 'span3'
				)); ?>
				<?php echo $this->TB->input('a_Compilation', array(
					'label' => 'Compilation',
					'checkbox_label' => 'Is this album a compilation of tracks by various artists?'
				)); ?>
				<?php echo $this->TB->input('a_Artist', array(
					'label' => 'Artist',
					'class' => 'span3'
				)); ?>
				<?php echo $this->TB->input('a_GenreID', array(
					'label' => 'Genre',
					'class' => 'span3',
					'empty' => true,
					'options' => $genres
				)); ?>
				<?php echo $this->TB->input('a_Label', array(
					'label' => 'Label',
					'class' => 'span3'
				)); ?>
				<?php echo $this->TB->input('a_DiscCount', array(
					'label' => 'Disc Count',
					'min' => 1,
					'class' => 'span3'
				)); ?>
				<?php echo $this->TB->input('a_AlbumArt', array(
					'label' => 'Album Art URL',
					'class' => 'span3',
					'placeholder' => 'http://'
				)); ?>
				<?php echo $this->TB->input('a_Location', array(
					'label' => 'Location',
					'class' => 'span3',
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
