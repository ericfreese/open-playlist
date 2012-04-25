<div class="row-fluid">
	<div class="span12">
		<?php echo $this->Form->create('Album', array('class' => 'form-horizontal')); ?>
			<fieldset>
				<legend>Add Album</legend>
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
			</fieldset>
			<?php for ($i = 0; $i <= 5; $i++): ?>
				<fieldset>
					<legend>Track</legend>
					<?php echo $this->TB->input('Tracks.'.$i.'.t_DiskNumber', array(
						'type' => 'number',
						'label' => 'Disc',
						'class' => 'span3'
					)); ?>
					<?php echo $this->TB->input('Tracks.'.$i.'.t_TrackNumber', array(
						'type' => 'number',
						'label' => '#',
						'class' => 'span3'
					)); ?>
					<?php echo $this->TB->input('Tracks.'.$i.'.t_Title', array(
						'label' => 'Track Name',
						'class' => 'span3'
					)); ?>
					<?php echo $this->TB->input('Tracks.'.$i.'.t_Artist', array(
						'label' => 'Artist',
						'class' => 'span3'
					)); ?>
					<?php echo $this->TB->input('Tracks.'.$i.'.t_Duration', array(
						// 'type' => 'text',
						'label' => 'Duration (seconds)',
						'class' => 'span3'
					)); ?>
				</fieldset>
			<?php endfor; ?>
			<fieldset>
				<div class="form-actions">
					<?php echo $this->Html->link('Add Track', '#', array('class' => 'btn btn-success'))?>
					<?php echo $this->TB->button('Save Album', array('style' => 'primary')); ?>
				</div>
			</fieldset>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
