<div class="row-fluid">
	<div class="span12">
		<?php echo $this->Form->create('Album', array('type' => 'put', 'class' => 'form-horizontal')); ?>
			<fieldset>
				<legend>Add Album</legend>
				<?php echo $this->TB->input('a_AlbumID', array(
					'label' => 'CD Code',
					'type' => 'number',
					'class' => 'span3'
				)); ?>
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
			</fieldset>
			<?php if (isset($this->request->data['Tracks'])): ?>
				<?php for ($i = 0; $i < count($this->request->data['Tracks']); $i++): ?>
					<fieldset>
						<legend>Track</legend>
						<?php echo $this->TB->input('Tracks.'.$i.'.t_DiskNumber', array(
							'type' => 'number',
							'min' => 1,
							'label' => 'Disc',
							'class' => 'span3'
						)); ?>
						<?php echo $this->TB->input('Tracks.'.$i.'.t_TrackNumber', array(
							'type' => 'number',
							'min' => 1,
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
						<?php echo $this->Form->hidden('Tracks.'.$i.'.t_ITunesPreviewUrl'); ?>
					</fieldset>
				<?php endfor; ?>
			<?php endif; ?>
			<fieldset>
				<div class="form-actions">
					<?php echo $this->TB->button('Save Album', array('style' => 'primary')); ?>
				</div>
			</fieldset>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
