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
    public function getArg($key, $default = false)
    {
        if (isset($this->args[$key])) {
            return $this->args[$key];
        }
        return $default;
    }
    public function setArg($key, $value)
    {
        $this->args[$key] = $value;
        return $this;
    }
    public function path($route, $params = array())
    {
        return Router::path($route, $params);
    }
    public function getUser()
    {
        return Request::getCurrentRequest()->getUser();
    }
    public function safe($string)
    {
        return htmlspecialchars($string);
    }
    public function getNotifications()
    {
        return Request::getCurrentRequest()->getNotifications();
    }
    public function resetNotifications()
    {
        return Request::getCurrentRequest()->resetNotifications();
    }
    public function getRequest()
    {
        return Request::getCurrentRequest();
    }
}
