<div id="navigation">
	<ul>
		<?php echo '<li><a href="' . DIR . 'mainpage/index/">Willkommen</a></li>'; ?>
		<!--<?php echo '<li><a href="' . DIR . 'mainpage/index/' . Session::get('csrf_token') . '">Willkommen</a></li>'; ?>-->
		<li><a href="<?= DIR?>mainpage/angebot"> Angebot </a>
			<ul>
				<li><a href="<?= DIR?>mainpage/angebot/Kurs1">Fu&szlig;ball</a></li>
				<li><a href="<?= DIR?>mainpage/angebot/Kurs2">Bogenschie&szlig;en</a></li>
				<li><a href="<?= DIR?>mainpage/angebot/Kurs3">Wandern</a></li>
				<li><a href="<?= DIR?>mainpage/angebot/Kurs4">Basketball</a></li>
				<li><a href="<?= DIR?>mainpage/angebot/Kurs5">Tennis</a></li>
				<li><a href="<?= DIR?>mainpage/angebot/Kurs6">Klettern</a></li>
				<li><a href="<?= DIR?>mainpage/angebot/Kurs7">Yoga</a></li>
			</ul>
		</li>
		<li><a href="<?= DIR?>mainpage/impressum">&Uuml;ber uns</a>
			<ul>
				<li><a href="impressum/vorstand">Vorstand</a></li>
				<li><a href="impressum/mitglieder">Mitglieder</a></li>
				<li><a href="impressum/kontakt">Kontakt</a></li>
			</ul>
		</li>
		<?php echo '<li><a href="' . DIR . 'mainpage/register/">Registrierung</a></li>'; ?>
		<!--<?php echo '<li><a href="' . DIR . 'mainpage/register/' . Session::get('csrf_token') . '">Registrierung</a></li>'; ?>-->
	</ul>
</div>
</div>
</div>
