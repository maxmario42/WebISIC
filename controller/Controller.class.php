<?php
abstract class Controller extends MyObject {
    private $request;
    private $action;
    public function __construct($currentRequest) {
        $this->request = $currentRequest;
    }
    
    Abstract function defaultAction($currentRequest); //Action par défaut

    public function execute(){
        //Appelle la bonne méthode du contrôleur i.e soit l’action par défaut (defaultAction), soit l’action dont le nom a été passé dans la requête courante.
        if(is_null($this->request->getAction())){
            $this->defaultAction($this->request);
        }
        else {
            $action = $this->request->getAction();
            $this-> $action($this->request);
        }
    }
}
?>