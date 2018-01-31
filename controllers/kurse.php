<?php

class Kurse extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Rendert Seite fuer Buchungsverwaltung.
     */
    public function verwaltung()
    {
        //if(end(explode("/", $_GET['url'])) !== Session::get('csrf_token')) {
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
            $data['kurse'] = $this->_common->getKurse();
            $data['sportarten'] = $this->_common->getSportarten();
            $data['mitglieder'] = $this->_common->joinMitglieder();
            $this->_view->render('kurse/content', $data);
            $this->_view->render('footer');
        }
    }
    
    /**
     * Rendert Seite fuer Buchung.
     */
    public function buchen()
    {
        $url = explode("/", $_GET['url']);
        if(!Session::get('csrf_token')) {
            Session::destroy();
            Session::set('csrf_token', uniqid('', true));
            header("Location: " . DIR . "mainpage/safety");
        }
        else {
            Message::set(Session::get('rang') == 'Vorstand' ? Session::get('name').'<dir>Vorstand</dir>': Session::get('name'));
                      
            //echo print_r($_POST);
            //die();
            
            //$data['vorstand'] = $this->_common->getVorstand();
            //$this->_view->render('header', $data);
            //$this->_view->render('member/login', $data);
            //$data['sportarten'] = $this->_common->getSportarten();
            //$this->_view->render('member/navigation', $data); 
            //$this->_view->render('footer');
            
            if($_POST['kurs_id']) {
                switch (array_pop($url)) {
                    case 0:    
                        break;
                    case 1:
                        if($_POST['book']) {   
                            //$this->_model->setBuchung(Session::get('mitglied_id'), $_POST['kursname']);
                            header("Location: " . DIR . "mitglied/buchung");
                        }
                        elseif ($_POST['delete']) {
                            //$this->_model->delBuchung(Session::get('mitglied_id'), $_POST['kursname']);
                            header("Location: " . DIR . "mitglied/buchung");
                        }
                        
                        //$sport = $this->_model->getSportartId($_POST);
                        //$kurs = $_POST;
                        //$kurs['sportart_id'] = $sport[0]['sportart_id'];
                        //$kurs['beginn'] = $kurs['datum']  . ' ' . $kurs['beginn'];
                        //$kurs['ende'] = $kurs['datum']  . ' ' . $kurs['ende'];
                        //$this->_model->updateKurs($kurs);
                        //header("Location: " . DIR . "kurse/verwaltung");
                        break;
                    default:
                        header("Location: " . DIR . "mitglied/buchung");
                        break;
        
                 }
            }
            else {
                header("Location: " . DIR . "mitglied/buchung");
            }
        } 
    }

    /**
     * Speichert/Loescht Daten für Kurse
     */
    public function kurse()
    {
        $url = explode("/", $_GET['url']);
        //if(array_pop($url) !== Session::get('csrf_token')) {
        if(!Session::get('csrf_token')) {
            Session::destroy();
            Session::set('csrf_token', uniqid('', true));
            header("Location: " . DIR . "mainpage/safety");
        }
        
        if($_POST['kursname']) {
            switch (array_pop($url)) {
                case 0:                                 
                    // sportart_id aus Sportart ermitteln
                    $sport = $this->_model->getSportartId($_POST);
                    $kurs = $_POST;
                    // sportart_id in Array schreiben
                    $kurs['sportart_id'] = $sport[0]['sportart_id'];
                    // beginn und ende in Array schreiben; Format: 2018-02-01 15:00:00
                    $kurs['beginn'] = $kurs['datum']  . ' ' . $kurs['beginn'];
                    $kurs['ende'] = $kurs['datum']  . ' ' . $kurs['ende'];
                    $this->_model->setKurs($kurs);

                    header("Location: " . DIR . "kurse/verwaltung");
                    break;
                case 1:
                    if($_POST['change']) {   
                        $sport = $this->_model->getSportartId($_POST);
                        $kurs = $_POST;
                        $kurs['sportart_id'] = $sport[0]['sportart_id'];
                        $kurs['beginn'] = $kurs['datum']  . ' ' . $kurs['beginn'];
                        $kurs['ende'] = $kurs['datum']  . ' ' . $kurs['ende'];
                        $this->_model->updateKurs($kurs);
                        header("Location: " . DIR . "kurse/verwaltung");   
                    }
                    elseif ($_POST['delete']) {
                        $this->_model->delKurs($_POST['kursname']);
                        header("Location: " . DIR . "kurse/verwaltung");
                    }
                    break;
                default:
                    header("Location: " . DIR . "kurse/verwaltung");
                    break;
            }
        }
        else {
            header("Location: " . DIR . "kurse/verwaltung");
        }     
    }
}