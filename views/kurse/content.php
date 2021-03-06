<div id="seiteninhalt-index">
<h2>Kurse</h2>
	<div id="kurse">
		<table>
			<thead>
				<tr><th>Kursname</th><th>Teilnehmerzahl</th><th>Kursleiter</th><th>Sportart</th><th>Datum</th><th>Beginn</th><th>Ende</th><th>Beschreibung</th><th>Sportst&auml;tte</th><th>&Auml;ndern</th><th>L&ouml;schen</th></tr>
			</thead>
			<tbody>
				<?php
                    foreach ($data['kurse'] as $kurs) {
                        echo '<form id="kurse" role="form" action="' . DIR . 'kurse/kurse/1" method="POST">' . "\n";
                        echo '<tr><th><input type="text" name="kursname" value="' . $kurs['kursname'] . '"></th>
                              <th><input type="text" name="maxteilnehmer" value="' . $kurs['maxteilnehmer'] . '"></th>
                              <th><select id="mitglieder" name="mitglied_id">';
                        foreach ($data['mitglieder'] as $mitglied) {
                            if($mitglied['mitglied_id'] == $kurs['mitglied_id']){
                                echo '<option value="' . $mitglied['mitglied_id'] . '" selected>' . $mitglied['vorname'] . ' ' . $mitglied['nachname'] . '</option>';
                            }
                            else {
                                echo '<option value="' . $mitglied['mitglied_id'] . '">' . $mitglied['vorname'] . ' ' . $mitglied['nachname'] . '</option>';
                            }
                        }
                        echo '</select></th>
                               <th><select id="sportart" name="sportart">';
                        foreach ($data['sportarten'] as $sportart) {
                            if($sportart['sportart_id'] == $kurs['sportart_id']){
                                echo '<option value="' . $sportart['sportart'] . '" selected>' . $sportart['sportart'] . '</option>';
                            }
                            else {
                                echo '<option value="' . $sportart['sportart'] . '">' . $sportart['sportart'] . '</option>';
                            }
                        }                       
                        echo '</select></th>
                              <th><input type="date" name="datum" value="' . substr($kurs['beginn'], 0, 10) . '"></th>
                              <th><input type="time" name="beginn" value="' .  substr($kurs['beginn'], -8) . '"></th>
                              <th><input type="time" name="ende" value="' . substr($kurs['ende'], -8) . '"></th>
                              <th><input type="text" name="beschreibung" value="' . $kurs['beschreibung'] . '"></th>';

                        echo '</select></th>
                               <th><select id="sportstaette" name="bezeichnung">';
                        foreach ($data['sportstaetten'] as $sportstaette) {
                            if($sportstaette['sportstaette_id'] == $kurs['sportstaette_id']){
                            //if($sportstaette['sportart_id'] == $kurs['sportart_id']){
                                echo '<option value="' . $sportstaette['bezeichnung'] . '" selected>' . $sportstaette['bezeichnung'] . '</option>';
                            }
                            else {
                                echo '<option value="' . $sportstaette['bezeichnung'] . '">' . $sportstaette['bezeichnung'] . '</option>';
                            }
                        }              

                        echo '</select><th><input type="submit" name="change" value="&#8635;"/></th><th><input type="submit" name="delete" value="&#10006;"></th></tr>' . "\n";
                        echo '<input type="hidden" name="kurs_id" value="' . $kurs['kurs_id'] . '"/>' . "\n";
                        echo '<input type="hidden" name="sportart_id" value="' . $kurs['sportart_id'] . '"/>' . "\n";
                        echo '<input type="hidden" name="csrf" value="' . Session::get('csrf_token') . '"/>' . "\n";
                        echo '</form>' . "\n";
                    }
                    
                    
                    
                    
                    
                    echo '<form id="kurse" role="form" action="' . DIR . 'kurse/kurse/0" method="POST">' . "\n";
                    echo '<tr><th><input type="text" name="kursname" placeholder="neuen Kurs hinzuf&uuml;gen"></th>
                            <th><input type="text" name="maxteilnehmer" placeholder="maximale Teilnehmer"></th>
                            <th><select id="mitglieder" name="mitglied_id">';
                    foreach ($data['mitglieder'] as $mitglied) {
                        echo '<option value="' . $mitglied['mitglied_id'] . '">' . $mitglied['vorname'] . ' ' . $mitglied['nachname'] . '</option>';
                    }
                    echo '</select></th>
                            <th><select id="sportart" name="sportart">';                    
                    foreach ($data['sportarten'] as $sportart) {
                        echo '<option value="' . $sportart['sportart'] . '">' . $sportart['sportart'] . '</option>';
                    }
                    echo '</select></th>
                            <th><input type="date" name="datum"></th>
                            <th><input type="time" name="beginn"></th>
                            <th><input type="time" name="ende"></th>
                            <th><input type="text" name="beschreibung" placeholder="Beschreibung"></th>';
                    echo '</select></th>
                            <th><select id="sportstaette" name="bezeichnung">';
                    foreach ($data['sportstaetten'] as $sportstaette) {
                        echo '<option value="' . $sportstaette['bezeichnung'] . '">' . $sportstaette['bezeichnung'] . '</option>';
                    }
                    echo '</select><th>Speichern</th><th><input type="submit" name="save" value="&#9654;"></th></tr>' . "\n";
                    echo '<input type="hidden" name="csrf" value="' . Session::get('csrf_token') . '">' . "\n";
                    echo '</form>' . "\n";
                ?>
			</tbody>
		</table>
	</div>
</div>
