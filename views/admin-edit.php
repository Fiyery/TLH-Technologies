<form action="<?= $root_www ?>admin/update/" method="post">
	<input name="id" value="<?=(isset($data) && is_numeric($data->id)) ? $data->id : -1 ?>" readonly="readonly" type="hidden"/>
	<input name="type" value="<?= $type ?>" readonly="readonly" type="hidden"/>
	<div class="content">
		<div class="absTopRight">
			<a href='<?= $root_www ?>admin/panel/' class="mainlink icon small back">Retour au panel</a>
			<a href='<?= $root_www ?>admin/deconnection/' class="mainlink icon small logout">Déconnection</a>
		</div>
		
		<h1>Propriétés du menu</h1>
		
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-lg-4">
				<div class="row">
					<div class="col-xs-4 lbl"><span>Nom<span></div>
					<div class="col-xs-6 col-sm-8"><input name="name" value="<?= ((isset($data)) ? $data->name : "") ?>" type="text"/></div>
				</div>
			</div>
			<?php if ($type == 'menu' || $type == 'sous_menu'): ?>
				<div class="col-xs-12 col-sm-6 col-lg-4">
					<div class="row">
						<div class="col-xs-4 lbl"><span>Visible<span></div>
						<div class="col-xs-6 col-sm-8">
							<select name="enable">
								<option value="1"<?=(!isset($data) || (isset($data) && $data->enable == 1)) ? " selected='selected'" : "" ?>>Oui</option>
								<option value="0"<?=(isset($data) && $data->enable == 0) ? " selected='selected'" : "" ?>>Non</option>
							</select>
						</div>
					</div>
				</div>
			<?php endif; ?>
			
			<?php if (isset($menus)) : ?>
			
				<div class="col-xs-12 col-sm-6 col-lg-4">
					<div class="row">
						<div class="col-xs-4 lbl"><span>Parent<span></div>
						<div class="col-xs-6 col-sm-8">
							<select name="id_menu">
								<?php
								$found = false;
								foreach ($menus as $item) {
									$selected = false;
									if (isset($data) && $data->id_menu == $item->id)
									{
										$selected = true;
										$found = true;
									}
									echo '<option value="'.$item->id.'"'.(($selected) ? ' selected="selected"' : '' ).'>'.$item->name.'</option>';
								}
								?>
							</select>
						</div>
					</div>
				</div>
			
			<?php endif; ?>
			
		</div>
		<div class="row"><div class="col-xs-12 submit"><input type='submit' value='Valider'></div></div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-lg-6">
			<div class="content">
				<div class="absTopRight">
					<span id="PrevuBtn" class="mainlink">Prévisualiser</span>
				</div>
		
				<h1>Contenu de la page</h1>
			
				<textarea id="Contenu" name="content"><?= $content ?></textarea>
			</div>
		</div>
		<div class="col-xs-12 col-lg-6">
			<div id="Prevu"class="content">
			
			</div>
		</div>
	</div>
<form>

<script type="text/javascript">
	document.getElementById("PrevuBtn").onclick = function () { document.getElementById("Prevu").innerHTML = document.getElementById("Contenu").value; };
</script>