<div class="row-fluid">
	<div class="span12">
		<div class="page-header">
			<h1>Add Album</h1>
		</div>
		<?php echo $this->Form->create('Album', array('type' => 'put', 'class' => 'form-horizontal')); ?>
			<fieldset>
				<?php echo $this->TB->input('a_AlbumID', array(
					'label' => 'CD Code',
					'type' => 'text',
					'pattern' => '[0-9]*',
					'class' => 'input-large'
				)); ?>
				<?php echo $this->TB->input('a_Title', array(
					'label' => 'Album Title',
					'type' => 'text',
					'class' => 'input-large'
				)); ?>
				<?php echo $this->TB->input('a_Compilation', array(
					'label' => 'Compilation',
					'checkbox_label' => 'Is this album a compilation of tracks by various artists?'
				)); ?>
				<?php echo $this->TB->input('a_Artist', array(
					'label' => 'Artist',
					'type' => 'text',
					'class' => 'input-large'
				)); ?>
				<?php echo $this->TB->input('a_GenreID', array(
					'label' => 'Genre',
					'help_inline' => (isset($iTunesGenre) ? '<i style="cursor: pointer;" class="icon-info-sign" onclick="alert(\'iTunes lists the genre as: \n\n'.str_replace('\'', '\\\'', $iTunesGenre).'\');"></i>' : false),
					'empty' => true,
					'options' => $genres
				)); ?>
				<?php echo $this->TB->input('a_Label', array(
					'label' => 'Label',
					'type' => 'text',
					'help_inline' => (isset($iTunesCopyright) ? '<i style="cursor: pointer;" class="icon-info-sign" onclick="alert(\'iTunes lists the copyright info as: \n\n'.str_replace('\'', '\\\'', $iTunesCopyright).'\');"></i>' : false),
					'class' => 'input-large'
				)); ?>
				<?php echo $this->TB->input('a_AlbumArt', array(
					'label' => 'Album Art URL',
					'type' => 'url',
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
			</fieldset>
			<?php if (isset($this->request->data['Tracks'])): ?>
				<?php for ($i = 0; $i < count($this->request->data['Tracks']); $i++): ?>
					<fieldset>
						<legend>Track</legend>
						<?php echo $this->TB->input('Tracks.'.$i.'.t_DiskNumber', array(
							'type' => 'text',
							'pattern' => '[0-9]*',
							'label' => 'Disc',
							'class' => 'input-large'
						)); ?>
						<?php echo $this->TB->input('Tracks.'.$i.'.t_TrackNumber', array(
							'type' => 'text',
							'pattern' => '[0-9]*',
							'label' => '#',
							'class' => 'input-large'
						)); ?>
						<?php echo $this->TB->input('Tracks.'.$i.'.t_Title', array(
							'label' => 'Track Name',
							'class' => 'input-large'
						)); ?>
						<?php echo $this->TB->input('Tracks.'.$i.'.t_Artist', array(
							'label' => 'Artist',
							'class' => 'input-large'
						)); ?>
						<?php echo $this->TB->input('Tracks.'.$i.'.t_Duration', array(
							'type' => 'text',
							'pattern' => '[0-9]*',
							'label' => 'Duration (seconds)',
							'class' => 'input-large'
						)); ?>
					</fieldset>
				<?php endfor; ?>
			<?php endif; ?>
			<fieldset>
				<div class="form-actions">
					<?php echo $this->TB->button('Save Album', array('style' => 'primary')); ?>
					<?php echo $this->Html->link('Cancel', $this->request->referer(), array('class' => 'btn')); ?>
				</div>
			</fieldset>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
