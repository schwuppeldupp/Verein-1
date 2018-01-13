<div id="seiteninhalt-index">
<h2>Aktuelle Mitglieder</h2>
	<div>
		<table>
			<thead>
				<tr><th>Nachname</th><th>Vorname</th><th>Geburtsdatum</th><th>Strasse</th><th>Hausnummer</th><th>Postleitzahl</th><th>Ort</th><th>Telefon</th><th>e-mail</th></tr>
			</thead>
			<tbody>
			<?php
			foreach ( $data['mitglieder'] as $user) {
			    echo '<tr><th>' . $user['nachname'] . '</th><th>' . $user['vorname'] . '</th><th>' . date("d.m.Y", strtotime($user['geburtsdatum'])) . '</th><th>' . $user['strasse'] . '</th><th>' . $user['hausnummer'] . '</th><th>' . $user['postleitzahl'] . '</th><th>' . $user['ort'] . '</th><th>' . $user['telefon'] . '</th><th>' . $user['email'] . '</th></tr>';
            }
            ?>
			</tbody>
		</table>
	</div>
</div>
