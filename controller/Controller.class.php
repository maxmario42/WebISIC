<?php
abstract class Controller extends MyObject {
    private $request;
    private $action;

    protected $user;

    public function __construct($currentRequest) {
        $this->request = $currentRequest;
        $this->user = User::getWithId(Request::getUser());
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
        if(!is_object($this->user))
        {
            header("Location: index.php"); 
        }
    }

    public function redirect($url)
    {
        header('Location: '.$url);
        exit();
    }

}
?>