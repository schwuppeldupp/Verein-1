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
        //Session::set('csrf_token', uniqid('', true));

        $data['title'] = '&Uuml;bersicht';       
        $this->_view->render('header', $data);
        $this->_view->render('public/login', $data);
        $data['sportarten'] = $this->_common->getSportarten();
        $this->_view->render('public/navigation', $data);
        $data['vorstand'] = $this->_common->getVorstand();
        $this->_view->render('public/content', $data);
        $this->_view->render('footer');
    }
    
    /**
     * Rendert Angebotsseite.
     */
    public function angebot()
    {
        $url = explode("/", $_GET['url']);       
        $sportart = array_pop($url);
        
        $data['title'] = '&Uuml;bersicht';
        $this->_view->render('header', $data);
        $this->_view->render('public/login', $data);
        $data['sportarten'] = $this->_common->getSportarten();
        $this->_view->render('public/navigation', $data);
        $data['vorstand'] = $this->_common->getVorstand();
        
        if ($sportart == 'angebot')
        {
            $data['kurse'] = $this->_model->getKurse();
        }
        else {
            $data['kurse'] = $this->_model->getKurseBySportart($sportart);
        }

        $this->_view->render('public/angebot', $data);       
        $this->_view->render('footer');
    }
    
    /**
     * Rendert Seite fuer Impressum.
     */
    public function impressum()
    {        
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
                $data['Mitgliederzahl'] = $this->_common->countMitglieder() + $this->_common->countVorstand();
                $this->_view->render('public/mitglieder', $data);
                break;
            case 'kontakt':
                $this->_view->render('public/kontakt', $data);
                break;
            default:
                $data['Mitgliederzahl'] = $this->_common->countMitglieder() + $this->_common->countVorstand();
                $data['Vorstandsanzahl'] = $this->_common->countVorstand();
                $this->_view->render('public/impressum', $data);
                break;
        }
        $this->_view->render('footer');
    }

    /**
     * Rendert Seite fuer Registrierung.
     */
    public function register()
    {  
        Session::set('csrf_token', uniqid('', true));
        
        $data['title'] = 'Registrierung'; 
        $this->_view->render('header', $data);
        $this->_view->render('public/login', $data);
        $data['sportarten'] = $this->_common->getSportarten();
        $this->_view->render('public/navigation', $data);
        $this->_view->render('public/registration', $data);
        //$this->_view->render('public/message');
        $this->_view->render('footer');
    }
    
    /**
     * Rendert Seite fuer Loginfehler.
     */
    public function loginerror()
    {
        $data['title'] = '&Uuml;bersicht';
        $this->_view->render('header', $data);
        $this->_view->render('public/login', $data);
        $data['sportarten'] = $this->_common->getSportarten();
        $this->_view->render('public/navigation', $data);
        $this->_view->render('error/login', $data);
        $this->_view->render('footer');
    }
    
    /**
     * Rendert Seite fuer Registrierungsfehler.
     * Fallunterscheidung bei Fehlern!
     */
    public function registrationerror()
    {
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
        $this->_view->render('footer');
    }
 
    /**
     * Rendert Seite fuer erfolgreiche Registration.
     */
    public function registrationsuccess()
    {
        $this->_view->render('header', $data);
        $this->_view->render('public/login', $data);
        $data['sportarten'] = $this->_common->getSportarten();
        $this->_view->render('public/navigation', $data);
        $this->_view->render('public/success', $data);
        $this->_view->render('footer');
    }
    
    /**
     * Weiterleitung zur Indexseite bei ungültiger Session.
     * Schutz vor csfr -  Website-übergreifende Anfragenfälschung.
     */
    public function safety()
    {
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
            header("Location: " . DIR . "mainpage/loginerror");
        }
        else {
            Session::destroy();
            header("Location: " . DIR . "mainpage/index");
        }
    }
}

?>
