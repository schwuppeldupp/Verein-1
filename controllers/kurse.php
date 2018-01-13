<?php

class Kurse extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Rendert Seite fuer Buchung.
     */
    public function verwaltung()
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
            
            $data['kurse'] = $this->_model->getKurse();
            $data['sportarten'] = $this->_common->getSportarten();
            $data['mitglieder'] = $this->_common->joinMitglieder();
            $this->_view->render('kurse/content', $data);
            $this->_view->render('footer');
        }
    }

    /**
     * Speichert/Loescht Daten für Kurse
     */
    public function kurse()
    {
        $url = explode("/", $_GET['url']);
        if(array_pop($url) !== Session::get('csrf_token')) {
            Session::destroy();
            Session::set('csrf_token', uniqid('', true));
            header("Location: " . DIR . "mainpage/safety/" . Session::get('csrf_token'));
        }
        
        if($_POST['kursname']) {
            switch (array_pop($url)) {
                case 0:            
                    if($this->_model->getKurs($_POST['kursname'])) {
                        //$this->_model->updateSportart($_POST['kursname'], $_POST['beschreibung']);
                    }
                    else {
                        //toDo:
                        //Datetime formatieren 0000-00-00 00:00:00
                        //<option value="Yoga" selected>Yoga</option>
                        
                        //sportart_id ermitteln
                        $sport = $this->_model->getSportartId($_POST);
                        $kurs = $_POST;
                        $kurs['sportart_id'] = $sport[0]['sportart_id'];
                        $this->_model->setKurs($kurs);
                    }
                    header("Location: " . DIR . "kurse/verwaltung/" . Session::get('csrf_token'));
                    break;
                case 1:
                    if($_POST['change']) {
                        //$this->_model->changeKurs($_POST['sportart_id'], $_POST['sportart'], $_POST['beschreibung']);
                        header("Location: " . DIR . "kurse/verwaltung/" . Session::get('csrf_token'));   
                    }
                    elseif ($_POST['delete']) {
                        //$this->_model->delKurs($_POST['sportart']);
                        header("Location: " . DIR . "kurse/verwaltung/" . Session::get('csrf_token'));
                    }
                    break;
                default:
                    header("Location: " . DIR . "kurse/verwaltung/" . Session::get('csrf_token'));
                    break;
            }
        }
        else {
            header("Location: " . DIR . "kurse/verwaltung/" . Session::get('csrf_token'));
        }     
    }
}