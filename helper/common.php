<?php

class Common extends Model {
    
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * Gibt für alle Mitglieder alle Daten + komplette Adresse zurück
     * @return array Liste mit ID in Form von array[0][daten],
     * Inner Join über Tabelle mitglied, adresse und postleitzahl
     */
    public function joinMitglieder() {
        return $this->_db->select('SELECT mitglied.*, adresse.strasse, adresse.hausnummer, adresse.postleitzahl, postleitzahl.ort FROM mitglied JOIN adresse USING (adresse_id) JOIN postleitzahl USING (postleitzahl) ORDER BY mitglied.nachname');
    }
    
    /**
     * Gibt alle Vorstaende zurueck.
     * @return array Liste mit Vorstaenden
     */
    public function getVorstand() {
        return $this->_db->select('SELECT * FROM mitglied WHERE rang = :rang', array('rang' => 'vorstand'));
    }
    
    /**
     * Gibt alle Sportarten zurueck.
     * @return array Liste mit Sportarten
     */
    public function getSportarten() {
        return $this->_db->select('SELECT * FROM sportarten ORDER BY sportart ASC');
    }
    
    /**
     * Gibt alle Kurse zurück.
     * @return array Liste der Kurse
     */
    public function getKurse() {
        return $this->_db->select('SELECT * FROM kurse ORDER BY kursname ASC');
    }
}

?>

