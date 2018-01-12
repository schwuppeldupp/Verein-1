<?php

class Mainpage_Model extends Model {
    
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * Gibt alle Vorstaende zurueck.
     * @return array Liste mit Vorstaenden
     */
    public function getVorstand() {
        return $this->_db->select('SELECT * FROM mitglied WHERE rang = :rang', array('rang' => 'vorstand'));
    }
    
}

?>
