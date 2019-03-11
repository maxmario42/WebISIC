<?php

class ErrorController extends Controller
{
    private $error;

    public function defaultAction()
    {
        $view = new View($this, 'error/error');
        $view->setArg('error', $this->error);
        $view->render();
    }

    public function execute()
    {
        $method = 'e'.$this->error->getCode().'Action';
        if (!method_exists($this, $method)) {
            return $this->defaultAction();
        }
        return $this->$method();
    }

    public function e404Action()
    {
        http_response_code(404);
        $view = new View($this, 'error/404');
        $view->setArg('error', $this->error);
        $view->render();
    }

    public function e500Action()
    {
        http_response_code(500);
        $view = new View($this, 'error/500');
        $view->setArg('error', $this->error);
        $view->render();
    }

    public function e403Action()
    {
        http_response_code(403);
        $view = new View($this, 'error/403');
        $view->setArg('error', $this->error);
        $view->render();
    }
    
    public function setError(Error $error)
    {
        $this->error = $error;
    }
}
