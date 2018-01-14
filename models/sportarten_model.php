<?php

class Sportarten_Model extends Model {
    
    public function __construct(){
        parent::__construct();
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
     * Setzt Sportart.
     * @return int Index des letzten Eintrags
     */
    public function setSportart($sportart, $beschreibung) {
        return  $this->_db->insert('sportarten', array('sportart' => $sportart, 'beschreibung' => $beschreibung));
    }
    
    /**
     * Update Beschreibung der Sportart.
     * @return int Anzahl der Reihen
     */
    public function updateSportart($sportart, $beschreibung) {
        return  $this->_db->update('sportarten', array('beschreibung' => $beschreibung), array('sportart' => $sportart));
        //return  $this->_db->update('sportarten', array('sportart' => $sportart, 'beschreibung' => $beschreibung), array('sportart_id' => $sportart_id));
    }
    
    /**
     * Change Name und Beschreibung der Sportart.
     * @return int Anzahl der Reihen
     */
    public function changeSportart($sportart_id, $sportart, $beschreibung) {
        return  $this->_db->update('sportarten', array('sportart' => $sportart, 'beschreibung' => $beschreibung), array('sportart_id' => $sportart_id));
    }
    
    /**
     * Loescht Sportart.
     * @return array Anzahl der Reihen in Liste der Sportart
     */
    public function delSportart($sportart) {
        return  $this->_db->delete('sportarten', array('sportart' => $sportart));
    }
}

?>

