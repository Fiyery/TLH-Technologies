<ul class="categories">

	<?php foreach ($list_links as $item) :?>
	
		<li class="categorie">
			<a href='<?= $item['href'] ?>'><?= $item['name'] ?></a>
			
			<?php if (isset($item['list']) && count($item['list']) > 0) : ?>
			
			<div class="onHover">
				<ul class="subcategories">
				
					<?php foreach ($item['list'] as $sous_item) :?>
					
						<li class="subcategorie">
							<a href='<?= $sous_item['href'] ?>'><?= $sous_item['name'] ?></a>
						</li>
					
					<?php endforeach; ?>
					
				</ul>
			</div>
			
			<?php endif ?>
		
		</li>

	<?php endforeach; ?>
	
</ul>