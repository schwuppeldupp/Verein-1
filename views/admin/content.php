<div id="seiteninhalt-index">
<h2>Administration</h2>
<h3>aktueller Vorstand</h3>
<?php 
foreach ($data['vorstand'] as $vorstand) {
    echo '<div>' . $vorstand['vorname'] . ' ' . $vorstand['nachname'] . '</div>';
}
    
?>
<h3>Vorstand setzen</h3>
	<form id="del_sportarten" role="form" action="<?= DIR ?>admin/vorstand/<?= Session::get('csrf_token') ?>" method="POST">
		<select id="vorstand" name="vorstand">
		<?php
		foreach ($data['mitglieder'] as $user) {
		    echo '<option value="' .  $user['mitglied_id'] . '">' .  $user['nachname'] . ' ' . $user['vorname'] . '</option>';
        }
        ?>
		</select>
		<input type="submit" value="Setzen">
		<input type="hidden" name="csrf" value="<?= Session::get('csrf_token') ?>">
	</form>
</div>
