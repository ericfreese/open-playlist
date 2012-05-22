<div class="row-fluid">
	<div class="span2">
		<?php echo $this->Html->image($album['Album']['a_AlbumArt'] ? $album['Album']['a_AlbumArt'] : 'album.png') ?>
		<p><span class="label label-info"><?php echo $album['Genre']['g_Name'] ?></span></p>
		<p>
			<?php if (isset($album['Album']['a_Label']) && $album['Album']['a_Label'] !== ''): ?>
				<span class="label"><?php echo $album['Album']['a_Label'] ?></span>
			<?php endif; ?>
		</p>
	</div>
	<div class="span10">
		<div class="btn-group pull-right">
			<?php echo $this->Html->link('Edit', array('action' => 'edit', $album['Album']['a_AlbumID']), array('class' => 'btn')); ?>
			<?php echo $this->Html->link('Delete', array('action' => 'delete', $album['Album']['a_AlbumID']), array('class' => 'btn btn-danger')); ?>
		</div>
		<h1><?php echo $album['Album']['a_Title'] ?></h1>
		<h2><small><i><?php echo $album['Album']['a_Compilation'] ? 'Various Artists' : $album['Album']['a_Artist'] ?></i></small></h2>
		<?php if (count($album['Tracks']) > 0): ?>
			<table class="table table-condensed">
				<tr>
					<th>Disc</th>
					<th>#</th>
					<th>Name</th>
					<?php if ($album['Album']['a_Compilation']): ?><th>Artist</th><?php endif; ?>
					<th>Duration</th>
					<th></th>
				</tr>
				<?php foreach($album['Tracks'] as $track): ?>
					<tr>
						<td><?php echo $track['t_DiskNumber'] ?></td>
						<td><?php echo $track['t_TrackNumber'] ?></td>
						<td><?php echo $this->Html->link($track['t_Title'], array('controller' => 'tracks', 'action' => 'view', $track['t_TrackID'])); ?></td>
						<?php if ($album['Album']['a_Compilation']): ?><td><?php echo $track['t_Artist'] ?></td><?php endif; ?>
						<td><?php echo floor($track['t_Duration'] / 60).':'.($track['t_Duration'] % 60 < 10 ? '0' : '').($track['t_Duration'] % 60); ?></td>
						<td style="white-space: nowrap">
							<div class="btn-group pull-right">
								<?php echo $this->Html->link($this->TB->icon('pencil'), array('controller' => 'tracks', 'action' => 'edit', $track['t_TrackID']), array('class' => 'btn btn-mini', 'escape' => false))?>
								<?php echo $this->Html->link($this->TB->icon('trash', 'white'), array('controller' => 'tracks', 'action' => 'delete', $track['t_TrackID']), array('class' => 'btn btn-mini btn-danger', 'escape' => false))?>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
		<?php endif; ?>
		<p><?php echo $this->Html->link($this->TB->icon('plus-sign', 'white').' Add Track', array('controller' => 'tracks', 'action' => 'add', $album['Album']['a_AlbumID']), array('class' => 'btn btn-success', 'escape' => false)); ?></p>
	</div>
</div>
