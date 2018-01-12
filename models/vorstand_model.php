<?php

class Vorstand_Model extends Mitglied_Model {
    
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * Gibt einzelnen Vorstand zurück.
     * @param string $email e-mail des Vorstands
     * @return array Liste des Mitglieds
     */
    public function getVorstand($email) {
        return $this->_db->select('SELECT * FROM mitglied WHERE email = :email AND rang = :rang', array('email' =>  $email, 'rang' =>  'vorstand'));
    }
    
    /**
     * Gibt alle Vorstaende zurück.
     * @return array Liste der Vorstaende
     */
    public function getAllVorstaende() {
        return $this->_db->select('SELECT * FROM mitglied WHERE rang = :rang', array('rang' =>  'vorstand'));
    }
    
    /**
     * Aendert Mitglied zu Vorstand.
     * @return int Anzahl der geaenderten Eintraege
     */
    public function setVorstand($email) {
        return $this->_db->update('mitglied', array('rang' =>  'vorstand'), array('email' =>  $email));
    }
    
    /**
    * Aendert Vorstand zu Mitglied.
    * @return int Anzahl der geaenderten Eintraege
    */
    public function unsetVorstand($email) {
        return $this->_db->update('mitglied', array('rang' =>  'mitglied'), array('email' =>  $email));
    }
}

?>

