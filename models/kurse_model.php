<?php

class Kurse_Model extends Model {
    
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * Setzt Buchung.
     * @param  array $data Daten der Buchung
     * @return string Id der letztenBuchung
     */
    public function setBuchung($data) {
        return $this->_db->insert('buchungen', array('mitglied_id' =>  $data['mitglied_id'], 'kurs_id' =>  $data['kurs_id']));
    }
    
    /**
     * Gibt Buchungs-ID zurück.
     * @param  array $data Daten ueber Buchung des Mitglieds
     * @return array Liste mit ID in Form von array[0][daten]
     */
    public function getBuchungsId($data) {
        return $this->_db->select('SELECT buchungs_id from buchungen WHERE mitglied_id = :mitglied_id AND kurs_id = :kurs_id', array('mitglied_id' =>  $data['mitglied_id'], 'kurs_id' =>  $data['kurs_id']));
    }
    
    /**
     * Loescht Buchung.
     * @param  array $data Daten der Buchung
     * @return int Anzahl der Buchungen
     */
    public function delBuchung($data) {
        return  $this->_db->delete('buchungen', array('buchungs_id' => $data['buchungs_id']));
    }
    
    /**
     * Gibt Kurs zurück.
     * @return array Liste des Kurses
     */
    public function getKurs() {
        return $this->_db->select('SELECT * FROM kurse WHERE kursname = :kursname', array('kursname' =>  $data['kursname']));
    }
       
    /**
     * Setzt Kurs.
     * @param  array $data Daten des Kurses
     * @return string Id des letzten Kurses
     */
    public function setKurs($data) {
        return $this->_db->insert('kurse', array('kursname' =>  $data['kursname'], 'maxteilnehmer' =>  $data['maxteilnehmer'], 'mitglied_id' =>  $data['mitglied_id'], 'sportart_id' =>  $data['sportart_id'], 'beginn' =>  $data['beginn'], 'ende' =>  $data['ende'], 'beschreibung' =>  $data['beschreibung'], 'sportstaette_id' =>  $data['sportstaette_id']));
    }
      
    /**
     * Update des Kurses.
     * @return int Anzahl der Reihen
     */
    public function updateKurs($data) {
        return  $this->_db->update('kurse', array('kursname' =>  $data['kursname'], 'maxteilnehmer' =>  $data['maxteilnehmer'], 'mitglied_id' =>  $data['mitglied_id'], 'sportart_id' =>  $data['sportart_id'], 'beginn' =>  $data['beginn'], 'ende' =>  $data['ende'], 'beschreibung' =>  $data['beschreibung'], 'sportstaette_id' =>  $data['sportstaette_id']), array('kurs_id' => $data['kurs_id']));
    }
    
    /**
     * Loescht Kurs.
     * @return int Anzahl der Kurse
     */
    public function delKurs($kursname) {
        return  $this->_db->delete('kurse', array('kursname' => $kursname));
    }
    
    /**
     * Gibt letzte Sportart-ID zurück.
     * @param  array $data Daten des Mitglieds
     * @return array Liste mit ID in Form von array[0][daten]
     */
    public function getSportartId($data) {
        return $this->_db->select('SELECT sportart_id from sportarten WHERE sportart = :sportart', array('sportart' =>  $data['sportart']));
    }
    
    /**
     * Gibt letzte Sportstaette-ID zurück.
     * @param  array $data Daten des Mitglieds
     * @return array Liste mit ID in Form von array[0][daten]
     */
    public function getSportstaetteId($data) {
        return $this->_db->select('SELECT sportstaette_id from sportstaette WHERE bezeichnung = :bezeichnung', array('bezeichnung' =>  $data['bezeichnung']));
    }
}
