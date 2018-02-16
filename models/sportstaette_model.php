<?php

class Sportstaette_Model extends Model {
    
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * Gibt Anzahl zurueck, wie oft Adresse von Mitgliedern genutzt wird.
     * @return int Anzahl
     */
    public function countAdresseInMitglieder($data) {
        $row = $this->_db->select('SELECT COUNT(*) AS anzahl FROM mitglied WHERE adresse_id = :adresse_id', array('adresse_id' => $data['adresse_id']));
        return $row[0]['anzahl'];
    } 
       
    /**
     * Gibt Anzahl zurueck, wie oft Adresse von Sportstaetten genutzt wird.
     * @return int Anzahl
     */
    public function countAdresseInSportstaette($data) {
        $row = $this->_db->select('SELECT COUNT(*) AS anzahl FROM sportstaette WHERE adresse_id = :adresse_id', array('adresse_id' => $data['adresse_id']));
        return $row[0]['anzahl'];
    } 
    
    /**
     * Loescht Postleitzahl.
     * @return array der Reihen in Liste der Postleitzahlen
     */
    public function delAdresse($data) {
        return  $this->_db->delete('adresse', array('adresse_id' => $data['adresse_id']));
    }
    
    /**
     * Schreibt Adresse.
     * @param  array $data Daten für die Adresse:
     * Adress-ID, Strasse, Hausnummer, Postleitzahl als Fremdschlüssel
     * @return array Liste des Mitglieds
     */
    public function setAdresse($data) {
        $this->_db->insert('adresse', array('strasse' => $data['strasse'],
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
     * Update der Adresse.
     * @return int Anzahl der Reihen
     */
    public function updateAdresse($data) {
        return  $this->_db->update('adresse', array('strasse' =>  $data['strasse'], 'hausnummer' => $data['hausnummer'], 'postleitzahl' => $data['postleitzahl']), array('adresse_id' => $data['adresse_id']));
    }
    
    /**
     * Gibt Anzahl zurueck, wie oft Postleitzahl von Adresse genutzt wird.
     * @return int Anzahl
     */
    public function countPostleitzahlInAdresse($data) {
        $row = $this->_db->select('SELECT COUNT(*) AS anzahl FROM adresse WHERE postleitzahl = :postleitzahl', array('postleitzahl' => $data['postleitzahl']));
        return $row[0]['anzahl'];
    } 
    
    /**
     * Loescht Postleitzahl.
     * @return array der Reihen in Liste der Postleitzahlen
     */
    public function delPostleitzahl($data) {
        return  $this->_db->delete('postleitzahl', array('postleitzahl' => $data['postleitzahl']));
    }
    
    /**
     * Gibt Postleitzahl aus Adresse zurück.
     * @param  array $data Daten für die Postleitzahl mit Ort:
     * @return array Liste des Mitglieds
     */
    public function getPostleitzahl($data) {
        return $this->_db->select('SELECT postleitzahl FROM adresse WHERE adresse_id = :adresse_id',
            array('adresse_id' => $data['adresse_id']));
    }
    
    
    /**
     * Schreibt Postleitzahl mit Ort.
     * @param  array $data Daten für die Postleitzahl mit Ort:
     * @return array Liste des Mitglieds
     */
    public function setPostleitzahl($data) {
        $this->_db->insert('postleitzahl', array('postleitzahl' => $data['postleitzahl'], 'ort' => $data['ort']), 'postleitzahl = postleitzahl');
    }
    
    /**
     * Update der Adresse.
     * @return int Anzahl der Reihen
     */
    public function updatePostleitzahl($data) {
        return  $this->_db->update('postleitzahl', array('postleitzahl' =>  $data['postleitzahl'], 'ort' => $data['ort']), array('postleitzahl' => $data['plz_alt']));
    }
       
    /**
     * Setzt Sportstaette.
     * @param  array $data Daten der Sportstaette
     * @return string Id der letzten Sportstaette
     */
    public function setSportstaette($data) {
        return $this->_db->insert('sportstaette', array('bezeichnung' =>  $data['bezeichnung'], 'adresse_id' =>  $data['adresse_id'], 'sportart_id' =>  $data['sportart_id']));
    }
    
    /**
     * Gibt für alle Sportstaetten  + komplette Adresse zurück
     * @return array Liste mit ID in Form von array[0][daten],
     * Inner Join über Tabelle mitglied, adresse und postleitzahl
     */
    public function joinSportstaetten() {
        return $this->_db->select('SELECT sportstaette.*, adresse.strasse, adresse.hausnummer, adresse.postleitzahl, postleitzahl.ort FROM sportstaette JOIN adresse USING (adresse_id) JOIN postleitzahl USING (postleitzahl) ORDER BY sportstaette.bezeichnung');
    }
    
    /**
     * Update der Sportstaette.
     * @return int Anzahl der Reihen
     */
    public function updateSportstaette($data) {
        return  $this->_db->update('sportstaette', array('bezeichnung' =>  $data['bezeichnung'], 'adresse_id' =>  $data['adresse_id'], 'sportart_id' =>  $data['sportart_id']), array('sportstaette_id' => $data['sportstaette_id']));
    }
    
    /**
     * Loescht Sportstaette.
     * @return array der Reihen in Liste der Sportstaetten
     */
    public function delSportstaette($bezeichnung) {
        return  $this->_db->delete('sportstaette', array('bezeichnung' => $bezeichnung));
    }
    
    /**
     * Gibt letzte Sportstaette-ID zurück.
     * @param  array $data Daten der Sportstaette
     * @return array Liste mit ID in Form von array[0][daten]
     */
    public function getSportstaetteId($data) {
        return $this->_db->select('SELECT sportstaette_id from sportstaette WHERE bezeichnung = :bezeichnung', array('bezeichnung' =>  $data['bezeichnung']));
    }
    
    /**
     * Gibt letzte Adresse-ID zurück.
     * @param  array $data Daten der Sportstaette
     * @return array Liste mit ID in Form von array[0][daten]
     */
    public function getSportartId($data) {
        return $this->_db->select('SELECT sportart_id from sportarten WHERE sportart = :sportart', array('sportart' =>  $data['sportart']));
    }
}
