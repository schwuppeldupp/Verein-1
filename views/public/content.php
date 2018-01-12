<div id="seiteninhalt-index">
<h2>Aktuelles</h2>
<h3>Vorstand</h3>
<?php 
foreach ($data['vorstand'] as $vorstand) {
    echo '<div>' . $vorstand['vorname'] . ' ' . $vorstand['nachname'] . '</div>';
}
    
?>
</div>
