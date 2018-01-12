<div id="navigation">
	<ul>
		<!--<?php echo '<li><a href="' . DIR . 'mitglied/index">Willkommen</a></li>'; ?>-->
		<?php echo '<li><a href="' . DIR . 'mitglied/index/' . Session::get('csrf_token') . '">Willkommen</a></li>'; ?>
		<li><a href="<?= DIR?>mitglied/angebot/<?= Session::get('csrf_token')?>"> Angebot </a>
			<ul>
				<li><a href="<?= DIR?>mitglied/angebot/Kurs1/<?= Session::get('csrf_token')?>">Fu&szlig;ball</a></li>
				<li><a href="<?= DIR?>mitglied/angebot/Kurs2/<?= Session::get('csrf_token')?>">Bogenschie&szlig;en</a></li>
				<li><a href="<?= DIR?>mitglied/angebot/Kurs3/<?= Session::get('csrf_token')?>">Wandern</a></li>
				<li><a href="<?= DIR?>mitglied/angebot/Kurs4/<?= Session::get('csrf_token')?>">Basketball</a></li>
				<li><a href="<?= DIR?>mitglied/angebot/Kurs5/<?= Session::get('csrf_token')?>">Tennis</a></li>
				<li><a href="<?= DIR?>mitglied/angebot/Kurs6/<?= Session::get('csrf_token')?>">Klettern</a></li>
				<li><a href="<?= DIR?>mitglied/angebot/Kurs7/<?= Session::get('csrf_token')?>">Yoga</a></li>
			</ul>
		</li>
		<li><a href="<?= DIR?>mitglied/buchung/<?= Session::get('csrf_token')?>">Buchung</a></li>
		<li><a href="<?= DIR?>mitglied/impressum/<?= Session::get('csrf_token')?>">&Uuml;ber uns</a>
			<ul>
				<li><a href="vorstand/<?= Session::get('csrf_token')?>">Vorstand</a></li>
				<li><a href="mitglieder/<?= Session::get('csrf_token')?>">Mitglieder</a></li>
				<li><a href="kontakt/<?= Session::get('csrf_token')?>">Kontakt</a></li>
			</ul>
		</li>
		<?php echo '<li><a href="' . DIR . 'mainpage/logout/' . Session::get('csrf_token') . '">Ausloggen</a></li>'; ?>
	</ul>
</div>
</div>
</div>
