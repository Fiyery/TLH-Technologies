<div class="content">
	<h1>Résultat de la recherche</h1>
	<?php if ($links != null) : ?>
		<?php foreach ($links as $item) : ?>
			<div class="result">
				<a href="<?= !empty($item["link"]) ? $item["link"] : "#" ?>" class="mainlink">
					<?= !empty($item["parent_name"]) ? $item["parent_name"]. " - " : "" ?>
					<?= !empty($item["name"]) ? $item["name"] : "Nom indisponible" ?>
				</a>
				<br/>
				<a href="<?= !empty($item["link"]) ? $item["link"] : "#" ?>"><?= !empty($item["link"]) ? $item["link"] : "&nbsp;" ?></a>
				<?php if (!empty($item["parent_name"]) && !empty($item["parent_link"])) : ?>
					<br/>
					<span>Atteindre <a href="<?= $item["parent_link"]?>"><?= $item["parent_name"] ?></a></span>
				<?php endif ?>
			</div>
		<?php endforeach ?>
	<?php else : ?>
		<span>Aucun élément ne correspond à votre recherche</span>
	<?php endif ?>
</div>