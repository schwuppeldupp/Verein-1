<?php

class Admin extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Indexseite Admin
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
            $this->_view->render('admin/navigation', $data);
            $data['vorstand'] = $this->_common->getVorstand();
            $data['mitglieder'] = $this->_common->joinMitglieder();
            $this->_view->render('admin/content', $data);
            $this->_view->render('footer');
        }
    }
    
    /**
     * Rendert Seite fuer Verwaltung
     */
    public function vorstand()
    {
        $url = explode("/", $_GET['url']);
        if(array_pop($url) !== Session::get('csrf_token')) {
            Session::destroy();
            Session::set('csrf_token', uniqid('', true));
            header("Location: " . DIR . "mainpage/safety/" . Session::get('csrf_token'));
        }
        
        if($_POST['vorstand']) {          
            $user = $this->_model->getMitglied($_POST['vorstand'][0]);
            if ($user[0]['rang'] == 'mitglied') {
                $this->_model->setVorstand($user[0]['email']);
            }
            elseif ($user[0]['rang'] == 'vorstand') {
                $this->_model->unsetVorstand($user[0]['email']);
            }
            header("Location: " . DIR . "admin/index/" . Session::get('csrf_token'));
        }
        else {
            header("Location: " . DIR . "admin/index/" . Session::get('csrf_token'));
        }
        
    }
}
