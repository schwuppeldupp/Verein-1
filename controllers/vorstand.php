<?php

class Vorstand extends Controller
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
            $this->_view->render('vorstand/content', $data);
            
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
            $data['vorstand'] = $this->_model->getAllVorstaende();
            $this->_view->render('header', $data);
            $this->_view->render('member/login', $data);
            $this->_view->render('vorstand/navigation', $data);
            $this->_view->render('vorstand/content', $data);
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
            $data['vorstand'] = $this->_model->getAllVorstaende();
            $this->_view->render('header', $data);
            $this->_view->render('member/login', $data);
            $this->_view->render('vorstand/navigation', $data);
            $this->_view->render('vorstand/content', $data);
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
            //$data['vorstand'] = $this->_model->getAllVorstaende();
            $data = $this->_model->getSportarten();
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
                    $sportart = $_POST['sportart'];
                    $this->_model->setSportart($sportart);
                    header("Location: " . DIR . "vorstand/angebot/" . Session::get('csrf_token'));
                    break;
                case 1:
                    $sportart = $_POST['sportart'];
                    $this->_model->delSportart($sportart);
                    header("Location: " . DIR . "vorstand/angebot/" . Session::get('csrf_token'));
                    break;
                default:
                    header("Location: " . DIR . "vorstand/angebot/" . Session::get('csrf_token'));
                    break;
            }
        }
        else {
            header("Location: " . DIR . "vorstand/angebot/" . Session::get('csrf_token'));
        }

    }
}

?>