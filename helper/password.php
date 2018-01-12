<?php

class Password {
    private $timeTarget;
    private $cost;
    
    public function __construct() {
        $this->timeTarget = 0.2;
        $this->cost = 9;
        //$this->calculateCosts();
    }
    
    public function hash($password) {
        $this->calculateCosts($password);
        return password_hash($password, PASSWORD_BCRYPT, ["cost" => $this->cost]);
    }
    
    public function verify($password, $hash) {
        return password_verify($password, $hash);
    }
    
    public function getCosts($password) {
        
        $this->calculateKosten($password);
        return $this->cost;
    }
    
    private function calculateCosts($password) {
        do {
            $this->cost++;
            $start = microtime(true);
            password_hash($password, PASSWORD_BCRYPT, ["cost" => $this->cost]);
            $end = microtime(true);
        } while (($end - $start) < $this->timeTarget);
    }
}

?>
