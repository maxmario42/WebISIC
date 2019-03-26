<?php

class UserView extends View
{
    protected $user;

    public function render(){
        $this->getTemplate('head');
        $this->getTemplate('menuLoged');
        $this->getTemplate($this->templateName);
        $this->getTemplate('foot');
    }
}