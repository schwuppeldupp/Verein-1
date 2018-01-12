<?php

// Ausgabepufferung aktivieren
ob_start();

// include config data
require('config.php');

$app = new Loader();
$app->setController($startpage);
$app->init();

// Leert (sendet) den Ausgabepuffer 
ob_flush();

?> 