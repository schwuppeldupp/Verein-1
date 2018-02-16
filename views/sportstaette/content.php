<div id="seiteninhalt-index">
<h2>Sportst&auml;tten</h2>
	<div id="kurse">
		<table>
			<thead>
				<tr><th>Sportst&auml;tte</th><th>Strasse</th><th>Hausnummer</th><th>Postleitzahl</th><th>Ort</th><th>Sportart</th><th>&Auml;ndern</th><th>L&ouml;schen</th></tr>
			</thead>
			<tbody>
			<?php
			     foreach ($data['sportstaetten'] as $sportstaette) {
			         echo '<form id="sportstaette" role="form" action="' . DIR . 'sportstaette/setzen/1" method="POST">' . "\n";
			         echo '<tr><th><input type="text" name="bezeichnung" value="' . $sportstaette['bezeichnung'] . '"></th>
                          <th><input type="text" name="strasse" value="' . $sportstaette['strasse'] . '"></th>
                          <th><input type="text" name="hausnummer" value="' . $sportstaette['hausnummer'] . '"></th>
                          <th><input type="text" name="postleitzahl" value="' . $sportstaette['postleitzahl'] . '"></th>
                          <th><input type="text" name="ort" value="' . $sportstaette['ort'] . '"></th>';
			         echo '</select></th>
                          <th><select id="sportart" name="sportart">';
			         foreach ($data['sportarten'] as $sportart) {
			             if($sportart['sportart_id'] == $sportstaette['sportart_id']){
			                 echo '<option value="' . $sportart['sportart'] . '" selected>' . $sportart['sportart'] . '</option>';
			             }
			             else {
			                 echo '<option value="' . $sportart['sportart'] . '">' . $sportart['sportart'] . '</option>';
			             }
			         } 
			         
			         echo '</select></th>
                          <th><input type="submit" name="change" value="&#8635;"/></th><th><input type="submit" name="delete" value="&#10006;"></th></tr>' . "\n";
			         echo '<input type="hidden" name="sportstaette_id" value="' . $sportstaette['sportstaette_id'] . '"/>' . "\n";
			         echo '<input type="hidden" name="adresse_id" value="' . $sportstaette['adresse_id'] . '"/>' . "\n";
			         echo '<input type="hidden" name="sportart_id" value="' . $sportstaette['sportart_id'] . '"/>' . "\n";
			         echo '<input type="hidden" name="csrf" value="' . Session::get('csrf_token') . '"/>' . "\n";
			         echo '</form>' . "\n";
			     }
			     echo '<form id="sportstaette" role="form" action="' . DIR . 'sportstaette/setzen/0" method="POST">' . "\n";
                 echo '<tr><th><input type="text" name="bezeichnung" placeholder="neue Sportst&auml;tte hinzuf&uuml;gen"></th>
                      <th><input type="text" name="strasse" placeholder="Strasse"></th>
                      <th><input type="text" name="hausnummer" placeholder="Hausnummer"></th>
                      <th><input type="text" name="postleitzahl" placeholder="Postleitzahl"></th>
                      <th><input type="text" name="ort" placeholder="Ort"></th>';
                 echo '</select></th>
                      <th><select id="sportart" name="sportart">';                    
                 foreach ($data['sportarten'] as $sportart) {
                     echo '<option value="' . $sportart['sportart'] . '">' . $sportart['sportart'] . '</option>';
                 }
                 echo '</select></th>
                      <th>Speichern</th><th><input type="submit" name="save" value="&#9654;"></th></tr>' . "\n";
                 echo '<input type="hidden" name="csrf" value="' . Session::get('csrf_token') . '">' . "\n";
                 echo '</form>' . "\n";
                ?>
			</tbody>
		</table>
	</div>
</div>
