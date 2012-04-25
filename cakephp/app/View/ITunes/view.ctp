<div class="row-fluid">
	<div class="span2">
		<?php echo $this->Html->image($album['albumArt'] ? $album['albumArt'] : 'album.png') ?>
		<p><span class="label label-info"><?php echo $album['genre'] ?></span></p>
		<p><?php echo $album['copyright'] ?></p>
	</div>
	<div class="span10">
		<div class="btn-group pull-right">
			<?php echo $this->Html->link($this->TB->icon('download').' Import', array('controller' => 'itunes', 'action' => 'import', $album['id']), array('class' => 'btn', 'escape' => false)); ?>
		</div>
		<h1><?php echo $album['title'] ?></h1>
		<h2><small><i><?php echo $album['artist'] ?></i></small></h2>
		<?php if (count($tracks) > 0): ?>
			<table class="table table-condensed">
				<tr>
					<?php if ($album['discCount'] > 1): ?>
						<th>Disc</th>
					<?php endif; ?>
					<th>#</th>
					<th>Name</th>
					<th>Duration</th>
					<th></th>
				</tr>
				<?php foreach($tracks as $track): ?>
					<tr>
						<?php if ($album['discCount'] > 1): ?>
							<td><?php echo $track['discNumber'] ?></td>
						<?php endif; ?>
						<td><?php echo $track['trackNumber'] ?></td>
						<td><?php echo $track['name']; ?></td>
						<td><?php echo floor($track['duration'] / 60).':'.($track['duration'] % 60 < 10 ? '0' : '').($track['duration'] % 60); ?></td>
						<td style="white-space: nowrap">
							<?php if ($track['previewUrl']): ?>
								<div class="btn-group pull-right">
									<?php echo $this->Html->link($this->TB->icon('play-circle'), $track['previewUrl'], array('class' => 'btn btn-mini', 'escape' => false, 'target' => '_blank'))?>
								</div>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
		<?php endif; ?>
	</div>
</div>
