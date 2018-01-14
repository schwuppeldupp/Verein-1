<div id="seiteninhalt-index">
<h2>Angebot</h2>
<table>
	<thead>
		<tr><th>Kursname</th><th>Teilnehmerzahl</th><th>Kursleiter</th><th>Sportart</th><th>Datum</th><th>Beginn</th><th>Ende</th><th>Beschreibung</th></tr>
	</thead>
	<tbody>
<?php
foreach ($data['kurse'] as $kurs) {
    echo '<tr><th>' . $kurs['kursname'] . '</th>
          <th>' .$kurs['maxteilnehmer'] . '</th>
          <th>' . $kurs['kursleiter'] .  '</th>
          <th>' . $kurs['sportart'] . '</th>
          <th>' . date("d.m.Y", strtotime(substr($kurs['beginn'], 0, 10))) . '</th>
          <th>' . substr($kurs['beginn'], -8, 5) . '</th>
          <th>' . substr($kurs['ende'], -8, 5) . '</th>
          <th>' . $kurs['beschreibung'] . '</th>'
          . '</th></tr>';
}
?>
   </tbody>
</table>
</div>
