<h1>Résultat de la recherche</h1>
<div class="row">
	<div class="col-xs-12 col-sm-6">
		<?php if ($links != null) : ?>
			<?php foreach ($links as $item) : ?>
				<?php if (!empty($item["name"]) && !empty($item["link"])) : ?>
				<div class="result">
					<a href="<?= $item["link"] ?>" class="mainlink"><?= $item["name"] ?></a>
					<br/>
					<span class="url"><?= $item["link"] ?></span>
					<?php if (!empty($item["parent_name"]) && !empty($item["parent_link"])) : ?>
						<br/>
						<span>Cette page est une rubrique de la catégorie</span>
						<a href="<?= $item["parent_link"] ?>" class="sublink"><?= $item["parent_name"] ?></a>
					<?php endif ?>
				</div>
				<?php endif ?>
			<?php endforeach ?>
		<?php else : ?>
			<span>Aucun élément ne correspond à votre recherche</span>
		<?php endif ?>
	</div>
</div>