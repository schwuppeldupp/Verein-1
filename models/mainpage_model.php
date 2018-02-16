<?php

class Mainpage_Model extends Model {
    
    public function __construct(){
        parent::__construct();
    }
             
    /**
     * Gibt einzelnes Mitglied anhand der mitglied_id zurück.
     * @param string $mitglied_id Id des Mitglieds
     * @return array Liste mit Daten des Mitglieds in Form von array[0][daten]
     */
    public function getKursleiter($mitglied_id) {
        return $this->_db->select('SELECT vorname, nachname FROM mitglied WHERE mitglied_id = :mitglied_id', array('mitglied_id' =>  $mitglied_id));
    }
    
    /**
     * Gibt einzelne Sportart anhand der sportart_id zurück.
     * @param string $sportart_id Id der Sportart
     * @return array Liste der Sportart
     */
    public function getSportart($sportart_id) {
        return $this->_db->select('SELECT sportart FROM sportarten WHERE sportart_id = :sportart_id', array('sportart_id' => $sportart_id));
    }
    
    /**
     * Gibt alle Kurse zurück + Kursleiter + Sportart zurück.
     * @return array Liste der Kurse
     */
    public function getKurse() {       
        return $this->_db->select('SELECT mitglied.vorname, mitglied.nachname, sportarten.sportart, sportstaette.bezeichnung, kurse.* FROM kurse JOIN sportarten USING (sportart_id) JOIN sportstaette USING (sportstaette_id) JOIN mitglied USING (mitglied_id)');
    }
    
    /**
     * Gibt alle Kurse fuer eine Sportart zurueck.
     * @return array Liste mit allen Eintraegen für Sportart
     */
    public function getKurseBySportart($sportart_id) {     
        return $this->_db->select('SELECT mitglied.vorname, mitglied.nachname, sportarten.sportart, sportstaette.bezeichnung, kurse.* FROM kurse JOIN sportarten USING (sportart_id) JOIN sportstaette USING (sportart_id) JOIN mitglied USING (mitglied_id) WHERE sportart_id = :sportart_id', array('sportart_id' => $sportart_id));
    }
}

?>
