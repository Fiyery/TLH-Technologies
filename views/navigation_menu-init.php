<nav>
	<?php foreach ($list_links as $l) :?>
	
		<div style='font-size:30px'>
			<a href='<?= $l['href'] ?>'>
				<?= $l['name'] ?>
			</a>
		</div>
		
		<?php foreach ($l['list'] as $sl) :?>
		
			<div style='font-size:16px'>
				<a href='<?= $sl['href'] ?>'>
					<?= $sl['name'] ?>
				</a>
			</div>
		
		<?php endforeach; ?>

	<?php endforeach; ?>

</nav>

