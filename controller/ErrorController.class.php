<?php

class ErrorController extends Controller
/*
Ce controleur gère les erreurs
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
        if (is_object($this->request->getUserObject()))
        {
            $view->setArg('user',$this->request->getUserObject());
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