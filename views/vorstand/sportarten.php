<div id="seiteninhalt-index">
<h2>Sportarten</h2>
	<div>
		<form id="save_sportarten" role="form" action="<?= DIR ?>vorstand/sportarten/0/<?= Session::get('csrf_token') ?>" method="POST">
			<input type="text" id="sportart" name="sportart" placeholder="neue Sportart">
			<input type="submit" value="Hinzuf&uuml;gen">
			<input type="hidden" name="csrf" value="<?= Session::get('csrf_token') ?>">
		</form>
		<form id="del_sportarten" role="form" action="<?= DIR ?>vorstand/sportarten/1/<?= Session::get('csrf_token') ?>" method="POST">
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
		<ul style="list-style-type: none">
		<?php
         foreach ($data as $sportart) {
            echo '<li>' . $sportart['sportart'] . '</li>';
         }
        ?>
   		</ul>
	</div>
</div>
