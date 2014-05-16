<div class="content">
	<div class="absTopRight">
		<a href='<?= $root_www ?>admin/panel/' class="mainlink icon small back">Retour au panel</a>
		<a href='<?= $root_www ?>admin/deconnection/' class="mainlink icon small logout">Déconnection</a>
	</div>
	
	<h1>Edition de l'élément</h1>
	
	<form action="<?= $root_www ?>admin/update/" method="post">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-lg-3">
				<div class="row">
					<div class="col-xs-4 lbl"><span>Nom<span></div>
					<div class="col-xs-6 col-sm-8"><input name="name" type="text"/></div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-lg-3">
				<div class="row">
					<div class="col-xs-4 lbl"><span>Ordre<span></div>
					<div class="col-xs-6 col-sm-8"><input name="order" type="text"/></div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-lg-3">
				<div class="row">
					<div class="col-xs-4 lbl"><span>Visible<span></div>
					<div class="col-xs-6 col-sm-8">
						<select name="enable">
							<option value="" selected="selected"></option>
							<option value="0">Oui</option>
							<option value="1">Non</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-lg-3">
				<div class="row">
					<div class="col-xs-4 lbl"><span>Parent<span></div>
					<div class="col-xs-6 col-sm-8">
						<select name="id_menu">
							<option value="" selected="selected"></option>
							<option value="1">Parent 1</option>
							<option value="2">Parent 2</option>
							<option value="3">Parent 3</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="row"><div class="col-xs-12 submit"><input type='submit' value='Valider'></div></div>
	<form>
</div>