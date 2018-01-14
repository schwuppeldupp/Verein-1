<?php

class Sportstaette extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
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
            
            //$data['vorstand'] = $this->_model->getAllVorstaende();
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
