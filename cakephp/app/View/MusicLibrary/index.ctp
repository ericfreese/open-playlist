<?php $pageParams = $this->Paginator->params('Album'); ?>

<div class="row-fluid">
	<div class="span2">
		<div class="well">
			<div class="btn-group">
				<a class="btn btn-success dropdown-toggle input-block-level" data-toggle="dropdown" href="#"><i class="icon-plus icon-white"></i> Add Music <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><?php echo $this->Html->link('Import From iTunes', array('controller' => 'i_tunes', 'action' => 'search')); ?></li>
					<li><?php echo $this->Html->link('Add Manually', array('controller' => 'albums', 'action' => 'add')); ?></li>
				</ul>
			</div>
		</div>
		<!--<div class="well sidebar-nav">-->
			<!--<ul class="nav nav-list">
				<li class="nav-header">Saved Filters</li>
				<li><?php echo $this->Html->link('Music Library', array('controller' => 'music_library', 'action' => 'index')); ?></li>
			</ul>-->
			<!--
			<?php echo $this->Form->create(false, array('type' => 'get')); ?>
				<fieldset>
					<?php echo $this->TB->input('filter', array(
						'label' => false,
						'type' => 'text',
						'class' => 'input-block-level',
						'placeholder' => 'Filter'
					)); ?>
					<?php echo $this->TB->input('genre', array(
						'label' => false,
						'class' => 'input-block-level',
						'options' => $genres,
						'multiple' => true,
						'empty' => true,
						'style' => 'height: 200px'
					)); ?>
				</fieldset>
				<div class="form-actions">
					<?php echo $this->TB->button('Filter'); ?>
				</div>
			<?php echo $this->Form->end(); ?>
			-->
		<!--</div>-->
	</div>
	<div class="span10">
		<div class="row-fluid">
			<div class="span4">
				<!--
				<form class="form-inline" style="margin: 0">
					<div class="input-append">
						<input type="text" class="input-xlarge"><button class="btn"><i class="icon-search"></i></button>
					</div>
				</form>
				-->
			</div>
			<div class="span5"></div>
			<div class="span3">
				<div class="btn-toolbar pull-right" style="margin: 0">
					<div class="btn-group">
						<?php echo $this->Paginator->link('<i class="icon-chevron-left"></i>', array('page' => ($pageParams['prevPage'] ? $pageParams['page'] - 1 : $pageParams['page'])), array('escape' => false, 'class' => 'btn'.($pageParams['prevPage'] ? '' : ' disabled'))); ?>
						<?php echo $this->Paginator->link('<i class="icon-chevron-right"></i>', array('page' => ($pageParams['nextPage'] ? $pageParams['page'] + 1 : $pageParams['pageCount'])), array('escape' => false, 'class' => 'btn'.($pageParams['nextPage'] ? '' : ' disabled'))); ?>
					</div>
				</div>
				<div style="text-align: right; line-height: 2.3em; margin-right: 80px">
					<?php echo $this->Paginator->counter('<b>{:start}</b>-<b>{:end}</b> of <b>'.($pageParams['count'] > 2000 ? 'thousands' : '{:count}').'</b>'); ?>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<table class="table table-condensed">
					<thead>
						<tr>
							<th></th>
							<th>Album</th>
							<th>Artist</th>
							<th>Genre</th>
							<th>Added</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($albums as $album): ?>
							<tr>
								<td><?php echo $this->Html->image($album['Album']['a_AlbumArt'] ? $album['Album']['a_AlbumArt'] : 'album.png', array('class' => 'album-art')); ?></td>
								<td><?php echo $this->Html->link($album['Album']['a_Title'], array('controller' => 'albums', 'action' => 'view', $album['Album']['a_AlbumID'])); ?></td>
								<td><?php echo ($album['Album']['a_Compilation'] ? 'Various Artists' : $album['Album']['a_Artist']); ?></td>
								<td><?php if (isset($album['Genre']['g_Name'])): ?><span class="label label-info"><?php echo ($album['Genre']['g_Name']); ?></span><?php endif; ?></td>
								<td><?php echo $this->Time->format('n/j/Y', $album['Album']['a_AddDate']); ?></td>
								<td style="white-space: nowrap">
									<div class="btn-group pull-right">
										<?php echo $this->Html->link($this->TB->icon('pencil'), array('controller' => 'albums', 'action' => 'edit', $album['Album']['a_AlbumID']), array('class' => 'btn btn-mini', 'escape' => false)); ?>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span9"></div>
			<div class="span3">
				<div class="btn-toolbar pull-right" style="margin: 0">
					<div class="btn-group">
						<?php echo $this->Paginator->link('<i class="icon-chevron-left"></i>', array('page' => ($pageParams['prevPage'] ? $pageParams['page'] - 1 : $pageParams['page'])), array('escape' => false, 'class' => 'btn'.($pageParams['prevPage'] ? '' : ' disabled'))); ?>
						<?php echo $this->Paginator->link('<i class="icon-chevron-right"></i>', array('page' => ($pageParams['nextPage'] ? $pageParams['page'] + 1 : $pageParams['pageCount'])), array('escape' => false, 'class' => 'btn'.($pageParams['nextPage'] ? '' : ' disabled'))); ?>
					</div>
				</div>
				<div style="text-align: right; line-height: 2.3em; margin-right: 80px">
					<?php echo $this->Paginator->counter('<b>{:start}</b>-<b>{:end}</b> of <b>'.($pageParams['count'] > 2000 ? 'thousands' : '{:count}').'</b>'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
