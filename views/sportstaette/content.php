<div id="seiteninhalt-index">
<h2>Sportst&auml;tten</h2>
	<div id="sportstaetten">
		<form id="save_sportstaetten" role="form" action="<?= DIR ?>sportstaette/setzen/0/<?= Session::get('csrf_token') ?>" method="POST">
			<input type="text" id="sporstaette" name="sportstaette" placeholder="neue Sportst&auml;tte hinzuf&uuml;gen">
			<input type="submit" value="Hinzuf&uuml;gen">
			<input type="hidden" name="csrf" value="<?= Session::get('csrf_token') ?>">
		</form>
		<form id="del_sportstaetten" role="form" action="<?= DIR ?>sportstaette/setzen/1/<?= Session::get('csrf_token') ?>" method="POST">
			<select id="sportstaette" name="sportstaette">
			<?php
            foreach ($data as $sportstaette) {
                echo '<option value="' . $sportstaette['sportstaette_id'] . '">' . $sportstaette['bezeichnung'] . '</option>';
            }
            ?>
			</select>
			<input type="submit" value="L&ouml;schen">
			<input type="hidden" name="csrf" value="<?= Session::get('csrf_token') ?>">
		</form>
	</div>
	<div>
	<form id="sportstaetten" role="form" action="<?= DIR ?>sportstaette/setzen/2/<?= Session::get('csrf_token') ?>" method="POST">
		<table>
			<thead>
				<tr><th>Sportarten</th><th>&Auml;ndern</th><th>L&ouml;schen</th></tr>
			</thead>
			<tbody>
			<?php
                foreach ($data as $sportart) {
                    echo '<tr><th>' . $sportart['bezeichnung'] . '</th><th><input type="submit" name="c_' . $sportart['sportart_id'] . '" value="&#8635;"></th><th><input type="submit" name="d_' . $sportart['sportart_id'] . '" value="&#10006;"></th></tr>';
                }
            ?>
			</tbody>
		</table>
		<input type="hidden" name="csrf" value="<?= Session::get('csrf_token') ?>">
	</form>
	</div>
</div>
