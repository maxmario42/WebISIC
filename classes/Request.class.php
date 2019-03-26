<?php
class Request extends MyObject {
    private static $Request = null;
    public static function getCurrentRequest() {
 
        if(is_null(static::$Request)) {
          static::$Request = new static();  
        }
    
        return static::$Request;
      }
    public function getController(){
        if (isset($_GET['controller'])){
            return $_GET['controller'];
        }
        return 'Anonymous';
    }

    public function getAction(){
        
        if (isset($_GET['action'])){
            return $_GET['action'];
        }
    }

    public function read($arg){
        if (isset($_POST[$arg])){
            return$_POST[$arg];
        }
    }

    public function changeController($value=null){
        if($value==null){
            unset ($_GET['controller']);
        }
        $l=$_GET['controller']=$value;
        
        return $l;
        
    }

    public function changeAction($value=null){
        if($value==null){
            unset ($_GET['action']);
        }
        $l=$_GET['action']=$value;
        return $l;
    }

    public function write($key,$value){
        $l1=$_POST[$key]=$value;
    }
}
?>

<?php
/*
// Load my root class 
require_once(__ROOT_DIR . '/classes/MyObject.class.php');

class Request extends MyObject{
/* 
La classe Request represente les requêtes HTTP. Il y aura une seule instance de cette classe
dans le programme qui représentera la requête courante. Cet objet Request devra faciliter l’accès
aux paramètres de la requête (GET, POST, ...).
*/
/*
    private static $request;
    private $action;
    private $controller;
    private $connection;
    private $user = null;

    public function __construct()
    //Constructeur de la requête
    {
        $this->setController($this->GET('controller'));
        $this->setAction($this->GET('action')); //nom de la methode du controlleur a executer
        $this->user = Session::getInstance()->user;
    }

    public static function getCurrentRequest()
    //Retourne l'instance requête si elle existe sinon la crée
    {
        if (is_null(self::$request)) { //Singleton
            self::$request = new Request();  // static::new static() dessigne la classe du receveur du message. 
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

    public function write($controller,$action){
        $this->setController($controller);
        $this->setAction($action);
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
    public function read($key){ //pour lire les donnes en post
        return $_POST[$key];
    }
    public function POST($key, $default = false)
    //Récupère les paramètres en POST
    {
        if (isset($_POST[$key])) {
            return $_POST[$key];
        }
        return $default;
    }
    public function REQUEST($key, $default = false)
    //Renvoie une requête associée à une clé, faux si elle n'existe pas
    {
        if (isset($_REQUEST[$key])) {
            return $_REQUEST[$key];
        }
        return $default;
    }
    public function set($key, $value)
    //Permet de setter une valeur sur une clé
    {
        $this->{'set'.ucfirst($key)}($value);
        return $this;
    }
    public function isPost()
    //Requête en POST
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
    public function setUser($user)
    //Premet de setter l'utilisateur
    {
        if (!$user instanceof User) {
            Session::getInstance()->user = $user;
        } else {
            Session::getInstance()->user = $user->getId();
        };
        $this->user = $user;
        return $this;
    }
    public function getUser()
    //Permet d'obtenir l'utilisateur
    {
        if ($this->user == null || $this->user instanceof User) {
            return $this->user;
        }
        $this->setUser(User::find($this->user));
        return $this->user;
    }
}
*/
?>