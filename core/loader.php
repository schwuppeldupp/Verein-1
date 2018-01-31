<?php

class Loader {
    
    private $_url;
    //private $_token;
    private $_controller = null;
    private $_defaultController;
    
    public function __construct() {
        //start the session class
        Session::init();
        //sets the url
        $this->_getUrl();
    }

    public function setController($name) {
        $this->_defaultController = $name;
    }
    
    public function init() {
        //if no page requested set default controller
        if(empty($this->_url[0])) {
            $this->_loadDefaultController();
            return false;
        }
        
        $this->_loadExistingController();
        $this->_callControllerMethod();       
    }
    
    private function _getUrl() {
        $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : NULL;
        $url = urldecode(filter_var(urlencode($url), FILTER_SANITIZE_URL));
        
        //
        /*if(preg_match("/" . SESSION_PREFIX . "/", $url) === 1) {
            preg_match("/(^.+)\/(" . SESSION_PREFIX . ".+)/", $url, $regx);
            $this->_token = $regx[2];
            $url = $regx[1];
            //echo print_r($url);
            //die();
        }*/    
        //
        
        $this->_url = explode('/', $url);
    }
    
    private function _loadDefaultController() {
        require 'controllers/' . $this->_defaultController . '.php';
        $this->_controller = new $this->_defaultController();
        //
        //$this->_controller->setToken($this->_token);
        //
        $this->_controller->index();
    }
    
    private function _loadExistingController() {
        //set url for controllers
        $file = 'controllers/' . $this->_url[0] . '.php';
        
        if(file_exists($file)) {
            require $file;
            
            //instatiate controller
            $this->_controller = new $this->_url[0];
            //
            //$this->_controller->setToken($this->_token);
            //
        } else {
            $this->_controller = new $this->_url[0];
            $this->_error("Datei existiert nicht: " . $this->_url[0]);
            return false;
        }
        
    }
    
    /**
     * If a method is passed in the GET url paremter
     *
     *  http://localhost/controller/method/(param)/(param)/(param)
     *  url[0] = Controller
     *  url[1] = Method
     *  url[2] = Parameter
     *  url[3] = Parameter
     *  url[4] = Parameter
     */
    private function _callControllerMethod()
    {
        unset($this->_url[0]);
        $method = 'index';
        
        if (is_callable(array($this->_controller, $this->_url[1]))) {
            $method = array_shift($this->_url);
        }
      
        $parameter = filter_var_array($this->_url, FILTER_SANITIZE_STRING);
        
        $last = array_pop($parameter);
               
        /*if(preg_match("/" . SESSION_PREFIX . "/", $last) === 1) {
            preg_match("/(^.+)\/(" . SESSION_PREFIX . ".+)/", $parameter, $regx);
            $this->_token = $regx[2];
            //$parameter = $regx[1];
            echo print_r($url);
            die();
        }
        else {
            array_push ($parameter, $last);
        }*/
        //$this->_controller->setToken($this->_token);
        call_user_func_array(array($this->_controller, $method), $parameter);
    }
    
    /**
     * Display an error page if nothing exists
     *
     * @return boolean
     */
    private function _error($error) {
        require 'core/error.php';
        $this->_controller = new Failure($error);
        $this->_controller->index();
        die;
    }
    
}

?>