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