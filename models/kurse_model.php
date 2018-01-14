<?php

class Kurse_Model extends Model {
    
    public function __construct(){
        parent::__construct();
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
        return $this->_db->insert('kurse', array('kursname' =>  $data['kursname'], 'maxteilnehmer' =>  $data['maxteilnehmer'], 'mitglied_id' =>  $data['mitglied_id'], 'sportart_id' =>  $data['sportart_id'], 'beginn' =>  $data['beginn'], 'ende' =>  $data['ende'], 'beschreibung' =>  $data['beschreibung']));
    }
      
    /**
     * Update des Kurses.
     * @return int Anzahl der Reihen
     */
    public function updateKurs($data) {
        return  $this->_db->update('kurse', array('kursname' =>  $data['kursname'], 'maxteilnehmer' =>  $data['maxteilnehmer'], 'mitglied_id' =>  $data['mitglied_id'], 'sportart_id' =>  $data['sportart_id'], 'beginn' =>  $data['beginn'], 'ende' =>  $data['ende'], 'beschreibung' =>  $data['beschreibung']), array('kurs_id' => $data['kurs_id']));
    }
    
    /**
     * Loescht Kurs.
     * @return array der Reihen in Liste der Kurse
     */
    public function delKurs($kursname) {
        return  $this->_db->delete('kurse', array('kursname' => $kursname));
    }
    
    /**
     * Gibt letzte Adresse-ID zurück.
     * @param  array $data Daten des Mitglieds
     * @return array Liste mit ID in Form von array[0][daten]
     */
    public function getSportartId($data) {
        return $this->_db->select('SELECT sportart_id from sportarten WHERE sportart = :sportart', array('sportart' =>  $data['sportart']));
    }
}
