<?php

class Dispatcher extends MyObject{
    /*
    Le dispatcher courant doit permettre d’aiguiller la requête courante sur le bon contrôleur en
fonction des paramètres de la requête.
    */
	private $controller; //Stocke le nom du controlleur souhaité
    private $controllerClass; //Stocke le nom de la classe du controller souhaité
    public static function dispatch($request){
        $controller= $request->getController();
        
        $controllerClass = ucfirst($controller). 'Controller'; //Les fichiers controlleurs ont un format spécifiques

        if(!class_exists($controllerClass)){
            throw new Exception('$ControllerName');
        }

        return new $controllerClass($request);
	}
}
?>