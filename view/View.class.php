<?php

class View extends MyObject
{
    protected $controller;
    protected $args;
    protected $templateName;

    public function __construct(Controller $controller, $templateName = 'home', $args = array())
    {
        $this->controller = $controller;
        $this->templateName = $templateName;
        $this->args = $args;
    }

    public function render()
    {
        $this->getTemplate('layout/head');
        $this->getTemplate('layout/menu');
        $this->getTemplate('page/'.$this->templateName);
        $this->getTemplate('layout/foot');
    }
    
    protected function getTemplate($templateName)
    {
        include_once(implode('/', array(
            __ROOT_DIR,
            'templates',
            $templateName.'Template.php'
        )));
    }
}

?>