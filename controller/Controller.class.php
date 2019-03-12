<?php

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
        $this->$action();
    }
    abstract public function defaultAction(); //action par défaut du contrôleur. Une action peut nécessiter des paramètres qui doivent être présents dans la requête courante.

}
?>