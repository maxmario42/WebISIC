<?php
abstract class Controller extends MyObject {
    private $request;
    private $action;
    public function __construct($currentRequest) {
        $this->request = $currentRequest;
    }
    
    Abstract function defaultAction($currentRequest);

    public function execute(){
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

<?php
/*
abstract class Controller extends MyObject
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function execute()
    //Appelle la bonne méthode du contrôleur i.e soit l’action par défaut (defaultAction), soit l’action dont le nom a été passé dans la requête courante.
    { 
        $action = $this->request->getActionName();
        $this->$action($this->request);
    }
    abstract public function defaultAction($request); //action par défaut du contrôleur. Une action peut nécessiter des paramètres qui doivent être présents dans la requête courante.


    public function redirect($url)
    {
        header('Location: '.$url);
        exit();
    }
}
*/
?>