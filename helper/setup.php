<html>
<head>
<title>Setup Database</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>
<body>
<?php
if(isset($_POST['user']) && isset($_POST['db']) && isset($_POST['pw']) && isset($_POST['pwAdmin1']) && isset($_POST['pwAdmin2'])) {
    if($_POST['user'] != "" && $_POST['db'] != "" && $_POST['pwAdmin1'] != "" && $_POST['pwAdmin2'] != "") {
        
            include ("password.php");
            $check = new Password();
            $pwAdmin = $check->hash($_POST['pwAdmin1']);
            if(!$check->verify($_POST['pwAdmin2'], $pwAdmin)) {
                echo "Admin password does not match.";
                exit();
            }

		    $user = $_POST['user'];
		    $db = $_POST['db'];
		    $pw = $_POST['pw'];
		    $type = $_POST['type'] != "" ? $_POST['type'] : "mysql";
		    $host = $_POST['host'] != "" ? $_POST['host'] : "localhost";
		    
		    $title = $_POST['title'] != "" ? $_POST['title'] : "Verein";
		    $dir = $_POST['dir'] != "" ? $_POST['dir'] : "http://localhost/Verein/";
		    $prefix = $_POST['prefix'] != "" ? $_POST['prefix'] . "_" : "sport_";
		    $zone = $_POST['zone'] != "" ? $_POST['zone'] : "Europe/Berlin";
		    
		    try{
		        $pdo = new PDO("$type:host=$host;dbname=$db", $user, $pw);
		        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		        
		        $statement = $pdo->prepare("SELECT * FROM mitglied WHERE email = :email LIMIT 1");
		        $result = $statement->execute(array('email' => 'admin'));
		        $userdata = $statement->fetch();
		        
		        if($userdata !== false && !$check->verify($_POST['pwAdmin1'], $userdata['passwort'])) {
		            echo "No permission connect to MySQL.";
		            exit();
		        }
		        elseif ($userdata !== false && $check->verify($_POST['pwAdmin1'], $userdata['passwort'])) {
		            $pdo = null;
		            $file = "../config.ini";
		            $handle = fopen($file, 'w') or die('Cannot open file: '. $file);
		            fwrite($handle, "[settings]" . "\n");
		            fwrite($handle, 'title = "' . $title . '"' . "\n");
		            fwrite($handle, 'css = "' . 'styles' . '"' . "\n");
		            fwrite($handle, 'enviroment = "' . 'development' . '"' . "\n");
		            fwrite($handle, 'dir = "' . $dir . '"' . "\n");
		            fwrite($handle, 'prefix = "' . $prefix . '"' . "\n");
		            
		            fwrite($handle, "[database]" . "\n");
		            fwrite($handle, 'type = "' . $type . '"' . "\n");
		            fwrite($handle, 'host = "' . $host . '"' . "\n");
		            fwrite($handle, 'user = "' . $user . '"' . "\n");
		            fwrite($handle, 'dbname = "' . $db . '"' . "\n");
		            fwrite($handle, 'password = "' . $pw . '"' . "\n");
		            
		            fwrite($handle, "[timezone]" . "\n");
		            fwrite($handle, 'zone = "' . $zone . '"' . "\n");
		            
		            fclose($handle);
		            
		            header('Location: ../index.php');
		            exit();
		        }
		        //$pdo = null;
		    }
		    catch(PDOException $e){
		        //echo "Failed to connect to MySQL: " . $e;
		        //exit();
		    }
		    	    
		    try{
		        $pdo = new PDO("$type:host=$host;charset=utf8", $user, $pw);
		        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		    }
		    catch(PDOException $e){ 
		        echo "Failed to connect to MySQL: " . $e;
		        exit();
		    }
		    
		    try {
		        $sql = "CREATE DATABASE IF NOT EXISTS $db CHARACTER SET utf8 COLLATE utf8_unicode_ci";
		        $pdo->exec($sql);
		        $pdo = null;
		    }
		    catch(PDOException $e) {
		        echo "Failed to create Database to MySQL: " . $e;
		        exit();
		    }
		    
		    try{
		        $pdo = new PDO("$type:host=$host;dbname=$db", $user, $pw);
		        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		        
		        include ("tables.php");
		        createTable($pdo, Tables::getMitglied());
		        createTable($pdo, Tables::getAdresse());
		        createTable($pdo, Tables::getPostleitzahl());
		        createTable($pdo, Tables::getSportarten());
		        createTable($pdo, Tables::getSportstaette());
		        createTable($pdo, Tables::getKurse());
		        createTable($pdo, Tables::getBuchungen());
		        
		        $statement = $pdo->prepare("INSERT INTO mitglied (email, passwort, vorname, nachname, geburtsdatum, adresse_id, telefon, rang) VALUES (:email, :passwort, :vorname, :nachname, :geburtsdatum, :adresse_id, :telefon, :rang)");
		        $statement->execute(array('email' => 'admin', 'passwort' => $pwAdmin, 'vorname' => 'admin', 'nachname' => 'admin', 'geburtsdatum' => '1900-01-01', 'adresse_id' => 0, 'telefon' => '', 'rang' => 'admin'));
		        
		        $pdo = null;
		    }
		    catch(PDOException $e){
		        echo "Failed to create tables: " . $e;
		        exit();
		    }
		    		    
		    $file = "../config.ini";
		    $handle = fopen($file, 'w') or die('Cannot open file: '. $file);
		    fwrite($handle, "[settings]" . "\n");
		    fwrite($handle, 'title = "' . $title . '"' . "\n");
		    fwrite($handle, 'css = "' . 'styles' . '"' . "\n");
		    fwrite($handle, 'enviroment = "' . 'development' . '"' . "\n");
		    fwrite($handle, 'dir = "' . $dir . '"' . "\n");
		    fwrite($handle, 'prefix = "' . $prefix . '"' . "\n");
 
		    fwrite($handle, "[database]" . "\n");
		    fwrite($handle, 'type = "' . $type . '"' . "\n");
		    fwrite($handle, 'host = "' . $host . '"' . "\n");
		    fwrite($handle, 'user = "' . $user . '"' . "\n");
		    fwrite($handle, 'dbname = "' . $db . '"' . "\n");
		    fwrite($handle, 'password = "' . $pw . '"' . "\n");
		    
		    fwrite($handle, "[timezone]" . "\n");
		    fwrite($handle, 'zone = "' . $zone . '"' . "\n");
		    
		    fclose($handle);
		    
		    header('Location: ../index.php');
		    exit();
		}		
	}
	
	function createTable($pdo, $sql){
	    try {
	        $pdo->exec($sql);
	    }
	    catch(PDOException $e) {
	        echo "Failed to create table: " . $e;
	        exit();
	    }
	}		
?>
<form action="setup.php" method="POST">
	<table style="margin-left: 105px;">
	<tr>
	<td style="text-align: right;">SQL User</td>
	<td><input type="text" name="user" placeholder="Benutzername" style="width: 200px;"></td>
	</tr>
	<tr>
	<td style="text-align: right;">SQL DB</td>
	<td><input type="text" name="db" placeholder="Datenbankname" style="width: 200px;"></td>
	</tr>
	<tr>
	<td style="text-align: right;">Passwort</td>
	<td><input type="password" name="pw" placeholder="Passwort" style="width: 200px;"></td>
	</tr>
	<tr>
	<td style="text-align: right;">Datenbanktyp</td>
	<td><input type="text" name="type" placeholder="mysql" style="width: 200px;"></td>
	</tr>
	<tr>
	<td style="text-align: right;">Host</td>
	<td><input type="text" name="host" placeholder="localhost" style="width: 200px;"></td>
	</tr>
	</table>
	<table style="margin-left: 23px;">
	<tr>
	<td style="text-align: right;">Titel der Seite</td>
	<td><input type="text" name="title" placeholder="Mein Verein" style="width: 200px;"></td>
	</tr>
	<tr>
	<td style="text-align: right;">Vezeichnis auf dem Server</td>
	<td><input type="text" name="dir" placeholder="http://localhost/yourFolder/" style="width: 200px;"></td>
	</tr>
	<tr>
	<td style="text-align: right;">Prefix f&uuml;r Sessoins</td>
	<td><input type="text" name="prefix"  placeholder="Verein" style="width: 200px;"></td>
	</tr>
	</table>
	<table style="margin-left: 137px;">
	<tr>
	<td style="text-align: right;">Zeitzone</td>
	<td><input type="text" name="zone" placeholder="Europe/Berlin" style="width: 200px;"></td>
	</tr>
	</table>
	<table style="margin-left: 10px;">
	<tr>
	<td style="text-align: right;">Adminpasswort</td>
	<td><input type="password" name="pwAdmin1" placeholder="Passwort" style="width: 200px;"></td>
	</tr>
	<tr>
	<td style="text-align: right;">Adminpasswort wiederholen</td>
	<td><input type="password" name="pwAdmin2" placeholder="Passwort wiederholen" style="width: 200px;"></td>
	</tr>
	</table>
	<table style="margin-left: 230px;">
	<tr>
	<td><input type="submit" value="Erstellen"></td>
	</tr>
	</table>
</form>
</body>
</html>
	