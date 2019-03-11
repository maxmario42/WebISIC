<?php
// Load my root class 
require_once(__ROOT_DIR . '/classes/MyObject.class.php');

class Request extends MyObject{
/* 
La classe Request represente les requêtes HTTP. Il y aura une seule instance de cette classe
dans le programme qui représentera la requête courante. Cet objet Request devra faciliter l’accès
aux paramètres de la requête (GET, POST, ...).
*/
    private static $request;
    private $action;
    private $controller;

    public function __construct()
    //Constructeur de la requête
    {
        $this->setController($this->GET('controller'));
        $this->setAction($this->GET('action'));
    }

    public static function getCurrentRequest()
    //Retourne l'instance requête si elle existe sinon la crée
    {
        if (is_null(self::$request)) { //Singleton
            self::$request = new Request();
        }
        return self::$request;
    }

    public function getControllerName()
    //Retourne le nom du controlleur
    {
        return $this->controller.'Controller';
    }
    public function getActionName()
    //Retourne le nom de l'action
    {
        return $this->action.'Action';
    }
    public function getController()
    //Retourne le controlleur
    {
        return $this->controller;
    }
    public function getAction()
    //Retourne l'action
    {
        return $this->action;
    }
    public function setAction($action)
    //Paramètre l'action
    {
        $this->action = $action ?: 'default';
        return $this;
    }
    public function setController($controller)
    //Paramètre le controlleur
    {
        $this->controller = ucfirst($controller) ?: 'Anonymous';
        return $this;
    }
    public function GET($key, $default = '')
    //Permet de récupérer les paramètres passés en GET
    {
        if (isset($_GET[$key])) {
            return $_GET[$key];
        }
        return $default;
    }
}
?>