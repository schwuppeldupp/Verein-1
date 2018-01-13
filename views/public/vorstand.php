<div id="seiteninhalt-index">
<h2>Vorstand</h2>
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

