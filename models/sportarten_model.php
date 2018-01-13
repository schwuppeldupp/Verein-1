<?php

class Sportarten_Model extends Model {
    
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
     * Gibt für alle Mitglieder alle Daten + komplette Adresse zurück
     * @return array Liste mit ID in Form von array[0][daten],
     * Inner Join über Tabelle mitglied, adresse und postleitzahl
     */
    public function joinMitglieder() {
        return $this->_db->select('SELECT mitglied.*, adresse.strasse, adresse.hausnummer, adresse.postleitzahl, postleitzahl.ort FROM mitglied JOIN adresse USING (adresse_id) JOIN postleitzahl USING (postleitzahl)',
            array('email' => $data['email']));
    }
    
    /**
     * Gibt einzelne Sportart zurück.
     * @param string $sportart Name der Sportart
     * @return array Liste der Sportart
     */
    public function getSportart($sportart) {
        return $this->_db->select('SELECT * FROM sportarten WHERE sportart = :sportart', array('sportart' => $sportart));
    }
    
    /**
     * Gibt alle Sportarten zurück.
     * @return array Liste der Sportarten
     */
    public function getSportarten() {
        return $this->_db->select('SELECT * FROM sportarten ORDER BY sportart ASC');
    }
    
    /**
     * Setzt Sportart.
     * @return int Index des letzten Eintrags
     */
    public function setSportart($sportart, $beschreibung) {
        return  $this->_db->insert('sportarten', array('sportart' => $sportart, 'beschreibung' => $beschreibung));
    }
    
    /**
     * Update Sportart.
     * @return int Anzahl der Reihen
     */
    public function updateSportart($sportart, $beschreibung) {
        return  $this->_db->update('sportarten', array('beschreibung' => $beschreibung), array('sportart' => $sportart));
    }
    
    /**
     * Loescht Sportart.
     * @return array Liste der Sportart
     */
    public function delSportart($sportart) {
        return  $this->_db->delete('sportarten', array('sportart' => $sportart));
    }
}

?>

