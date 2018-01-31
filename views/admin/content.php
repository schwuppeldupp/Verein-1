<div id="seiteninhalt-index">
<h2>Administration</h2>
<h3>Vorstand setzen</h3>
	<form id="vorstand" role="form" action="<?= DIR ?>admin/vorstand" method="POST">
		<select id="vorstand" name="vorstand">
		<?php
		foreach ($data['mitglieder'] as $user) {
		    echo '<option value="' .  $user['mitglied_id'] . '">' .  $user['nachname'] . ' ' . $user['vorname'] . '</option>';
        }
        ?>
		</select>
		<input type="submit" value="W&auml;hlen/Abw&auml;hlen">
		<input type="hidden" name="csrf" value="<?= Session::get('csrf_token') ?>">
	</form>
<h3>aktueller Vorstand</h3>
<div>
	<table>
		<thead>
			<tr><th>Vorstand</th></tr>
		</thead>
		<tbody>
		<?php
		foreach ($data['vorstand'] as $vorstand) {
			   echo '<tr><th>' . $vorstand['vorname'] . ' ' . $vorstand['nachname'] . '</th></tr>';
        }
        ?>
		</tbody>
	</table>
</div>
</div>
