<?php

class Admin_Model extends Model {
    
    public function __construct(){
        parent::__construct();
    }
   
    /**
     * Gibt einzelnes Mitglied anhand der id zurück.
     * @param string $id id des Mitglieds
     * @return array Liste mit Daten des Mitglieds in Form von array[0][daten]
     */
    public function getMitglied($id) {
        return $this->_db->select('SELECT * FROM mitglied WHERE mitglied_id = :mitglied_id', array('mitglied_id' =>  $id));
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
     * Aendert Mitglied zu Vorstand.
     * @return int Anzahl der geaenderten Eintraege
     */
    public function setVorstand($email) {
        return $this->_db->update('mitglied', array('rang' => 'vorstand'), array('email' => $email));
    }
    
    /**
     * Aendert Vorstand zu Mitglied.
     * @return int Anzahl der geaenderten Eintraege
     */
    public function unsetVorstand($email) {
        return $this->_db->update('mitglied', array('rang' =>  'mitglied'), array('email' =>  $email));
    }
}
