<?php
abstract class Controller extends MyObject {
    private $request;
    private $action;

    //protected $user;

    public function __construct($currentRequest) {
        $this->request = $currentRequest;
        $this->user = User::getWithId($currentRequest->getUser());
    }
    
    Abstract function defaultAction($currentRequest); //Action par défaut

    public function execute(){
        //Appelle la bonne méthode du contrôleur i.e soit l’action par défaut (defaultAction), soit l’action dont le nom a été passé dans la requête courante.
        if(is_null($this->request->getAction()))
        {
            $this->defaultAction($this->request);
        }
        else 
        {
            $action = $this->request->getAction();
            $this-> $action($this->request);
        }
    }

    public function protection()
    //On empêche l'accès aux personnes non connectées
    {
        if(!is_object($this->request->getUserObject()))
        {
            $this->linkTo(NULL); 
        }
    }
    /*
    public function redirect($cle,$params = array())
    {
        header('Location:'.Router::path($cle,$params));
        exit();
    }
    */
    public function linkTo($controller,$action=NULL)
    //Assure la redirection, le $controller sur NULL donnera Anonymous, $action sur NULL donnera DefaultAction
    {
        header('Location:'.__BASE_URL.'/index.php?controller='.$controller.'&action='.$action);
        exit();
    }
}
?>