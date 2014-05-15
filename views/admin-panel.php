<div class="content">
	<a href='<?= $root_www ?>admin/deconnection/'>Deconnection</a>
	<h1>Panel d'administration</h1>
	
	<?php foreach ($menus as $item) :?>
	
		<div class="fixedColumnWrapper outer">
			<div class="fixedColumnWrapper inner">
				<table class="fixedColumn">
					<thead>
						<tr>
							<th><span><?= $item->name ?></span></th>
							<th><span><?= $item->date_creation ?></span></th>
							<th><span><?= $item->date_modification ?></span></th>
							<th class="fixed">
								<a href='<?= $root_www ?>admin/nouveau_sous_menu/' class="icon small plus_full">&nbsp;</a>
								<a href='<?= $root_www ?>admin/item_enable/?id=<?= $item->id ?>' class="icon small large eye_off">&nbsp;</a>
								<a href='<?= $root_www ?>admin/item_disable/?id=<?= $item->id ?>' class="icon small large eye_on">&nbsp;</a>
								<a href='<?= $root_www ?>admin/item_edit/?id=<?= $item->id ?>' class="icon small large edit">&nbsp;</a>
							</th>
					</thead>
					<tbody>
						<?php foreach ($sous_menus as $sous_item) :?>
						
							<?php if ($sous_item->id_menu == $item->id) :?>
							
								<tr>
									<td><span><?= $sous_item->name ?></span></td>
									<td><span><?= $sous_item->date_creation ?></span></td>
									<td><span><?= $sous_item->date_modification ?></span></td>
									<td class="fixed">
										<a href='<?= $root_www ?>admin/sous_item_enable/?id=<?= $sous_item->id ?>' class="icon small large eye_off">&nbsp;</a>
										<a href='<?= $root_www ?>admin/sous_item_disable/?id=<?= $sous_item->id ?>' class="icon small large eye_on">&nbsp;</a>
										<a href='<?= $root_www ?>admin/sous_item_edit/?id=<?= $sous_item->id ?>' class="icon small large edit">&nbsp;</a>
									</td>
								</tr>
							<?php endif; ?>
							
						<?php endforeach; ?>
						
					</tbody>
				</table>
			</div>
		</div>

	<?php endforeach; ?>
</div>