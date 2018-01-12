<div id="navigation">
	<ul>
		<li><a href="<?= DIR?>admin/index/<?= Session::get('csrf_token')?>">Vorstand setzen</a></li>
		<?php echo '<li><a href="' . DIR . 'mainpage/logout/' . Session::get('csrf_token') . '">Ausloggen</a></li>'; ?>
	</ul>
</div>
</div>
</div>

