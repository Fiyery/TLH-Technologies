<ul class="categories">

	<?php foreach ($list_links as $item) :?>
	
		<li class="categorie">
			<a href='<?= $item['href'] ?>'><?= $item['name'] ?></a>
			<div class="onHover">
				<ul class="subcategories">
				
					<?php foreach ($item['list'] as $sous_item) :?>
					
						<li class="subcategorie">
							<a href='<?= $sous_item['href'] ?>'><?= $sous_item['name'] ?></a>
						</li>
					
					<?php endforeach; ?>
					
				</ul>
			</div>
		
		</li>

	<?php endforeach; ?>
	
</ul>