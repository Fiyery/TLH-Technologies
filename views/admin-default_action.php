<div class="content">
	<div class="center large">
		<h1>Veuillez saisir vos identifiants</h1>
		<form action='<?= $root_www ?>admin/connection/' method='post'>
			<div class="row">
				<div class="col-xs-4 lbl"><span>Login<span></div>
				<div class="col-xs-6 col-sm-8"><input name='login' type="text"/></div>
			</div>
			<div class="row">
				<div class="col-xs-4 lbl"><span>Mot de passe<span></div>
				<div class="col-xs-6 col-sm-8"><input name='pass' type="password"/></div>
			</div>
			<div class="row"><div class="col-xs-12 submit"><input type='submit' value='Valider'></div></div>
		</form>
	</div>
</div>