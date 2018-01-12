<?php

class URL {

    
   /**
   * Weiterleitung.
   */
   public static function redirect($url = null, $status) {
      header('Location: ' . DIR . $url, true, $status);
      exit;
   }

   /**
    * Stopp und Aufruf der Fehlerseite.
    */
   public static function halt($status = 404, $message = 'Etwas ist schief gelaufen.') {
      if (ob_get_level() !== 0) {
          ob_clean();
      }

      http_response_code($status);
      $data['status'] = $status;
      $data['message'] = $message;

      if (!file_exists("views/error/$status.php")) {
         $status = 'default';
      }
      require "views/error/$status.php";

      exit;
   }

   /**
    * Pfad der css-Datei.
    */
   public static function STYLES($filename = false, $path = 'static/css/') {
      if ($filename) {
         $path .= "$filename.css";
      }
      return DIR . $path;
   }
}

?>
