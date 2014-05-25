<div id="HeaderRow" class="jumbotron">
	<div class="container">
		<div class="row">
			<div class="col-xs-2">
				<a class="mainlink icon home" href='<?= $root_www ?>'><?= $static_menus[0]->name ?></a>
			</div>
			<div class="col-xs-2">
				<a class="mainlink icon contact" href='<?= $root_www ?>contact/'>Contacter</a>
			</div>
			<div class="col-xs-2">
				<a class="mainlink icon help" href='<?= $root_www ?>aide/'><?= $static_menus[1]->name ?></a>
			</div>
			<div class="col-xs-2">
				<a class="mainlink icon plus unfold small" href='<?= $root_www ?>plus/'><?= $static_menus[2]->name ?></a>
				<div class="onHover">
					<?= $list_menu_links ?>
				</div>
			</div>
			<div class="col-xs-4">
				<div id="SearchBox">
					<input class="data" type="text"/>
					<input class="hide" type="text" disabled="disabled" value="<?= $root_www ?>recherche/"/>
					<div class="icon search"></div>
					<a href="<?= $root_www ?>recherche/">&nbsp;</a>
				</div>
			</div>
		</div>
	</div>
</div>