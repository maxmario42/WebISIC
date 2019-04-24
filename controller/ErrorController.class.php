<?php

class ErrorController extends Controller
/*
Ce controleur gère les erreurs. Il dispose de sa propre méthode execute.
*/
{
    private $error;

    public function __construct($request) 
    {
        parent::__construct($request);
    }

    public function defaultAction()
    {
        http_response_code($this->error->getCode());
        $view = new View($this, 'error');
        $view->setArg('error', $this->error);
        if (is_object($this->request->getUserObject()))//Si un utilisateur est connecté
        {
            $view->setArg('user',$this->request->getUserObject()); //Permet de maintenir la présence de l'utilisateur dans la barre de menu
        }
        $view->render();
    }

    public function execute()
    {
        return $this->defaultAction();
    }

    public function setError(Error $error)
    {
        $this->error = $error;
    }
}
?>