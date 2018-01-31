<div id="seiteninhalt-index">
<h2>Kurse</h2>
 <div class="details">
	<div id="content" class="content"></div>
 </div>
 <div class="settings">
 <div id="table" class="table">
    <div class="trhead">
      <div class="td">Datum</div>
      <div class="td">Beginn</div>
	  <div class="td">Ende</div>
      <div class="td">Kurs</div>
      <div class="td">Kursleiter</div>
      <div class="td">Beschreibung</div>
      <div class="td">Sportart</div>
	  <div class="td">Buchen</div>
	  <div class="td">L&ouml;schen</div>
    </div>
	<?php
        foreach ($data['kurse'] as $kurs) {
            echo '<div id="tr_' . $kurs['kurs_id'] . '" class="tr">';
            //echo '<div id="tr" class="tr">';
			echo '<div class="td">'. date("d.m.Y", strtotime(substr($kurs['beginn'], 0, 10))) . '</div>' . "\n"; 
			echo '<div class="td">' . substr($kurs['beginn'], -8, 5) . '</div>';
			echo '<div class="td">' . substr($kurs['ende'], -8, 5) . '</div>';
			echo '<div class="td">'. $kurs['kursname'] . '</div>' . "\n"; 
			echo '<div class="td">' . $kurs['vorname'] . ' ' . $kurs['nachname'] . '</div>';
			echo '<div id="bs_' . $kurs['kurs_id'] . '" class="td">'. $kurs['beschreibung'] . '</div>' . "\n"; 
			echo '<div class="td">'. $kurs['sportart'] . '</div>' . "\n";
			echo '<div class="td"><form id="buchen" role="form" action="' . DIR . 'kurse/buchen/1/" method="POST"><input type="submit" name="book" value="&#8635;"/><input type="hidden" name="kurs_id" value="' .$kurs['kurs_id'] . '"/><input type="hidden" name="csrf" value="' . Session::get('csrf_token') . '"/></form></div>' . "\n";
			echo '<div class="td"><form id="buchen" role="form" action="' . DIR . 'kurse/buchen/1/" method="POST"><input type="submit" name="delete" value="&#10006;"/><input type="hidden" name="kurs_id" value="' .$kurs['kurs_id'] . '"/><input type="hidden" name="csrf" value="' . Session::get('csrf_token') . '"/></form></div>' . "\n";
			echo '</div>' . "\n";
			//echo '<div id="bs_' . $kurs['kurs_id'] . '">'. $kurs['beschreibung'] . '</div>' . "\n"; 
		}
					
	?>
  </div>
</div>  
</div>
<script type="text/javascript" src="<?= URL::JAVA('table') ?>"></script>
