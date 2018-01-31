<div id="navigation">
	<ul>
		<!--<?php echo '<li><a href="' . DIR . 'mitglied/index">Willkommen</a></li>'; ?>-->
		<?php echo '<li><a href="' . DIR . 'mitglied/index' . '">Willkommen</a></li>'; ?>
		<li><a href="<?= DIR?>mitglied/angebot">Angebot</a>
			<ul>
			<?php
			foreach ($data['sportarten'] as $sportart) {
                    echo '<li><a href="' . DIR . 'mitglied/angebot' . $sportart['sportart_id'] . '">'. $sportart['sportart'] . '</a></li>';
                }
            ?>
			</ul>
		</li>
		<li><a href="<?= DIR?>mitglied/buchung">Buchung</a></li>
		<li><a href="<?= DIR?>mitglied/impressum">&Uuml;ber uns</a>
			<ul>
				<li><a href="<?= DIR?>mitglied/impressum/vorstand">Vorstand</a></li>
				<li><a href="<?= DIR?>mitglied/impressum/mitglieder">Mitglieder</a></li>
				<li><a href="<?= DIR?>mitglied/impressum/kontakt">Kontakt</a></li>
			</ul>
		</li>
		<?php echo '<li><a href="' . DIR . 'mainpage/logout">Ausloggen</a></li>'; ?>
	</ul>
</div>
</div>
</div>
