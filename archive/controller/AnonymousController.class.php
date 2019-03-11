<?php

class AnonymousController extends Controller
{
    public function defaultAction()
    {
        $view = new View($this);
        $view->render();
    }
}
