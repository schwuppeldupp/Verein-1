<div id="navigation">
	<ul>
		<li><a href="<?= DIR?>vorstand/angebot/<?= Session::get('csrf_token')?>"> Angebot verwalten</a></li>
		<li><a href="<?= DIR?>vorstand/buchung/<?= Session::get('csrf_token')?>">Buchung verwalten</a></li>
		<li><a href="<?= DIR?>vorstand/impressum/<?= Session::get('csrf_token')?>">&Uuml;ber uns verwalten</a></li>
		<?php echo '<li><a href="' . DIR . 'mainpage/logout/' . Session::get('csrf_token') . '">Ausloggen</a></li>'; ?>
	</ul>
</div>
</div>
</div>
