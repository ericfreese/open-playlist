<div class="row-fluid">
	<div class="span12">
		<?php echo $this->Form->create(false, array('class' => 'form-search', 'type' => 'get')); ?>
			<fieldset>
				<legend>iTunes Search</legend>
				<?php echo $this->TB->basic_input('q', array(
					'type' => 'search',
					'class' => 'search-query input-xlarge',
					'label' => false,
					'value' => isset($this->params->query['q']) ? $this->params->query['q'] : ''
				)); ?>
				<?php echo $this->TB->button('Search', array('style' => 'primary')); ?>
			</fieldset>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
<?php if (isset($response)): ?>
	<div class="row-fluid">
		<div class="span12">
			<p class="lead"><?php echo count($response['results']) > 0 ? count($response['results']) : 'No' ?> result<?php if (count($response['results']) !== 1): ?>s<?php endif; ?> for <strong><?php echo $this->params->query['q']; ?></strong></p>
		</div>
		<?php if (count($response['results']) > 0): ?>
			<div class="row-fluid">
				<?php foreach ($response['results'] as $i => $album): ?>
					<div class="span4">
						<div class="row-fluid" style="margin-top: 10px">
							<div class="span3">
								<?php echo $this->Html->image($album['artworkUrl100'], array('style' => 'width: 100%')); ?>
							</div>
							<div class="span9">
								<div class="row-fluid"><div class="span12"><?php echo $this->Html->link($album['collectionName'], array('controller' => 'itunes', 'action' => 'view', $album['collectionId'])) ?></div></div>
								<div class="row-fluid"><div class="span12"><i><?php echo $album['artistName'] ?></i></div></div>
								<div class="row-fluid"><div class="span12"><i><?php echo $album['trackCount'].' track'.($album['trackCount'] > 1 ? 's' : '') ?></i></div></div>
								<div class="btn-group">
									<?php echo $this->Html->link($this->TB->icon('download').' Import', array('controller' => 'itunes', 'action' => 'import', $album['collectionId']), array('class' => 'btn btn-mini', 'escape' => false)); ?>
								</div>
							</div>
						</div>
					
						<?php //echo $this->element('album_tile', array(
							// 'albumArtUrl' => $album['artworkUrl60'],
							// 'albumTitle' => $album['collectionName'],
							// 'albumUrl' => array('controller' => 'itunes', 'action' => 'album', $album['collectionId']),
							// 'artistTitle' => $album['artistName'],
							// 'numTracks' => $album['trackCount']
						//)) ?>
					</div>
					<?php if (($i + 1) % 3 === 0): ?>
						</div><div class="row-fluid">
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<p style="margin-top: 20px">Can't find what you're looking for?</p>
			<?php echo $this->Html->link('Add an Album Manually &raquo;', array('controller' => 'albums', 'action' => 'add'), array('class' => 'btn btn-success', 'escape' => false))?>
		</div>
	</div>
<?php endif; ?>
