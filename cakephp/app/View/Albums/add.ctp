<?php $this->Html->script('albums/add.js', array('inline' => false)); ?>

<div class="row-fluid">
	<div class="span12">
		<div class="page-header">
			<h1>Add Album</h1>
		</div>
		<?php echo $this->Form->create('Album', array('type' => 'put', 'class' => 'form-horizontal')); ?>
			<fieldset id="album">
				<div class="row-fluid">
					<div class="span6">
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
					</div>
					<div class="span6">
						<?php echo $this->TB->input('a_AlbumID', array(
							'label' => 'CD Code',
							'type' => 'text',
							'pattern' => '[0-9]*',
							'class' => 'input-large'
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
						<?php echo $this->TB->input('a_AlbumArt', array(
							'label' => 'Album Art URL',
							'type' => 'url',
							'class' => 'input-large',
							'placeholder' => 'http://'
						)); ?>
					</div>
				</div>
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
						<?php foreach ($this->request->data['Tracks'] as $key => $track): ?>
							<tr>
								<td>
									<?php echo $this->TB->input('Tracks.'.$key.'.t_DiskNumber', array(
										'type' => 'text',
										'pattern' => '[0-9]*',
										'label' => false,
										'class' => 'input-mini'
									)); ?>
								</td>
								<td>
									<?php echo $this->TB->input('Tracks.'.$key.'.t_TrackNumber', array(
										'type' => 'text',
										'pattern' => '[0-9]*',
										'label' => false,
										'class' => 'input-mini'
									)); ?>
								</td>
								<td>
									<?php echo $this->TB->input('Tracks.'.$key.'.t_Title', array(
										'label' => false,
										'class' => 'input-xlarge'
									)); ?>
								</td>
								<td class="track-artist">
									<?php echo $this->TB->input('Tracks.'.$key.'.t_Artist', array(
										'label' => false,
										'class' => 'input-xlarge'
									)); ?>
								</td>
								<td>
									<?php echo $this->TB->input('Tracks.'.$key.'.t_Duration', array(
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
