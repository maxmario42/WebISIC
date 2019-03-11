<?php

abstract class Controller extends MyObject
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function execute()
    {
        $action = $this->request->getActionName();
        $this->$action();
    }
    abstract public function defaultAction();

    public function redirect($url)
    {
        header('Location: '.$url);
        exit();
    }
}
