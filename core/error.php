<?php

class Failure extends Controller {
    
    private $_failure = null;
   
    public function __construct($failure){
        parent::__construct();
        $this->_failure = $failure;
    }
   
    /**
     * Zeigt Fehler an und Stopp.
     */
    public function index(){
        $data['error'] = $this->_failure;
        $this->_view->render('error/404',$data);
    }  
}

?>
