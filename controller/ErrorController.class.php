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
        $view = new View($this, 'error/error');
        $view->setArg('error', $this->error);
        if (is_object($this->request->getUserObject()))
        {
            $view->setArg('user',$this->request->getUserObject());
        }
        $view->render();
    }

    public function execute()
    {
        $method = 'e'.$this->error->getCode();
        if (!method_exists($this, $method)) {
            return $this->defaultAction();
        }
        return $this->$method();
    }

    //Les différentes erreurs gérées
    public function e404()
    {
        http_response_code(404);
        $view = new View($this, 'error/404');
        $view->setArg('error', $this->error);
        if (is_object($this->request->getUserObject()))
        {
            $view->setArg('user',$this->request->getUserObject());
        }
        $view->render();
    }

    public function e500()
    {
        http_response_code(500);
        $view = new View($this, 'error/500');
        $view->setArg('error', $this->error);
        if (is_object($this->request->getUserObject()))
        {
            $view->setArg('user',$this->request->getUserObject());
        }
        $view->render();
    }

    public function e403()
    {
        http_response_code(403);
        $view = new View($this, 'error/403');
        $view->setArg('error', $this->error);
        if (is_object($this->request->getUserObject()))
        {
            $view->setArg('user',$this->request->getUserObject());
        }
        $view->render();
    }
    
    public function setError(Error $error)
    {
        $this->error = $error;
    }
}
?>