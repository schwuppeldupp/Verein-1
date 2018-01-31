<div id="seiteninhalt-index">
<h2>Sportarten</h2>
	<div id="sportarten">
		<table>
			<thead>
				<tr><th>Sportarten</th><th>Beschreibung</th><th>&Auml;ndern</th><th>L&ouml;schen</th></tr>
			</thead>
			<tbody>
				<?php
                    foreach ($data as $sportart) {
                        echo '<form id="sportstaetten" role="form" action="' . DIR . 'sportarten/sportarten/1" method="POST">' . "\n";
                        echo '<tr><th><input type="text" name="sportart" value="' . $sportart['sportart'] . '"></th><th><input type="text" name="beschreibung" value="' . $sportart['beschreibung'] . '"></th><th><input type="submit" name="change" value="&#8635;"/></th><th><input type="submit" name="delete" value="&#10006;"></th></tr>' . "\n";
                        echo '<input type="hidden" name="sportart_id" value="' . $sportart['sportart_id'] . '"/>' . "\n";
                        echo '<input type="hidden" name="csrf" value="' . Session::get('csrf_token') . '"/>' . "\n";
                        echo '</form>' . "\n";
                    }
                    echo '<form id="sportstaetten" role="form" action="' . DIR . 'sportarten/sportarten/0" method="POST">' . "\n";
                    echo '<tr><th><input type="text" name="sportart" placeholder="neue Sportart hinzuf&uuml;gen"></th><th><input type="text" name="beschreibung" placeholder="Beschreibung"></th><th>Speichern</th><th><input type="submit" name="save" value="&#9654;"></th></tr>' . "\n";
                    echo '<input type="hidden" name="csrf" value="' . Session::get('csrf_token') . '">' . "\n";
                    echo '</form>' . "\n";
                ?>
				</tbody>
		</table>
	</div>
</div>