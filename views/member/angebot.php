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
	  <div class="td">Buchen</div>
    </div>
<?php
//echo print_r($data['kurse']);


foreach ($data['kurse'] as $kurs) {
    
    //echo print_r($kurs);
    //die();
    
    if ($kurs['gebucht'] != Session::get('mitglied_id') && $kurs['is_gebucht'] != '1')
    {
        //echo print_r($kurs);
        echo '<div class="tr">' . "\n";
        echo '<div class="td">' . $kurs['kursname'] . '</div>'  . "\n";
        echo '<div class="td">' . $kurs['maxteilnehmer'] . '</div>';
        echo '<div class="td">' . $kurs['vorname'] . ' ' . $kurs['nachname'] . '</div>'  . "\n";
        echo '<div class="td">' . $kurs['sportart'] . '</div>'  . "\n"; ;
        echo '<div class="td">' . date("d.m.Y", strtotime(substr($kurs['beginn'], 0, 10))) . '</div>'  . "\n";
        echo '<div class="td">' . substr($kurs['beginn'], -8, 5) . '</div>'  . "\n";
        echo '<div class="td">' . substr($kurs['ende'], -8, 5) . '</div>' . "\n";
        echo '<div class="td">' . $kurs['bezeichnung'] . '</div>' . "\n";
        echo '<div class="td">' . $kurs['beschreibung'] . '</div>' . "\n";
        echo '<div class="td"><form id="buchen" role="form" action="' . DIR . 'kurse/buchen/1" method="POST"><input type="submit" name="book" value="&#8635;"/><input type="hidden" name="kurs_id" value="' .$kurs['kurs_id'] . '"/><input type="hidden" name="csrf" value="' . Session::get('csrf_token') . '"/></form></div>' . "\n";
        //echo '<div class="td"><form id="buchen" role="form" action="' . DIR . 'kurse/buchen/1" method="POST"><input type="submit" name="delete" value="&#10006;"/><input type="hidden" name="kurs_id" value="' .$kurs['kurs_id'] . '"/><input type="hidden" name="csrf" value="' . Session::get('csrf_token') . '"/></form></div>' . "\n";
        echo '</div>' . "\n"; 
    } 
}
?>
</div>
</div>
