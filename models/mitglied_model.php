<?php

class Mitglied_Model extends Model {
    
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * Gibt Admin zurück.
     * @param string Anmeldename des Admins
     * @return array Liste mit Daten des Admins
     */
    public function checkAdmin() {
        //return $this->_db->select('SELECT * FROM mitglied WHERE email = :email AND nachname = :nachname AND vorname = :vorname AND rang = :rang', array('email' =>  $email, 'nachname' => 'admin', 'vorname' => 'admin', 'rang' => 'admin'));
        return $this->_db->select('SELECT * FROM mitglied WHERE email = :email AND rang = :rang', array('email' => 'admin', 'rang' => 'admin'));
    }
    
    /**
     * Gibt einzelnes Mitglied zurück.
     * @param string $email e-mail des Mitglieds
     * @return array Liste mit Daten des Mitglieds
     */
    public function checkEmail($email) {
        return $this->_db->select('SELECT * FROM mitglied WHERE email = :email', array('email' =>  $email));
    }
    
    /**
     * Schreibt Daten fuer einzelnes Mitglied.
     * @param  array $data Daten des Mitglieds + Rang
     * @return array Liste des Mitglieds
     */
    public function setRegistration($data) {      
        $this->_db->insert('mitglied', array('email' => $data['email'], 'passwort' => $data['passwort'],
            'vorname' => $data['vorname'], 'nachname' => $data['nachname'],
            'geburtsdatum' => $data['geburtsdatum'], 'adresse_id' => 1,
            'telefon' => $data['telefon'], 'rang' => $data['rang'] ));
    }
    
}

?>
