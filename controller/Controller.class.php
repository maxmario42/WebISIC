<?php
abstract class Controller extends MyObject {
    protected $request;
    private $action;

    public function __construct($request) {
        $this->request = $request;
    }
    
    Abstract function defaultAction(); //Action par défaut

    public function execute(){
        //Appelle la bonne méthode du contrôleur i.e soit l’action par défaut (defaultAction), soit l’action dont le nom a été passé dans la requête courante.
        if(is_null($this->request->getAction()))
        {
            $this->defaultAction();
        }
        else 
        {
            $action = $this->request->getAction();
            $this-> $action();
        }
    }

    public function protection($type_specifique=NULL)
    //On empêche l'accès aux personnes non connectées et si $type_specifique est défini, il permet de réserver l'accès à un type d'utilisateur
    {
        $user = $this->request->getUserObject();
        if(!is_object($user))
        {
            throw new Error('Vous devez être connectés', 401);
        }
        elseif (isset($type_specifique)&&$user->TYPE_UTILISATEUR!=$type_specifique) 
        {
            throw new Error("Vous n'avez pas les droits requis", 403);
        }
    }

    public function linkTo($controller,$action=NULL, $params = array())
    //Assure la redirection, le $controller sur NULL donnera Anonymous, $action sur NULL donnera DefaultAction
    {
        $params['controller'] = $controller;
        $params['action'] = $action;
        header('Location:'.__BASE_URL.'/index.php?'.http_build_query($params));
        exit();
    }

    public function linkToID($controller,$action=NULL,$id)
    //Assure la redirection, le $controller sur NULL donnera Anonymous, $action sur NULL donnera DefaultAction
    {
        header('Location:'.__BASE_URL.'/index.php?controller='.$controller.'&action='.$action.'&id='.$id);
        exit();
    }
}
?>