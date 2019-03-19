<?php

class Dispatcher extends MyObject{
	private $controller;
    private $controllerClass;
    public static function dispatch($request){
        $controller= $request->getController();
        
        $controllerClass = ucfirst($controller). 'Controller';

        if(!class_exists($controllerClass)){
            throw new Exception('$ControllerName');
        }

        return new $controllerClass($request);
	}
}
?>
<?php
/*
class Dispatcher extends MyObject
{
    /*
    Le dispatcher courant doit permettre d’aiguiller la requête courante sur le bon contrôleur en
fonction des paramètres de la requête.
    */
    /*
    public static function dispatch(Request $request)
    {
        $controllerName = $request->getControllerName();
        //controllerClassName= ucfirst($controllerName.'Controller');
        return new $controllerName($request);

        /*if class_exists($controllerClassName){
                throw exception ('class does not exist')
    }*/
    /*
    }
}
*/
?>