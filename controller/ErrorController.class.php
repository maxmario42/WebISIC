<?php

class ErrorController extends Controller
{
    private $error;

    public function __construct($request) 
    {
        parent::__construct($request);
    }

    public function defaultAction($request)
    {
        $this->linkTo(NULL);
    }

    public function execute()
    {
        http_response_code($this->error->getCode());
        $this->linkTo(NULL);
    }
    
    public function setError(Error $error)
    {
        $this->error = $error;
    }
}
?>