<div id="anmeldung">
	 <form role="form" action="<?= DIR ?>mitglied/login/<?= Session::get('csrf_token') ?>" method="POST">
		<input type="text" id="name" name="login[name]" placeholder="Benutzername" >
		<input type="password" id="passwort" name="login[passwort]" placeholder="Passwort">
		<input type="submit" id="Abutton" value="&#9654" >
		<input type="hidden" name="csrf" value="<?= Session::get('csrf_token') ?>">
	</form>
	<div><?= Message::show()?></div>
</div>
