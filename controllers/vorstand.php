<?php

class Vorstand extends Mitglied
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Login fuer Vorstand
     * Nach erfolgreichem Login Weiterleitung in Mitgliederbereich.
     * Nach erfolgloser Registrierung wird Session beendet.
     */
    public function login()
    {
        //$user['rang'] = 'vorstand';
        //$this->_model->setRegistration($user);
    }
    
    /**
     * Rendert Seite fuer Registration
     * Nach erfolgreicher Registrierung wird Session beendet.
     */
    public function registration()
    {
        //$user['rang'] = 'vorstand';
        //$this->_model->setRegistration($user);
    }
}

?>