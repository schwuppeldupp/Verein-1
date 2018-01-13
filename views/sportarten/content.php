<div id="seiteninhalt-index">
<h2>Sportarten</h2>
	<div id="sportarten">
		<form id="save_sportarten" role="form" action="<?= DIR ?>sportarten/sportarten/0/<?= Session::get('csrf_token') ?>" method="POST">
			<input type="text" id="sportart" name="sportart" placeholder="neue Sportart hinzuf&uuml;gen">
			<textarea name="beschreibung" rows="20" cols="22" placeholder="Beschreibung"></textarea>
			<input type="submit" id="submit" value="Hinzuf&uuml;gen">
			<input type="hidden" name="csrf" value="<?= Session::get('csrf_token') ?>">
		</form>
		<form id="del_sportarten" role="form" action="<?= DIR ?>sportarten/sportarten/1/<?= Session::get('csrf_token') ?>" method="POST">
			<select id="sportart" name="sportart">
			<?php
            foreach ($data as $sportart) {
                echo '<option value="' . $sportart['sportart'] . '">' . $sportart['sportart'] . '</option>';
            }
            ?>
			</select>
			<input type="submit" value="L&ouml;schen">
			<input type="hidden" name="csrf" value="<?= Session::get('csrf_token') ?>">
		</form>
		<table>
			<thead>
				<tr><th>Sportarten</th><th>Beschreibung</th></tr>
			</thead>
			<tbody>
			<?php
                foreach ($data as $sportart) {
                    echo '<tr><th>' . $sportart['sportart'] . '</th><th>' . $sportart['beschreibung'] . '</th></tr>';
                }
            ?>
			</tbody>
		</table>
	</div>
</div>