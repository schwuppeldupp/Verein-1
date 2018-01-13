<div id="navigation">
	<ul>
		<?php echo '<li><a href="' . DIR . 'mainpage/index/">Willkommen</a></li>'; ?>
		<!--<?php echo '<li><a href="' . DIR . 'mainpage/index/' . Session::get('csrf_token') . '">Willkommen</a></li>'; ?>-->
		<li><a href="<?= DIR?>mainpage/angebot"> Angebot </a>
			<ul>
			<?php
                foreach ($data as $sportart) {
                    echo '<li><a href="' . DIR . 'mainpage/angebot/' . $sportart['sportart_id'] . '">'. $sportart['sportart'] . '</a></li>';
                }
            ?>
			</ul>
		</li>
		<li><a href="<?= DIR?>mainpage/impressum">&Uuml;ber uns</a>
			<ul>
				<li><a href="<?= DIR?>mainpage/impressum/vorstand">Vorstand</a></li>
				<li><a href="<?= DIR?>mainpage/impressum/mitglieder">Mitglieder</a></li>
				<li><a href="<?= DIR?>mainpage/impressum/kontakt">Kontakt</a></li>
			</ul>
		</li>
		<?php echo '<li><a href="' . DIR . 'mainpage/register/">Registrierung</a></li>'; ?>
		<!--<?php echo '<li><a href="' . DIR . 'mainpage/register/' . Session::get('csrf_token') . '">Registrierung</a></li>'; ?>-->
	</ul>
</div>
</div>
</div>
