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
        if(end(explode("/", $_GET['url'])) !== Session::get('csrf_token')) {
            Session::destroy();
            Session::set('csrf_token', uniqid('', true));
            header("Location: " . DIR . "mainpage/safety/" . Session::get('csrf_token'));
        }
        else {
            Message::set(Session::get('rang') == 'Vorstand' ? Session::get('name').'<dir>Vorstand</dir>': Session::get('name'));

            $data['title'] = 'Mitgliederbereich';
            $this->_view->render('header', $data);
            $this->_view->render('member/login', $data);
            $this->_view->render('member/navigation', $data);
            $this->_view->render('member/content', $data);
            
            //for testing
            echo end(explode("/", $_GET['url'])) . '</br></br>';
            foreach ($this->_model->joinMitglieder() as $user) {
                echo $user['vorname'] . ' ' . $user['nachname']. '</br>';
                echo $user['strasse'] . ' ' . $user['hausnummer']. '</br>';
                echo $user['postleitzahl'] . ' ' . $user['ort']. '</br>';
                echo '</br>';
            }
            $this->_view->render('footer');
        }
    }
    
    /**
     * Rendert Seite fuer Impressum.
     */
    public function impressum()
    {
        if(end(explode("/", $_GET['url'])) !== Session::get('csrf_token')) {
            Session::destroy();
            Session::set('csrf_token', uniqid('', true));
            header("Location: " . DIR . "mainpage/safety/" . Session::get('csrf_token'));
        }
        else {
            Message::set(Session::get('rang') == 'Vorstand' ? Session::get('name').'<dir>Vorstand</dir>': Session::get('name'));
            
            $this->_view->render('header', $data);
            $this->_view->render('member/login', $data);
            $this->_view->render('member/navigation', $data);
            $this->_view->render('member/content', $data);
            //test
            echo end(explode("/", $_GET['url'])) . '</br>';
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
            $this->_view->render('member/navigation', $data);
            $this->_view->render('member/booking', $data);
            //test
            echo end(explode("/", $_GET['url'])) . '</br>';
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
                header("Location: " . DIR . "vorstand/index/" . Session::get('csrf_token'));
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