<?php

class Controller {
    
    protected $_view;
    protected $_model;
    protected $_common;
    protected $_pw;
    //protected $_token;
    
    function __construct() {
        $this->_view = new View();
        $this->_common = new Common();
        $this->_pw = new Password();
        
        $name = get_class($this);
        $modelpath = 'models/' . $name . '_model.php';
        
        if (file_exists($modelpath)) {
            require $modelpath;
            
            $modelName = $name . '_Model';
            $this->_model = new $modelName();
        }
    }  
    
    public function setToken($value) {
        $this->_token = $value;
    }
    
    //public function getToken() {
    //    return $this->_token;
    //}
}

?>
