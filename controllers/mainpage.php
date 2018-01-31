<?php

class Mainpage extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Rendert Indexseite.
     */
    public function index()
    {
        Session::set('csrf_token', uniqid('', true));

        $data['title'] = '&Uuml;bersicht';       
        $this->_view->render('header', $data);
        $this->_view->render('public/login', $data);
        $data['sportarten'] = $this->_common->getSportarten();
        $this->_view->render('public/navigation', $data);
        $data['vorstand'] = $this->_common->getVorstand();
        $this->_view->render('public/content', $data);
        
        //$headers = apache_response_headers();
        //echo print_r($headers);
        //echo  $headers['X-CSRF-Token'];
        $this->_view->render('footer');
    }
    
    /**
     * Rendert Angebotsseite.
     */
    public function angebot()
    {
        //Session::set('csrf_token', uniqid('', true));
        //$headers = apache_response_headers();
        //echo  'begin: ' . $headers['X-CSRF-Token'] . '</br>';
        //echo  'begin: ' .$_GET['url'];
        //echo  'begin: ' . $this->getToken();

        $data['title'] = '&Uuml;bersicht';
        $this->_view->render('header', $data);
        $this->_view->render('public/login', $data);
        $data['sportarten'] = $this->_common->getSportarten();
        $this->_view->render('public/navigation', $data);
        $data['vorstand'] = $this->_common->getVorstand();
        $data['kurse'] = $this->_model->getKurse();
        $this->_view->render('public/angebot', $data);       
        //$headers = apache_response_headers();
        //echo print_r($headers);
        //echo  'end: ' . $headers['X-CSRF-Token'];
        //header("X-CSRF-Token:");  //unset($headers['X-CSRF-Token']);
        //$headers = apache_response_headers();
        //echo print_r($headers);
        $this->_view->render('footer');
    }
    
    /**
     * Rendert Seite fuer Impressum.
     */
    public function impressum()
    {
        //Session::set('csrf_token', uniqid('', true));
        
        $url = explode("/", $_GET['url']);
        
        $data['vorstand'] = $this->_common->getVorstand();
        $this->_view->render('header', $data);
        $this->_view->render('public/login', $data);
        $data['sportarten'] = $this->_common->getSportarten();
        $this->_view->render('public/navigation', $data);
        
        switch (array_pop($url)) {
            case 'vorstand':
                $data['vorstand'] = $this->_common->getVorstand();
                $this->_view->render('public/vorstand', $data);
                break;
            case 'mitglieder':
                $this->_view->render('public/content', $data);
                break;
            case 'kontakt':
                $this->_view->render('public/content', $data);
                break;
            default:
                $this->_view->render('public/content', $data);
                break;
        }
        //$headers = apache_response_headers();
        //echo print_r($headers);
        //echo  $headers['X-CSRF-Token'];
        $this->_view->render('footer');
    }

    /**
     * Rendert Seite fuer Registrierung.
     */
    public function register()
    {
        //Session::set('csrf_token', uniqid('', true));
        
        $data['title'] = 'Registrierung';
        //$data['content_title'] = 'Registrierung';       
        $this->_view->render('header', $data);
        $this->_view->render('public/login', $data);
        $data['sportarten'] = $this->_common->getSportarten();
        $this->_view->render('public/navigation', $data);
        $this->_view->render('public/registration', $data);
        
        //$headers = apache_response_headers();
        //echo print_r($headers);
        //echo  $headers['X-CSRF-Token'];
        $this->_view->render('footer');
    }
    
    /**
     * Rendert Seite fuer Loginfehler.
     */
    public function loginerror()
    {
        //Session::set('csrf_token', uniqid('', true));

        $data['title'] = '&Uuml;bersicht';
        $this->_view->render('header', $data);
        $this->_view->render('public/login', $data);
        $data['sportarten'] = $this->_common->getSportarten();
        $this->_view->render('public/navigation', $data);
        $this->_view->render('error/login', $data);
        
        //$headers = apache_response_headers();
        //echo print_r($headers);
        //echo  $headers['X-CSRF-Token'];
        $this->_view->render('footer');
    }
    
    /**
     * Rendert Seite fuer Registrierungsfehler.
     * Fallunterscheidung bei Fehlern!
     */
    public function registrationerror()
    {
        //Session::set('csrf_token', uniqid('', true));

        $data['title'] = 'Registrierung';
        $this->_view->render('header', $data);
        $this->_view->render('public/login', $data);
        $data['sportarten'] = $this->_common->getSportarten();
        $this->_view->render('public/navigation', $data);
 
        switch (substr($_GET['url'], -1)) {
            case 0:
                Message::set('Fehler bei der &Uuml;bertragung der Daten!');
                break;
            case 1:
                Message::set('Angaben sind unvollst&auml;ndig!');
                break;
            case 2:
                Message::set('Die Mailadresse wird bereits verwendet!');
                break;
            case 3:
                Message::set('Passwörter stimmen nicht überein!');
                break;
            case 4:
                Message::set('Die Mailadresse ist ung&uuml;ltig!');
                break;
           default:
               Message::set('Unbekannter Fehler!');
               break;
        }
        
        $this->_view->render('error/registration', $data);
        
        //$headers = apache_response_headers();
        //echo print_r($headers);
        //echo  $headers['X-CSRF-Token'];
        $this->_view->render('footer');
    }
 
    /**
     * Rendert Seite fuer erfolgreiche Registration.
     */
    public function registrationsuccess()
    {
        //Session::set('csrf_token', uniqid('', true));
 
        $this->_view->render('header', $data);
        $this->_view->render('public/login', $data);
        $data['sportarten'] = $this->_common->getSportarten();
        $this->_view->render('public/navigation', $data);
        $this->_view->render('public/success', $data);
        
        //$headers = apache_response_headers();
        //echo print_r($headers);
        //echo  $headers['X-CSRF-Token'];
        $this->_view->render('footer');
    }
    
    /**
     * Weiterleitung zur Indexseite bei ungültiger Session.
     * Schutz vor csfr -  Website-übergreifende Anfragenfälschung.
     */
    public function safety()
    {
        //Session::destroy();
        //Session::set('csrf_token', uniqid('', true));
        Message::set('Sie sind ausgeloggt!');
        header("Location: " . DIR . "mainpage/index/" . Session::get('csrf_token'));
    }
    
    /**
     * Weiterleitung zur Indexseite nach Logut.
     */
    public function logout()
    {
        if(!Session::get('csrf_token')) {
            Session::destroy();
            //self::loginerror();
            //header("X-CSRF-Token: " . Session::get('csrf_token'));
            header("Location: " . DIR . "mainpage/loginerror");
            //header("Location: " . DIR . "mainpage/loginerror/" . Session::get('csrf_token'));
        }
        else {
            Session::destroy();
            //self::index();
            //header("X-CSRF-Token: " . Session::get('csrf_token'));
            header("Location: " . DIR . "mainpage/index");
            //header("Location: " . DIR . "mainpage/index/" . Session::get('csrf_token'));
        }
    }
}

?>