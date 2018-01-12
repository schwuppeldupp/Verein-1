<div id="seiteninhalt-registrierung">
<h2><?= $data['title']?></h2>
	<div id="beschriftung">
	<ol>
		<li>Name</li>
		<li>Vorname</li>
		<li>Strasse, Hausnummer</li>
		<li>PLZ, Ort</li>
		<li>Telefonnummer</li>
		<li>E-Mail</li>
		<li>Geburtsdatum</li>
		<li>Passwort</li>
		<li>Passwort wiederholen</li>
		<li>Registrierung abschlie&szlig;en </li>
	</ol>
	</div>
	<form id="registrierung" role="form" action="<?= DIR ?>mitglied/registration/<?= Session::get('csrf_token') ?>" method="POST">
	<ul style="list-style-type: none">
		<li><input type="text" id="nachname" name="register[nachname]" placeholder="Nachname"></li>
		<li><input type="text" id="vorname" name="register[vorname]" placeholder="Vorname"></li>
		<li><input type="text" id="strasse" name="register[strasse]" placeholder="Strasse"> <input type="text" id="hausnr" name="register[hausnr]" placeholder="Hausnummer"></li>
		<li><input type="text" id="plz" name="register[plz]" placeholder="Postleitzahl"> <input type="text" id="ort" name="register[ort]" placeholder="Ort"></li>
		<li><input type="text" id="telNr" name="register[telefon]" placeholder="Telefonnummer"></li>
		<li><input type="email" id="email" name="register[email]" placeholder="Mailadresse"></li>
		<li><input type="date" id="gebdatum" name="register[geburtsdatum]"></li>
		<li><input type="password" id="passwort1" name="register[passwort]" placeholder="Passwort"></li>
		<li><input type="password" id="passwort2" name="register[passwort2]" placeholder="Passwort wiederholen"></li>
		<li><input type="submit" value="Abschicken"></li>
	</ul>
	<input type="hidden" name="csrf" value="<?= Session::get('csrf_token') ?>">
	</form>
</div>  
