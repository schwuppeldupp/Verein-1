<?php
$startpage = "mainpage";
$config = parse_ini_file("config.ini", TRUE);

if($config != false) {
    // Zeitzone setzen
    date_default_timezone_set($config["timezone"]["zone"]);
    
    // Umgebungsvariablen
    define('ENVIRONMENT', $config["settings"]["enviroment"]);
    define('DIR', $config["settings"]["dir"]);
    define('DOCROOT', dirname(__FILE__));
    
    // Referenzen für den lokalen Server
    define('DB_TYPE', $config["database"]["type"]);
    define('DB_HOST', $config["database"]["host"]);
    define('DB_NAME', $config["database"]["dbname"]);
    define('DB_USER', $config["database"]["user"]);
    define('DB_PASS', $config["database"]["password"]);
    
    define('SITETITLE', $config["settings"]["title"]);
    define('SESSION_PREFIX', $config["settings"]["prefix"]);
    define('CSS', $config["settings"]["css"]);

    /*if($config["database"]["isset"] == false) {
        $config["database"]["isset"] = true;
        write_php_ini($config, "config.ini");
        echo '<div><a href="database/create.php">Datenbank erstellen</a></div>';
        //die(header("Location: mainpage.php?csrf=" . $_SESSION['csrf_token'])); 
        die();
    }*/
}
else {
    header('Location: helper/setup.php');
    die();
}

if (defined('ENVIRONMENT')) {
    switch (ENVIRONMENT) {
        case 'development':
            error_reporting(E_ALL);
            break;
        case 'production':
            error_reporting(0);
            break;
        default:
            exit('The application environment is not set correctly.');
    }
}

//Automatisches Nachladen von Klassen
spl_autoload_register("autoloadsystem");
//Installiert einen benutzerdefinierten Exceptionhandler 
set_exception_handler('logger::exception_handler');
//Bestimmt eine benutzerdefinierte Funktion zur Fehlerbehandlung
set_error_handler('logger::error_handler');

/**
 * autoloadsystem method
 * @param  string $class class name
 */
function autoloadsystem($class) {
    $filename = DOCROOT . "/core/" . strtolower($class) . ".php";
    if (file_exists($filename)) {
        require $filename;
    }
    
    $filename = DOCROOT . "/helper/" . strtolower($class) . ".php";
    if (file_exists($filename)) {
        require $filename;
    }
}

/**
 * write_php_ini method prepare ini file for write
 * @param  array $array array of settings
 * @param  string $file name for ini file
 */
function write_php_ini($array, $file) {
    $res = array();
    foreach($array as $key => $val)
    {
        if(is_array($val))
        {
            $res[] = "[$key]";
            foreach($val as $skey => $sval) $res[] = "$skey = ".(is_numeric($sval) ? $sval : '"'.$sval.'"');
        }
        else $res[] = "$key = ".(is_numeric($val) ? $val : '"'.$val.'"');
    }
    safefilerewrite($file, implode("\r\n", $res));
}

/**
 * write_php_ini method write ini file
 * @param  string $fileName name for ini file
 * @param  array $dataToSave array of settings
 */
function safefilerewrite($fileName, $dataToSave) {   
    if ($fp = fopen($fileName, 'w')) {

         $startTime = microtime(TRUE);
         do {
             $canWrite = flock($fp, LOCK_EX);
             // If lock not obtained sleep for 0 - 100 milliseconds, to avoid collision and CPU load
             if(!$canWrite) usleep(round(rand(0, 100)*1000));
         } while ((!$canWrite)and((microtime(TRUE)-$startTime) < 5));
    
        //file was locked so now we can store information
        if ($canWrite) {
            fwrite($fp, $dataToSave);
            flock($fp, LOCK_UN);
        }
        fclose($fp);
    }
}

?> 