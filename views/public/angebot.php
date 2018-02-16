<div id="seiteninhalt-index">
<h2>Angebot</h2>
 <div class="table">
    <div class="trhead">
      <div class="td">Kursname</div>
      <div class="td">Teilnehmerzahl</div>
      <div class="td">Kursleiter</div>
      <div class="td">Sportart</div>
	  <div class="td">Datum</div>
	  <div class="td">Beginn</div>
	  <div class="td">Ende</div>
	  <div class="td">Ort</div>
	  <div class="td">Beschreibung</div>
    </div>
<?php
foreach ($data['kurse'] as $kurs) {
    echo '<div class="tr">' . "\n"; 
    echo '<div class="td">' . $kurs['kursname'] . '</div>' . "\n"; 
    echo '<div class="td">' . $kurs['maxteilnehmer'] . '</div>' . "\n"; 
    echo '<div class="td">' . $kurs['vorname'] . ' ' . $kurs['nachname'] . '</div>' . "\n"; 
    echo '<div class="td">' . $kurs['sportart'] . '</div>' . "\n"; 
    echo '<div class="td">' . date("d.m.Y", strtotime(substr($kurs['beginn'], 0, 10))) . '</div>' . "\n"; 
    echo '<div class="td">' . substr($kurs['beginn'], -8, 5) . '</div>' . "\n"; 
    echo '<div class="td">' . substr($kurs['ende'], -8, 5) . '</div>' . "\n"; 
    echo '<div class="td">' . $kurs['bezeichnung'] . '</div>' . "\n"; 
    echo '<div class="td">' . $kurs['beschreibung'] . '</div>' . "\n"; 
    echo '</div>' . "\n"; 
}
?>
</div>
</div>
