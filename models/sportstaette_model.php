<?php

class Sportstaette_Model extends Model {
    
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * Schreibt Adresse.
     * @param  array $data Daten für die Adresse:
     * Adress-ID, Strasse, Hausnummer, Postleitzahl als Fremdschlüssel
     * @return array Liste der Sportstaette
     */
    public function setAdresse($data) {
        $this->_db->insert('adresse', array('adresse_id' => $data['adresse_id'], 'strasse' => $data['strasse'],
            'hausnummer' => $data['hausnummer'], 'postleitzahl' => $data['postleitzahl']));
    }
    
    /**
     * Gibt Adresse zurück, wenn Strasse Hausnummer und Postleitzahl übereinstimmen.
     * @param  array $data Daten der Sportstaette
     * @return array Liste mit ID in Form von array[0][daten]
     */
    public function getAdresse($data) {
        return $this->_db->select('SELECT * FROM adresse WHERE strasse = :strasse AND hausnummer = :hausnummer AND postleitzahl = :postleitzahl',
            array('strasse' =>  $data['strasse'], 'hausnummer' => $data['hausnummer'], 'postleitzahl' => $data['postleitzahl']));
    }
    
    /**
     * Gibt letzte Adresse-ID zurück.
     * @param  array $data Daten der Sportstaette
     * @return array Liste mit ID in Form von array[0][daten]
     */
    public function getAdresseId($data) {
        return $this->_db->select('SELECT adresse_id from adresse ORDER BY adresse_id DESC LIMIT 1');
    }
    
    /**
     * Schreibt Postleitzahl mit Ort.
     * @param  array $data Daten für die Postleitzahl mit Ort:
     * @return array Liste der Sportstaette
     */
    public function setPostleitzahl($data) {
        $this->_db->insert('postleitzahl', array('postleitzahl' => $data['postleitzahl'], 'ort' => $data['ort']), 'postleitzahl');
    }
    
    /**
     * Gibt für eine Sportstaette alle Daten + komplette Adresse zurück
     * @param  array $data bezeichnung der Sportstaette
     * @return array Liste mit ID in Form von array[0][daten],
     * Inner Join über Tabelle sportstaette, adresse und postleitzahl
     */
    public function joinMitglied($data) {
        return $this->_db->select('SELECT sportstaette.*, adresse.strasse, adresse.hausnummer, adresse.postleitzahl, postleitzahl.ort FROM sportstaette JOIN adresse USING (adresse_id) JOIN postleitzahl USING (postleitzahl) WHERE bezeichnung = :bezeichnung',
            array('email' => $data['email']));
    }
    
    /**
     * Gibt für alle Sportstaette alle Daten + komplette Adresse nach Bezeichnung sortiert zurück
     * @return array Liste mit ID in Form von array[0][daten],
     * Inner Join über Tabelle sportstaette, adresse und postleitzahl
     */
    public function joinMitglieder() {
        return $this->_db->select('SELECT sportstaette.*, adresse.strasse, adresse.hausnummer, adresse.postleitzahl, postleitzahl.ort FROM sportstaette JOIN adresse USING (adresse_id) JOIN postleitzahl USING (postleitzahl) ORDER BY sportstaette.bezeichnung',
            array('email' => $data['email']));
    }
}
