<?php

class UserView extends View
{
    public function render(){
        $this->getTemplate('layout/head');
       $this->getTemplate('layout/menuLoged');
        $this->getTemplate($this->templateName);
        $this->getTemplate('layout/foot');
    }
}