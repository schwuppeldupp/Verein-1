<?php

class Mitglied_Model extends Model {
    
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * Gibt Admin anhand der e-mail zurück.
     * @param string Anmeldename des Admins
     * @return array Liste mit Daten des Admins
     */
    public function checkAdmin() {
        //return $this->_db->select('SELECT * FROM mitglied WHERE email = :email AND nachname = :nachname AND vorname = :vorname AND rang = :rang', array('email' =>  $email, 'nachname' => 'admin', 'vorname' => 'admin', 'rang' => 'admin'));
        return $this->_db->select('SELECT * FROM mitglied WHERE email = :email AND rang = :rang', array('email' => 'admin', 'rang' => 'admin'));
    }
    
    /**
     * Gibt einzelnes Mitglied anhand der e-mail zurück.
     * @param string $email e-mail des Mitglieds
     * @return array Liste mit Daten des Mitglieds in Form von array[0][daten]
     */
    public function checkEmail($email) {
        return $this->_db->select('SELECT * FROM mitglied WHERE email = :email', array('email' =>  $email));
    }
    
    /**
     * Schreibt Daten fuer einzelnes Mitglied.
     * @param  array $data Daten des Mitglieds + Rang, 
     * e-mail, passwort als hash, Vorname, Nachname, Geburtsdatum, Adress-ID als Fremdschlüssel für Adresse, Telefonnummer, Rang
     * @return array Liste des Mitglieds
     */
    public function setRegistration($data) {      
        $this->_db->insert('mitglied', array('email' => $data['email'], 'passwort' => $data['passwort'],
            'vorname' => $data['vorname'], 'nachname' => $data['nachname'],
            'geburtsdatum' => $data['geburtsdatum'], 'adresse_id' => $data['adresse_id'],
            'telefon' => $data['telefon'], 'rang' => $data['rang'] ));
    }
    
    /**
     * Gibt für ein Mitglied alle Daten + komplette Adresse zurück
     * @param  array $data e-mail des Mitglieds
     * @return array Liste mit ID in Form von array[0][daten], 
     * Inner Join über Tabelle mitglied, adresse und postleitzahl
     */
    public function joinMitglied($data) {
        return $this->_db->select('SELECT mitglied.*, adresse.strasse, adresse.hausnummer, adresse.postleitzahl, postleitzahl.ort FROM mitglied JOIN adresse USING (adresse_id) JOIN postleitzahl USING (postleitzahl) WHERE email = :email',
            array('email' => $data['email']));
    }
        
    /**
     * Gibt für alle Mitglieder alle Daten + komplette Adresse nach Nachnamen sortiert zurück
     * @return array Liste mit ID in Form von array[0][daten], 
     * Inner Join über Tabelle mitglied, adresse und postleitzahl
     */
    public function joinMitglieder() {
        return $this->_db->select('SELECT mitglied.*, adresse.strasse, adresse.hausnummer, adresse.postleitzahl, postleitzahl.ort FROM mitglied JOIN adresse USING (adresse_id) JOIN postleitzahl USING (postleitzahl) ORDER BY mitglied.nachname',
            array('email' => $data['email']));
    }
    
    /**
     * Schreibt Adresse.
     * @param  array $data Daten für die Adresse: 
     * Adress-ID, Strasse, Hausnummer, Postleitzahl als Fremdschlüssel
     * @return array Liste des Mitglieds
     */
    public function setAdresse($data) {
        $this->_db->insert('adresse', array('adresse_id' => $data['adresse_id'], 'strasse' => $data['strasse'],
            'hausnummer' => $data['hausnummer'], 'postleitzahl' => $data['postleitzahl']));
    }
    
    /**
     * Gibt Adresse zurück, wenn Strasse Hausnummer und Postleitzahl übereinstimmen.
     * @param  array $data Daten des Mitglieds
     * @return array Liste mit ID in Form von array[0][daten]
     */
    public function getAdresse($data) {
        return $this->_db->select('SELECT * FROM adresse WHERE strasse = :strasse AND hausnummer = :hausnummer AND postleitzahl = :postleitzahl',
            array('strasse' =>  $data['strasse'], 'hausnummer' => $data['hausnummer'], 'postleitzahl' => $data['postleitzahl']));
    }

    /**
     * Gibt letzte Adresse-ID zurück.
     * @param  array $data Daten des Mitglieds
     * @return array Liste mit ID in Form von array[0][daten]
     */
    public function getAdresseId($data) {
        return $this->_db->select('SELECT adresse_id from adresse ORDER BY adresse_id DESC LIMIT 1');
    }
    
    /**
     * Schreibt Postleitzahl mit Ort.
     * @param  array $data Daten für die Postleitzahl mit Ort:
     * @return array Liste des Mitglieds
     */
    public function setPostleitzahl($data) {
        $this->_db->insert('postleitzahl', array('postleitzahl' => $data['postleitzahl'], 'ort' => $data['ort']), 'postleitzahl');
    }
    
    /**
     * Gibt alle Vorstaende zurueck.
     * @return array Liste mit Vorstaenden
     */
    public function getVorstand() {
        return $this->_db->select('SELECT * FROM mitglied WHERE rang = :rang', array('rang' => 'vorstand'));
    }
    
    /**
     * Gibt alle Vorstaende zurück.
     * @return array Liste der Vorstaende
     */
    public function getAllVorstaende() {
        return $this->_db->select('SELECT * FROM mitglied WHERE rang = :rang', array('rang' =>  'vorstand'));
    }
    
    /**
     * Gibt alle Sportarten zurueck.
     * @return array Liste mit Sportarten
     */
    public function getSportarten() {
        return $this->_db->select('SELECT * FROM sportarten ORDER BY sportart ASC');
    }
    
}

?>
