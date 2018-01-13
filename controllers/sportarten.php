<?php

class Sportarten extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Indexseite Vorstand
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
            
            $data['title'] = 'Verwaltung';
            $this->_view->render('header', $data);
            $this->_view->render('member/login', $data);
            $this->_view->render('vorstand/navigation', $data);
            $data['mitglieder'] = $this->_common->joinMitglieder();
            $this->_view->render('vorstand/content', $data);
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
            
            $data['vorstand'] = $this->_common->getVorstand();
            $this->_view->render('header', $data);
            $this->_view->render('member/login', $data);
            $this->_view->render('vorstand/navigation', $data);
            //$this->_view->render('vorstand/content', $data);
            $this->_view->render('footer');
        }
    }
    
    /**
     * Rendert Seite fuer Buchung.
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
            
            $data['vorstand'] = $this->_common->getVorstand();
            $this->_view->render('header', $data);
            $this->_view->render('member/login', $data);
            $this->_view->render('vorstand/navigation', $data);
            //$this->_view->render('vorstand/content', $data);
            $this->_view->render('footer');
        }
    }
    
    /**
     * Rendert Seite fuer Angebot.
     */
    public function angebot()
    {
        if(end(explode("/", $_GET['url'])) !== Session::get('csrf_token')) {
            Session::destroy();
            Session::set('csrf_token', uniqid('', true));
            header("Location: " . DIR . "mainpage/safety/" . Session::get('csrf_token'));
        }
        else {
            Message::set(Session::get('rang') == 'Vorstand' ? Session::get('name').'<dir>Vorstand</dir>': Session::get('name'));
            
            //$data['vorstand'] = $this->_common->getVorstand();
            $data = $this->_common->getSportarten();
            $this->_view->render('header', $data);
            $this->_view->render('member/login', $data);
            $this->_view->render('vorstand/navigation', $data);
            $this->_view->render('sportarten/content', $data);
            $this->_view->render('footer');
        }
    }
    
    /**
     * Speichert/Loescht Daten für Sportarten
     */
    public function sportarten()
    {       
        $url = explode("/", $_GET['url']);
        if(array_pop($url) !== Session::get('csrf_token')) {
            Session::destroy();
            Session::set('csrf_token', uniqid('', true));
            header("Location: " . DIR . "mainpage/safety/" . Session::get('csrf_token'));
        }
        
        if($_POST['sportart']) {
            switch (array_pop($url)) {
                case 0:
                    if($this->_model->getSportart($_POST['sportart'])) {
                        $this->_model->updateSportart($_POST['sportart'], $_POST['beschreibung']);
                    }
                    else {
                        $this->_model->setSportart($_POST['sportart'], $_POST['beschreibung']);
                    }
                    header("Location: " . DIR . "sportarten/angebot/" . Session::get('csrf_token'));
                    break;
                case 1:
                    if($_POST['change']) {
                        //$this->_model->updateSportart($_POST['sportart_id'], $_POST['sportart'], $_POST['beschreibung']);
                        $this->_model->changeSportart($_POST['sportart_id'], $_POST['sportart'], $_POST['beschreibung']);
                        header("Location: " . DIR . "sportarten/angebot/" . Session::get('csrf_token'));
                    }
                    elseif ($_POST['delete']) {
                        $this->_model->delSportart($_POST['sportart']);
                        header("Location: " . DIR . "sportarten/angebot/" . Session::get('csrf_token'));
                    }
                    break;
                default:
                    header("Location: " . DIR . "sportarten/angebot/" . Session::get('csrf_token'));
                    break;
            }
        }
        else {
            header("Location: " . DIR . "sportarten/angebot/" . Session::get('csrf_token'));
        }
        
    }
}

?>