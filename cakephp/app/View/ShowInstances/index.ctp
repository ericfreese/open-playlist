<?php debug($showInstances); ?>
<?php if (false): ?>
<div class="row-fluid">
	<div class="span12">
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>Show</th>
					<th>Time</th>
					<th>Duration</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($showInstances as $showInstance): ?>
					<tr>
						<td><?php echo $this->Html->link($showInstance['Host']['Name'], array('controller' => 'showInstances', 'action' => 'view', $showInstance['Host']['UID'])) ?></td>
						<td><?php echo $showInstance['Host']['Active'] ?></td>
						<td><?php echo $showInstance['Host']['Internal'] ?></td>
						<td style="white-space: nowrap">
							<div class="btn-group pull-right">
								<?php echo $this->Html->link($this->TB->icon('pencil'), array('controller' => 'showInstances', 'action' => 'edit', $showInstance['Host']['UID']), array('class' => 'btn btn-mini', 'escape' => false)); ?>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php echo $this->Html->link('<i class="icon-plus"></i> Add Host', array('action' => 'add'), array('class' => 'btn', 'escape' => false)); ?>
	</div>
</div>

<?php endif; ?>