<?php

class Mitglied extends Controller
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
        $url = explode("/", $_GET['url']);
        if(array_pop($url) !== Session::get('csrf_token')) {
            Session::destroy();
            Session::set('csrf_token', uniqid('', true));
            header("Location: " . DIR . "mainpage/safety/" . Session::get('csrf_token'));
        }
        else {
            Message::set(Session::get('rang') == 'Vorstand' ? Session::get('name').'<dir>Vorstand</dir>': Session::get('name'));

            $data['title'] = 'Mitgliederbereich';
            $this->_view->render('header', $data);
            $this->_view->render('member/login', $data);
            $data = $this->_common->getSportarten();
            switch (array_pop($url)) {
                case 'vorstand':
                    $this->_view->render('vorstand/navigation', $data);
                    $data['mitglieder'] = $this->_common->joinMitglieder();
                    $this->_view->render('vorstand/content', $data);                                 
                    break;
                default:
                    $this->_view->render('member/navigation', $data);
                    $data['vorstand'] = $this->_common->getVorstand();
                    $this->_view->render('member/content', $data);
                    break;
            }           
            $this->_view->render('footer');
        }
    }
          
    /**
     * Rendert Seite fuer Impressum.
     */
    public function impressum()
    {
        $url = explode("/", $_GET['url']);
        
        if(array_pop($url) !== Session::get('csrf_token')) {
            Session::destroy();
            Session::set('csrf_token', uniqid('', true));
            header("Location: " . DIR . "mainpage/safety/" . Session::get('csrf_token'));
        }
        else {
            Message::set(Session::get('rang') == 'Vorstand' ? Session::get('name').'<dir>Vorstand</dir>': Session::get('name'));
            
            $this->_view->render('header', $data);
            $this->_view->render('member/login', $data);
            $data = $this->_common->getSportarten();
            $this->_view->render('member/navigation', $data);
            
            switch (array_pop($url)) {
                case 'vorstand':
                    $data['vorstand'] = $this->_common->getVorstand();
                    $this->_view->render('public/vorstand', $data);
                    break;
                case 'mitglieder':
                    $this->_view->render('member/content', $data);
                    break;
                case 'kontakt':
                    $this->_view->render('member/content', $data);
                    break;
                default:
                    $this->_view->render('member/content', $data);
                    break;
            }
            $this->_view->render('footer');
            
        }
    }
        
    /**
     * Rendert Seite fuer Impressum Vorstand.
     */ 
    public function impressum2()
    {
        if(end(explode("/", $_GET['url'])) !== Session::get('csrf_token')) {
            Session::destroy();
            Session::set('csrf_token', uniqid('', true));
            header("Location: " . DIR . "mainpage/safety/" . Session::get('csrf_token'));
        }
        else {
            Message::set(Session::get('rang') == 'Vorstand' ? Session::get('name').'<dir>Vorstand</dir>': Session::get('name'));
            
            $data['vorstand'] = $this->_common->getVorstand();
            $this->_view->render('header', $data);
            $this->_view->render('member/login', $data);
            $data = $this->_common->getSportarten();
            $this->_view->render('vorstand/navigation', $data);
            //$this->_view->render('vorstand/content', $data);
            $this->_view->render('footer');
        }
    }
    
    /**
     * Rendert Seite fuer Buchungen.
     */
    public function buchung()
    {
        if(end(explode("/", $_GET['url'])) !== Session::get('csrf_token')) {
            Session::destroy();
            Session::set('csrf_token', uniqid('', true));
            header("Location: " . DIR . "mainpage/safety/" . Session::get('csrf_token'));
        }
        else {
            Message::set(Session::get('rang') == 'Vorstand' ? Session::get('name').'<dir>Vorstand</dir>': Session::get('name'));
            
            $data['title'] = 'Buchung';
            $this->_view->render('header', $data);
            $this->_view->render('member/login', $data);
            $data = $this->_common->getSportarten();
            $this->_view->render('member/navigation', $data);
            $this->_view->render('member/buchung', $data);
            //test
            //echo end(explode("/", $_GET['url'])) . '</br>';
            $this->_view->render('footer');
        }
    }
    
    /**
     * Rendert Seite fuer Buchung.
     */
    public function buchung2()
    {
        if(end(explode("/", $_GET['url'])) !== Session::get('csrf_token')) {
            Session::destroy();
            Session::set('csrf_token', uniqid('', true));
            header("Location: " . DIR . "mainpage/safety/" . Session::get('csrf_token'));
        }
        else {
            Message::set(Session::get('rang') == 'Vorstand' ? Session::get('name').'<dir>Vorstand</dir>': Session::get('name'));
            
            $data['vorstand'] = $this->_common->getVorstand();
            $this->_view->render('header', $data);
            $this->_view->render('member/login', $data);
            $this->_view->render('vorstand/navigation', $data);
            
            $this->_view->render('vorstand/buchung', $data);
            $this->_view->render('footer');
        }
    }
    
    /**
     * Rendert Seite fuer Registration
     * Nach erfolgreicher bzw. erfolgloser Registrierung wird Session beendet.
     */
    public function registration()
    {
        if($_POST['csrf'] !== Session::get('csrf_token')) {
            Session::destroy();
            Session::set('csrf_token', uniqid('', true));
            header("Location: " . DIR . "mainpage/registrationerror");
        }
               
        if($_POST['register']) {
            $user = $_POST['register'];
            
            if(!$this->checkRegistration($user)) {
                $exist = true;
                if(filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
                    $exist = $this->_model->checkEmail($user['email']);
                }
                else { //keine gueltige email
                   Session::destroy();
                   Session::set('csrf_token', uniqid('', true));
                   header("Location: " . DIR . "mainpage/registrationerror/4"); 
                                   
                }
                
                if($exist == false) {
                    $user['passwort'] =  $this->_pw->hash($user['passwort']);
                    if ($this->_pw->verify(array_pop($user), $user['passwort'])) {
                        $user['rang'] = 'mitglied';
                        
                        //Adresse schreiben
                        $adr = $this->_model->getAdresse($user);
                        if ($adr[0] == false) { //wenn Adresse nicht vorhanden, dann schreiben
                            $this->_model->setAdresse($user);
                            $adr = $this->_model->getAdresseID($user);
                        }                       
                        $this->_model->setPostleitzahl($user);
                        $user['adresse_id'] = $adr[0]['adresse_id'];
                         
                        //Mitgliedsdaten schreiben
                        $this->_model->setRegistration($user); 
                        Session::destroy(); 
                        Session::set('csrf_token', uniqid('', true));                    
                        header("Location: " . DIR . "mainpage/registrationsuccess"); //alles ging gut :)
                    }
                    else { //Passwort falsch
                        Session::destroy();
                        Session::set('csrf_token', uniqid('', true));
                        header("Location: " . DIR . "mainpage/registrationerror/3");
                    }
                    
                }
                else { //Benutzer exisiert bereits
                    Session::destroy();
                    Session::set('csrf_token', uniqid('', true));
                    header("Location: " . DIR . "mainpage/registrationerror/2");
                }
            }
            else { //Eingabe unvollständig
                Session::destroy();
                Session::set('csrf_token', uniqid('', true));
                header("Location: " . DIR . "mainpage/registrationerror/1");
            }           
        }
        else { //Fehler in Übermittlung
            Session::destroy();
            Session::set('csrf_token', uniqid('', true));
            header("Location: " . DIR . "mainpage/registrationerror/0");
        }
    }
    
    /**
     * Login fuer Mitglied
     * Nach erfolgreichem Login Weiterleitung in Mitgliederbereich.
     * Nach erfolgloser Registrierung wird Session beendet.
     */
    public function login()
    { 
        if($_POST['csrf'] !== Session::get('csrf_token')) {
            Session::destroy();
            Session::set('csrf_token', uniqid('', true));
            header("Location: " . DIR . "mainpage/safety/" . Session::get('csrf_token'));
        }
        
        if($_POST['login']) {
            $login = $_POST['login'];
            
            $user = false;
            if ($login['name'] == 'admin') {
                $user = $this->_model->checkAdmin();
            }
            else {
                $user = $this->_model->checkEmail($login['name']);
            }
            
            if ($user[0] !== false && $this->_pw->verify($login['passwort'],$user[0]['passwort']) && $user[0]['rang'] == 'vorstand') {
                Session::set('name', $user[0]['vorname'] . " " .$user[0]['nachname']);
                Session::set('rang', 'Vorstand');
                header("Location: " . DIR . "mitglied/index/vorstand/" . Session::get('csrf_token'));
            }
            elseif ($user[0] !== false && $this->_pw->verify($login['passwort'],$user[0]['passwort']) && $user[0]['rang'] == 'admin') {
                Session::set('name', 'Admin');
                Session::set('rang', 'Admin');
                header("Location: " . DIR . "admin/index/" . Session::get('csrf_token'));
            }
            elseif ($user[0] !== false && $this->_pw->verify($login['passwort'],$user[0]['passwort'])) {
                
                Session::set('name', $user[0]['vorname'] . " " .$user[0]['nachname']);
                //self::index();
                header("Location: " . DIR . "mitglied/index/" . Session::get('csrf_token'));
            }
            else {
                Session::destroy();
                Session::set('csrf_token', uniqid('', true));
                header("Location: " . DIR . "mainpage/loginerror");
            }
        }
    } 
    
    function checkRegistration($user)
    { 
        $error = false;
        
        foreach ($user as $reg) {
            if(strlen($reg) == 0) {
                $error = true;
            }
        }       
        return $error;
    }
}

?>