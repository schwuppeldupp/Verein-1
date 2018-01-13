<div id="navigation">
	<ul>
		<li><a href="<?= DIR?>mitglied/vorstand/<?= Session::get('csrf_token')?>">Mitglieder</a></li>
		<li><a href="<?= DIR?>sportarten/angebot/<?= Session::get('csrf_token')?>">Angebote</a></li>
		<li><a href="<?= DIR?>kurse/verwaltung/<?= Session::get('csrf_token')?>">Buchungen</a></li>
		<li><a href="<?= DIR?>mitglied/impressum2/<?= Session::get('csrf_token')?>">Impressum</a></li>
		<?php echo '<li><a href="' . DIR . 'mainpage/logout/' . Session::get('csrf_token') . '">Ausloggen</a></li>'; ?>
	</ul>
</div>
</div>
</div>
