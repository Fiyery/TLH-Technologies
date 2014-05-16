<div class="content">
	<div class="absTopRight">
		<a href='<?= $root_www ?>admin/deconnection/' class="mainlink icon small logout">Déconnection</a>
	</div>
	
	<h1>Panel d'administration</h1>
	
	<div class="fixedColumnWrapper outer">
		<div class="fixedColumnWrapper inner">
			<table class="fixedColumn">
				<thead>
					<tr>
						<th><span>Nom du menu / sous-menu</span></th>
						<th><span>Date de création</span></th>
						<th><span>Date de modification</span></th>
						<th class="fixed">
							<a href='<?= $root_www ?>admin/edit/?type=menu' class="icon small plus_full">&nbsp;</a>
						</th>
					</tr>
				</thead>
				<tbody>
				
					<?php foreach ($menus as $item) :?>
						<tr class="menu">
							<th><span><?= $item->name ?></span></th>
							<th><span><?= $item->date_creation ?></span></th>
							<th><span><?= $item->date_modification ?></span></th>
							<th class="fixed">
								<a href='<?= $root_www ?>admin/edit/?type=sous_menu&menu_id=<?= $item->id ?>' class="icon small plus_full">&nbsp;</a>
								
								<?php if ($item->enable) : ?>
								
									<a href='<?= $root_www ?>admin/disable/?type=menu&id=<?= $item->id ?>' class="icon small large eye_on">&nbsp;</a>
								
								<?php else : ?>
								
									<a href='<?= $root_www ?>admin/enable/?type=menu&id=<?= $item->id ?>' class="icon small large eye_off">&nbsp;</a>
								
								<?php endif; ?>
								
								<a href='<?= $root_www ?>admin/edit/?type=menu&id=<?= $item->id ?>' class="icon small large edit">&nbsp;</a>
							</th>
						</tr>
						
						<?php foreach ($sous_menus as $sous_item) :?>
						
							<?php if ($sous_item->id_menu == $item->id) :?>
							
								<tr class="sous_menu">
									<td><span><?= $sous_item->name ?></span></td>
									<td><span><?= $sous_item->date_creation ?></span></td>
									<td><span><?= $sous_item->date_modification ?></span></td>
									<td class="fixed">
								
										<?php if ($sous_item->enable) : ?>
									
											<a href='<?= $root_www ?>admin/disable/?type=sous_menu&id=<?= $sous_item->id ?>' class="icon small large eye_on">&nbsp;</a>
									
										<?php else : ?>
									
											<a href='<?= $root_www ?>admin/enable/?type=sous_menu&id=<?= $sous_item->id ?>' class="icon small large eye_off">&nbsp;</a>
									
										<?php endif; ?>
								
										<a href='<?= $root_www ?>admin/edit/?type=sous_menu&id=<?= $sous_item->id ?>' class="icon small large edit">&nbsp;</a>
									</td>
								</tr>
							<?php endif; ?>
							
						<?php endforeach; ?>
						
						
					<?php endforeach; ?>
					
				</tbody>
			</table>
		</div>
	</div>
</div>