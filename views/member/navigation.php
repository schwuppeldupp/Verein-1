<div id="navigation">
	<ul>
		<!--<?php echo '<li><a href="' . DIR . 'mitglied/index">Willkommen</a></li>'; ?>-->
		<?php echo '<li><a href="' . DIR . 'mitglied/index/' . Session::get('csrf_token') . '">Willkommen</a></li>'; ?>
		<li><a href="<?= DIR?>mitglied/angebot/<?= Session::get('csrf_token')?>">Angebot</a>
			<ul>
			<?php
			foreach ($data['sportarten'] as $sportart) {
                    echo '<li><a href="' . DIR . 'mitglied/angebot/' . $sportart['sportart_id'] . '/' . Session::get('csrf_token') . '">'. $sportart['sportart'] . '</a></li>';
                }
            ?>
			</ul>
		</li>
		<li><a href="<?= DIR?>mitglied/buchung/<?= Session::get('csrf_token')?>">Buchung</a></li>
		<li><a href="<?= DIR?>mitglied/impressum/<?= Session::get('csrf_token')?>">&Uuml;ber uns</a>
			<ul>
				<li><a href="<?= DIR?>mitglied/impressum/vorstand/<?= Session::get('csrf_token')?>">Vorstand</a></li>
				<li><a href="<?= DIR?>mitglied/impressum/mitglieder/<?= Session::get('csrf_token')?>">Mitglieder</a></li>
				<li><a href="<?= DIR?>mitglied/impressum/kontakt/<?= Session::get('csrf_token')?>">Kontakt</a></li>
			</ul>
		</li>
		<?php echo '<li><a href="' . DIR . 'mainpage/logout/' . Session::get('csrf_token') . '">Ausloggen</a></li>'; ?>
	</ul>
</div>
</div>
</div>
