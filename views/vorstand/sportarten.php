<div id="seiteninhalt-index">
<h2>Sportarten</h2>
	<div id="sportarten">
		<form id="save_sportarten" role="form" action="<?= DIR ?>vorstand/sportarten/0" method="POST">
			<input type="text" id="sportart" name="sportart" placeholder="neue Sportart hinzuf&uuml;gen">
			<input type="submit" value="Hinzuf&uuml;gen">
			<input type="hidden" name="csrf" value="<?= Session::get('csrf_token') ?>">
		</form>
		<form id="del_sportarten" role="form" action="<?= DIR ?>vorstand/sportarten/1" method="POST">
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
	</div>
	<div>
		<table>
			<thead>
				<tr><th>Sportarten</th></tr>
			</thead>
			<tbody>
			<?php
                foreach ($data as $sportart) {
                    echo '<tr><th>' . $sportart['sportart'] . '</th></tr>';
                }
            ?>
			</tbody>
		</table>
	</div>
</div>
