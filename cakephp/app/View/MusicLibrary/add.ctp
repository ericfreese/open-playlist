<div class="page-header">
	<h1>Add Music to Library</h1>
</div>
<div class="tabbable">
	<ul class="nav nav-tabs">
		<li<?php if ($from === 'itunes'): ?> class="active"<?php endif; ?>><?php echo $this->Html->link('From iTunes', array('controller' => 'musiclibrary', 'action' => 'add', 'itunes')); ?></li>
		<li<?php if ($from === 'manually'): ?> class="active"<?php endif; ?>><?php echo $this->Html->link('Manually', array('controller' => 'musiclibrary', 'action' => 'add', 'manually')); ?></li>
	</ul>
	<div class="tab-content">
		<?php if ($from === 'itunes'): ?>
			<div class="row-fluid">
				<div class="span4">
					<form class="form-search">
						<h2>Search iTunes</h2>
						<input type="search" class="search-query">
						<button type="submit" class="btn btn-primary"><i class="icon-search icon-white"></i> Search</button>
					</form>
				</div>
				<div class="span8">
					<h2>Results for <i>The Beatles</i></h2>
				</div>
			</div>
		<?php elseif ($from === 'manually'): ?>
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
								'options' => $genres
							)); ?>
							<?php echo $this->TB->input('a_Label', array(
								'label' => 'Label',
								'class' => 'span3',
								'help_block' => 'Which label was this album published by?'
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
									'Gnu Bin',
									'Personal',
									'Library',
									'Digital Library'
								)
							)); ?>
							<div class="form-actions">
								<?php echo $this->TB->button('Save Album', array('style' => 'primary')); ?>
							</div>
						</fieldset>
					<?php echo $this->Form->end(); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
