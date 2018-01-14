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
        return $this->_db->select('SELECT * FROM mitglied WHERE mitglied_id = :mitglied_id', array('mitglied_id' =>  $mitglied_id));
    }
    
    /**
     * Gibt einzelne Sportart anhand der sportart_id zurück.
     * @param string $sportart_id Id der Sportart
     * @return array Liste der Sportart
     */
    public function getSportart($sportart_id) {
        return $this->_db->select('SELECT sportart FROM sportarten WHERE sportart_id = :sportart_id', array('sportart_id' => $sportart_id));
    }
}

?>
