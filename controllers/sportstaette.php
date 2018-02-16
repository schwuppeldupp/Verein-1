<?php

class Sportstaette extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Rendert Seite fuer Sportstaettenverwaltung.
     */
    public function verwaltung()
    {
        if(!Session::get('csrf_token')) {
            Session::destroy();
            Session::set('csrf_token', uniqid('', true));
            header("Location: " . DIR . "mainpage/safety");
        }
        else {
            Message::set(Session::get('rang') == 'Vorstand' ? Session::get('name').'<dir>Vorstand</dir>': Session::get('name'));
            
            $data['vorstand'] = $this->_common->getVorstand();
            $this->_view->render('header', $data);
            $this->_view->render('member/login', $data);
            $this->_view->render('vorstand/navigation', $data);
            
            $data['sportarten'] = $this->_common->getSportarten();
            $data['sportstaetten'] =  $this->_model->joinSportstaetten();
            
            $this->_view->render('sportstaette/content', $data);
            $this->_view->render('footer');
        }
    }
    
    /**
     * Rendert Seite fuer Angebot.
     */
    public function angebot()
    {
        if(!Session::get('csrf_token')) {
            Session::destroy();
            Session::set('csrf_token', uniqid('', true));
            header("Location: " . DIR . "mainpage/safety");
        }
        else {
            Message::set(Session::get('rang') == 'Vorstand' ? Session::get('name').'<dir>Vorstand</dir>': Session::get('name'));
            
            $data['sportarten'] = $this->_model->getSportarten();
            $this->_view->render('header', $data);
            $this->_view->render('member/login', $data);
            $this->_view->render('vorstand/navigation', $data);
            $this->_view->render('vorstand/sportarten', $data);
            $this->_view->render('footer');
        }
    }
    
    /**
     * Rendert Seite fuer Sportarten
     */
    public function setzen()
    {
        $url = explode("/", $_GET['url']);
        
        if(hash_equals($_POST['csrf'], Session::get('csrf_token'))) {
            if($_POST['bezeichnung']) {
 
                switch (array_pop($url)) {
                    case 0:
                        $sportstaette = $_POST;
                        $sport = $this->_model->getSportartId($sportstaette);
                        // sportart_id in Array schreiben
                        $sportstaette['sportart_id'] = $sport[0]['sportart_id'];
                        //Adresse schreiben
                        $adr = $this->_model->getAdresse($sportstaette);
                        if ($adr[0] == false) { //wenn Adresse nicht vorhanden, dann schreiben
                            $this->_model->setAdresse($sportstaette);
                            $adr = $this->_model->getAdresseID($sportstaette);
                        }
                        $this->_model->setPostleitzahl($sportstaette);
                        $sportstaette['adresse_id'] = $adr[0]['adresse_id'];
                        $this->_model->setSportstaette($sportstaette);
                        header("Location: " . DIR . "sportstaette/verwaltung");
                        break;
                    case 1:
                        if($_POST['change']) {
                            $sport = $this->_model->getSportartId($_POST);
                            $sportstaette = $_POST;                           
                            $sportstaette['sportart_id'] = $sport[0]['sportart_id'];
                            $plz = $this->_model->getPostleitzahl($sportstaette);
                            $sportstaette['plz_alt'] = $plz[0]['postleitzahl'];
                            $this->_model->updateSportstaette($sportstaette);                           
                            $this->_model->updateAdresse($sportstaette);
                            $this->_model->updatePostleitzahl($sportstaette);
                            header("Location: " . DIR . "sportstaette/verwaltung");
                        }
                        elseif ($_POST['delete']) {
                            $sportstaette = $_POST; 
                           
                            if ($this->_model->countPostleitzahlInAdresse($sportstaette) == 1)
                            {
                                $this->_model->delPostleitzahl($sportstaette);
                            }
                            
                            $count =  $this->_model->countAdresseInMitglieder($sportstaette) + $this->_model->countAdresseInSportstaette ($sportstaette);
                            if ($count == 1)
                            {
                                $this->_model->delAdresse($sportstaette);
                            }
                                                     
                            $this->_model->delSportstaette($_POST['bezeichnung']);
                            header("Location: " . DIR . "sportstaette/verwaltung");
                        }
                        break;
                    default:
                        header("Location: " . DIR . "sportstaette/verwaltung");
                        break;
                }
            }
            else {
                header("Location: " . DIR . "sportstaette/verwaltung");
            }
        }
        else {
            Session::destroy();
            Session::set('csrf_token', uniqid('', true));
            header("Location: " . DIR . "mainpage/safety");
        } 
    }
}
