<table class="table">
	<?php foreach ($albums as $album): ?>
		<tr>
			<td>
				<p><?php echo $album['Album']['a_AlbumID'] ?></p>
				<p><?php echo $album['Album']['a_Title'] ?></p>
				<p><?php echo $album['keywords'] ?></p>
				<p><img src="<?php echo $album['Album']['a_AlbumArt'] ?>" /></p>
				<p><?php echo $album['Album']['a_AlbumArt'] ?></p>
				<button onclick="$('#album<?php echo $album['Album']['a_AlbumID'] ?>').toggle();">Show</button>
				<div id="album<?php echo $album['Album']['a_AlbumID'] ?>" style="display: none">
					<?php debug($album['Album']); ?>
				</div>
			</td>
			<td><?php echo (isset($album['success']) && $album['success'] ? 'success' : 'fail') ?></td>
			<td>
				<?php if (!isset($album['success']) || !$album['success']): ?>
					<table>
					<?php foreach($album['itResults']['results'] as $itResult): ?>
						<tr>
							<td>
								<p><?php echo $itResult['collectionName'] ?></p>
								<p><img src="<?php echo $itResult['artworkUrl60'] ?>" /></p>
								<p><?php echo $itResult['artworkUrl60'] ?></p>
								<button onclick="$('#itAlbum<?php echo $album['Album']['a_AlbumID'] ?><?php echo $itResult['collectionId'] ?>').toggle();">Show</button>
								<div id="itAlbum<?php echo $album['Album']['a_AlbumID'] ?><?php echo $itResult['collectionId'] ?>" style="display: none">
									<?php debug($itResult); ?>
								</div>
							</td>
						</tr>
					<?php endforeach; ?>
					</table>
				<?php endif; ?>
			</td>
		</tr>
	<?php endforeach; ?>
</table>