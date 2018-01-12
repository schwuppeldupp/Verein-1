<?php

class Buchung_Model extends Model {
    
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * Gibt einzelne Buchung zurück.
     * @param  array $data Daten des Mitglieds + Kurs-Id
     * @return array Liste Buchung des Mitglieds
     */
    public function getBuchung($data) {
        return $this->_db->select('SELECT * FROM buchungen WHERE mitglied_id = :mitglied_id', array('mitglied_id' =>  $data['mitglied_id'], 'kurs_id' =>  $data['kurs_id']));
    }
    
    /**
     * Gibt alle Buchungen zurück.
     * @param  array $data Daten des Mitglieds
     * @return array Liste Buchungen des Mitglieds
     */
    public function getBuchungen($data) {
        return $this->_db->select('SELECT * FROM buchungen WHERE mitglied_id = :mitglied_id', array('mitglied_id' =>  $data['mitglied_id']));
    }
    
    /**
    * Setzt Buchung.
    * @param  array $data Daten der Buchung
    * @return string Id der letzten Buchung
    */
    public function setBuchung($data) {
        return $this->_db->insert('buchungen', array('mitglied_id' =>  $data['mitglied_id'], 'kurs_id' =>  $data['kurs_id']));
    }
    
    /**
     * Löscht einzelne Buchung eines Mitglieds.
     * @param  array $data Daten der Buchung
     * @return int Anzahl der geloeschten Buchungen
     */
    public function deleteBuchung($data) {
        return $this->_db->delete('buchungen', array('mitglied_id' =>  $data['mitglied_id'], 'kurs_id' =>  $data['kurs_id']));
    }
    
    /**
     * Löscht alle Buchung eines Mitglieds.
     * @param  array $data Daten der Buchung
     * @param  int $limit Anzahl der zu loeschenden Buchung
     * @return int Anzahl der geloeschten Buchungen
     */
    public function deleteBuchung($data, $limit) {
        return $this->_db->delete('buchungen', array('mitglied_id' =>  $data['mitglied_id'], 'kurs_id' =>  $data['kurs_id']), $limit);
    }
    
}

?>
