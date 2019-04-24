<?php 
class View extends MyObject {
    /*
    Cette classe génère l'affichage de nos pages
    */
    //On declare les objets a utiliser pour notre view.
    protected $controller;
    protected $args; //$args stocke divers objets (User, Questionnaire...)
    protected $templateName;

    public function __construct(Controller $controller, $templateName ='home', $args= array())
    {
        $this->controller = $controller;
        $this->templateName = $templateName;
        $this->args = $args;
    }

    public function render()
    {
    //Réalise le rendu de notre page
        $this->getTemplate('layout/head');
        $this->getTemplate('layout/menu'); //Le menu sera différent en fonction du moment en utilisant des if, else if, else, endif
        $this->getTemplate($this->templateName);
        $this->getTemplate('layout/foot');
    }

    protected function getTemplate($templateName)
    //Récupère le template voulue
    {
        extract($this->args);
        $path=implode('/', array(
            __ROOT_DIR,
            'templates',
            $templateName.'Template.php'
        ));
        if (is_readable($path)) {
            require_once($path);
            return;
        }
        throw new \Error('Template inconnu',404);
    }

    public function getArg($key, $default = false)
    //Accès à un objet passé en args
    {
        if (isset($this->args[$key])) {
            return $this->args[$key];
        }
        return $default;
    }
    public function setArg($key, $value)
    //Stocke un objet en args
    {
        $this->args[$key] = $value;
        return $this;
    }
    public function linkTo($controller,$action=NULL, $params = array())
    //Assure la redirection, le $controller sur NULL donnera Anonymous, $action sur NULL donnera DefaultAction
    //On peut passer d'autres paramètres en GET avec $params
    {
        $params['controller'] = $controller;
        $params['action'] = $action;
        return __BASE_URL.'/index.php?'.http_build_query($params);
    }
    public function safe($string)
    {
        return htmlspecialchars($string);
    }
} 
?> 