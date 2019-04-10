<?php 
/* 
* Root class of all my classes 
*/
class View extends MyObject { 
    //On declare les objets a utiliser pour notre view.
    protected $controller;
    protected $args;
    protected $templateName;

    public function __construct(Controller $controller, $templateName ='home', $args= array())
    {
        $this->controller = $controller;
        $this->templateName = $templateName;
        $this->args = $args;
    }

    public function render(){
        $this->getTemplate('layout/head');
        $this->getTemplate('layout/menu');
        $this->getTemplate($this->templateName);
        $this->getTemplate('layout/foot');
    }

    protected function getTemplate($templateName)
    {
        extract($this->args);
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
    /*
    public function path($route, $params = array())
    {
        return Router::path($route, $params);
    }
    */
    public function linkTo($controller,$action=NULL)
    //Assure la redirection, le $controller sur NULL donnera Anonymous, $action sur NULL donnera DefaultAction
    {
        return __BASE_URL.'/index.php?controller='.$controller.'&action='.$action;
    }

    public function linkToID($controller,$action=NULL,$id)
    //Assure la redirection, le $controller sur NULL donnera Anonymous, $action sur NULL donnera DefaultAction
    {
        return __BASE_URL.'/index.php?controller='.$controller.'&action='.$action.'&id='.$id;
    }

    public function safe($string)
    {
        return htmlspecialchars($string);
    }
} 
?> 