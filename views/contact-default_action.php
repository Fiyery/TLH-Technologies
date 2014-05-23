<div class="content">
	<h1>Nous Contacter</h1>
	<form action='<?php $root_www?>envoyer/' method='post'>
		<div class="row">
			<div class="col-xs-12 col-lg-2"><h2>Vos informations</h2></div>
			<div class="col-xs-12 col-sm-4 col-lg-4">
				<div class="row">
					<div class="col-xs-4 col-sm-2 lbl"><span>Mail<span></div>
					<div class="col-xs-6 col-sm-10"><input name='mail' type="email"/></div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-lg-3">
				<div class="row">
					<div class="col-xs-4 lbl"><span>Nom<span></div>
					<div class="col-xs-6 col-sm-8"><input name='name' type="text"/></div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-lg-3">
				<div class="row">
					<div class="col-xs-4 lbl"><span>Prenom<span></div>
					<div class="col-xs-6 col-sm-8"><input name='firstname' type="text"/></div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12 col-lg-2"><h2>Contenu du mail</h2></div>
			<div class="col-xs-12 col-sm-4 col-lg-4">
				<div class="row">
					<div class="col-xs-4 col-sm-2 lbl"><span>Sujet<span></div>
					<div class="col-xs-6 col-sm-10"><input name='topic' type="text"/></div>
				</div>
			</div>
			<div class="col-xs-12"><textarea name='content'></textarea></div>
		</div>
		<div class="row"><div class="col-xs-10 col-sm-12 submit"><input type='submit' value='Valider'></div></div>
	</form>
</div>