<?php

// Load my root class 
require_once(__ROOT_DIR . '/classes/MyObject.class.php');

class Request extends MyObject {
    /* 
    La classe Request represente les requêtes HTTP. Il y aura une seule instance de cette classe
    dans le programme qui représentera la requête courante. Cet objet Request devra faciliter l’accès
    aux paramètres de la requête (GET, POST, ...).
    */
    private static $Request = null;
    private $action;
    private $controller;
    private $user = null;

    public static function getCurrentRequest()
    //Design pattern Singleton
    {
        if(is_null(static::$Request))
        {
            static::$Request = new Request();  
        }
    
        return static::$Request;
    }
    public function __construct()
    //Consruit la requête
    {
        $this->setController($this->readController());
        $this->setAction($this->readAction());
        $this->user = Session::getInstance()->UserID;
    }
    public function readController()
    {
    //Lit le controlleur dans le GET (Anonymous par défaut)
        if (isset($_GET['controller']) && $_GET['controller']!=NULL)
        {
            return $_GET['controller'];
        }
        return 'Anonymous';
    }

    public function readAction()
    {
    //Lit l'action dans le GET (defaultAction par défaut)
        if (isset($_GET['action']) && $_GET['action']!=NULL)
        {
            return $_GET['action'];
        }
        return 'defaultAction';
    }
    public function setAction($action)
    //Définit l'action voulue
    {
        $this->action = $action ?: 'defaultAction';
        return $this;
    }
    public function setController($controller)
    //Définit le controlleur voulu
    {
        $this->controller = ucfirst($controller) ?: 'Anonymous';
        return $this;
    }
    public function getController()
    //Accès au controlleur
    {
        return $this->controller;
    }
    public function getAction()
    //Accès à l'action
    { var_dump($this->action);
        return $this->action;
        
    }

    public function read($arg){
        if (isset($_POST[$arg])){
            return$_POST[$arg];
        }
    }
    public function write($key,$value){
        $l1=$_POST[$key]=$value;
        return $l1;
    }

    public function setUser($userID)
    //Définit l'utilisateur en allant chercher l'ID de l'utilisateur dans la session
    {
        Session::getInstance()->UserID=$userID;
        $this->user=$userID;
        return $this;
    }
    public function getUser()
    //Lit l'ID de l'utilisateur
    {
        return $this->user;
    }
    public function getUserObject()
    //Retourne l'utilisateur
    {
        return User::getWithId($this->getUser());
    }
    public function unsetUser()
    //Déconnexion
    {
        $this->setUser(NULL);
        Session::getInstance()->destroy();
    }
  //Sert a recuperer l'ID d'un questionnaire pour l'afficher
    public function getParameter($param){
		if (isset($_GET[$param])) {
			return $_GET[$param];
		}
		return "404";
	}
}
?>