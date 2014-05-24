<h1>Résultat de la recherche</h1>
<?php if ($links != null) : ?>
	<?php foreach ($links as $item) : ?>
		<?php if (!empty($item["name"]) && !empty($item["link"])) : ?>
			<div class="result">
				<a href="<?= $item["link"] ?>" class="mainlink">
					<?= !empty($item["parent_name"]) ? $item["parent_name"]. " - " : "" ?>
					<?= $item["name"] ?>
				</a>
				<br/>
				<a href="<?= $item["link"] ?>"><?= $item["link"] ?></a>
				<?php if (!empty($item["parent_name"]) && !empty($item["parent_link"])) : ?>
					<br/>
					<br/>
					<a href="<?= $item["parent_link"] ?>" class="mainlink">
						Atteindre l'élément parent > 
						<?= $item["parent_name"] ?>
					</a>
					<br/>
					<a href="<?= $item["parent_link"] ?>"><?= $item["parent_link"] ?></a>
				<?php endif ?>
			</div>
		<?php endif ?>
	<?php endforeach ?>
<?php else : ?>
	<span>Aucun élément ne correspond à votre recherche</span>
<?php endif ?>