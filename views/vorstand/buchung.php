<div id="seiteninhalt-index">
<h2>Kurse</h2>
	<div id="kurse">
		<table>
			<thead>
				<tr><th>Kursname</th><th>Teilnehmerzahl</th><th>Datum</th><th>Beginn</th><th>Ende</th><th>Beschreibung</th><th>&Auml;ndern</th><th>L&ouml;schen</th></tr>
			</thead>
			<tbody>
				<?php
                    foreach ($data['kurse'] as $kurs) {
                        echo '<form id="sportstaetten" role="form" action="' . DIR . 'kurse/kurse/1/' . Session::get('csrf_token') . '" method="POST">' . "\n";
                        echo '<tr><th><input type="text" name="kursname" value="' . $kurs['kursname'] . '"></th><th><input type="text" name="maxteilnehmer" value="' . $kurs['maxteilnehmer'] . '"></th><th><input type="date" name="datum" value="' . $kurs['datum'] . '"></th><th><input type="time" name="beginn" value="' . $kurs['beginn'] . '"></th><th><input type="time" name="ende" value="' . $kurs['ende'] . '"></th><th><input type="text" name="beschreibung" value="' . $kurs['beschreibung'] . '"></th><th><input type="submit" name="change" value="&#8635;"/></th><th><input type="submit" name="delete" value="&#10006;"></th></tr>' . "\n";
                        echo '<input type="hidden" name="sportart_id" value="' . $kurs['sportart_id'] . '"/>' . "\n";
                        echo '<input type="hidden" name="csrf" value="' . Session::get('csrf_token') . '"/>' . "\n";
                        echo '</form>' . "\n";
                    }
                    echo '<form id="sportstaetten" role="form" action="' . DIR . 'kurse/kurse/0/' . Session::get('csrf_token') . '" method="POST">' . "\n";
                    echo '<tr><th><input type="text" name="kursname" placeholder="neuen Kurs hinzuf&uuml;gen"></th><th><input type="text" name="maxteilnehmer" placeholder="maximale Teilnehmer"></th><th><input type="date" name="beginn"></th><th><input type="time" name="beginn"></th><th><input type="time" name="ende"></th><th><input type="text" name="beschreibung" placeholder="Beschreibung"></th><th>Speichern</th><th><input type="submit" name="save" value="&#9654;"></th></tr>' . "\n";
                    echo '<input type="hidden" name="csrf" value="' . Session::get('csrf_token') . '">' . "\n";
                    echo '</form>' . "\n";
                ?>
				</tbody>
		</table>
	</div>
</div>