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
            $data['sportstaetten'] = $this->_common->getSportstaetten();
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
        
        if(hash_equals($_POST['csrf'], Session::get('csrf_token'))) {
            if($_POST['kurs_id']) {                
                switch (array_pop($url)) {
                    case 0:
                        header("Location: " . DIR . "mitglied/angebot");
                        break;
                    case 1:
                        if($_POST['book']) {
                            $buchungen = $_POST;
                            $buchungen['mitglied_id'] = Session::get('mitglied_id');
                            $this->_model->setBuchung($buchungen);
                            header("Location: " . DIR . "mitglied/angebot");
                        }
                        elseif ($_POST['delete']) {
                            $buchungen = $_POST;
                            $buchungen['mitglied_id'] = Session::get('mitglied_id');
                            $buchungensId = $this->_model->getBuchungsId($buchungen);
                            $buchungen['buchungs_id'] = $buchungensId[0]['buchungs_id'];
                            $this->_model->delBuchung($buchungen);
                            header("Location: " . DIR . "mitglied/buchung");
                        }
                        break;
                    default:
                        header("Location: " . DIR . "mitglied/angebot");
                        break;
                        
                }
            }
            else {
                header("Location: " . DIR . "mitglied/angebot");
            }
        }
        else {
            Session::destroy();
            Session::set('csrf_token', uniqid('', true));
            header("Location: " . DIR . "mainpage/safety");
        }
    }

    /**
     * Speichert/Loescht Daten für Kurse
     */
    public function kurse()
    {
        $url = explode("/", $_GET['url']);

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
                    $sportstaette = $this->_model->getSportstaetteId($_POST);
                    $kurs = $_POST;
                    // sportart_id in Array schreiben
                    $kurs['sportart_id'] = $sport[0]['sportart_id'];
                    $kurs['sportstaette_id'] = $sportstaette[0]['sportstaette_id'];
                    // beginn und ende in Array schreiben; Format: 2018-02-01 15:00:00
                    $kurs['beginn'] = $kurs['datum']  . ' ' . $kurs['beginn'];
                    $kurs['ende'] = $kurs['datum']  . ' ' . $kurs['ende'];
                    $this->_model->setKurs($kurs);

                    header("Location: " . DIR . "kurse/verwaltung");
                    break;
                case 1:
                    if($_POST['change']) {   
                        $sport = $this->_model->getSportartId($_POST);
                        $sportstaette = $this->_model->getSportstaetteId($_POST);
                        $kurs = $_POST;
                        $kurs['sportart_id'] = $sport[0]['sportart_id'];
                        $kurs['sportstaette_id'] = $sportstaette[0]['sportstaette_id'];
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