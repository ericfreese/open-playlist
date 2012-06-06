<?php $this->Html->script('albums/add.js', array('inline' => false)); ?>

<div class="row-fluid">
	<div class="span12">
		<div class="page-header">
			<h1>Edit Album</h1>
		</div>
		<?php echo $this->Form->create('Album', array('type' => 'put', 'class' => 'form-horizontal')); ?>
			<fieldset>
				<?php echo $this->Form->input('a_AlbumID', array('type' => 'hidden')); ?>
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
					'empty' => true,
					'options' => $genres
				)); ?>
				<?php echo $this->TB->input('a_Label', array(
					'label' => 'Label',
					'type' => 'text',
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
			</fieldset>
			<fieldset id="tracks">
				<table class="table table-condensed">
					<thead>
						<tr>
							<th>Disc</th>
							<th>#</th>
							<th>Track Name</th>
							<th class="track-artist">Artist</th>
							<th>Duration (seconds)</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($this->request->data['Track'] as $key => $track): ?>
							<tr<?php if (isset($trackValidationErrors[$key])) echo ' class="error"' ?>>
								<td>
									<?php echo $this->Form->input('Track.'.$key.'.t_TrackID', array('type' => 'hidden')); ?>
									<?php echo $this->TB->basic_input('Track.'.$key.'.t_DiskNumber', array(
										'type' => 'text',
										'pattern' => '[0-9]*',
										'label' => false,
										'class' => 'input-mini'
									)); ?>
								</td>
								<td>
									<?php echo $this->TB->basic_input('Track.'.$key.'.t_TrackNumber', array(
										'type' => 'text',
										'pattern' => '[0-9]*',
										'label' => false,
										'class' => 'input-mini'
									)); ?>
								</td>
								<td>
									<?php echo $this->TB->basic_input('Track.'.$key.'.t_Title', array(
										'label' => false,
										'class' => 'input-xlarge'
									)); ?>
								</td>
								<td class="track-artist">
									<?php echo $this->TB->basic_input('Track.'.$key.'.t_Artist', array(
										'label' => false,
										'class' => 'input-xlarge'
									)); ?>
								</td>
								<td>
									<?php echo $this->TB->basic_input('Track.'.$key.'.t_Duration', array(
										'type' => 'text',
										'pattern' => '[0-9]*',
										'label' => false,
										'class' => 'input-mini'
									)); ?>
								</td>
								<td>
									<a class="close" href="#" title="Remove track">&times;</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<div>
					<a href="#" class="btn add-track"><i class="icon-plus"></i> Add Track</a>
				</div>
			</fieldset>
			<fieldset>
				<div class="form-actions">
					<?php echo $this->TB->button('Save Album', array('style' => 'primary')); ?>
					<?php echo $this->Html->link('Cancel', $this->request->referer(), array('class' => 'btn')); ?>
				</div>
			</fieldset>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
