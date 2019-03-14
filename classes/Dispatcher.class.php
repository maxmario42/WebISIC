<?php

class Dispatcher extends MyObject
{
    /*
    Le dispatcher courant doit permettre d’aiguiller la requête courante sur le bon contrôleur en
fonction des paramètres de la requête.
    */
    public static function dispatch(Request $request)
    {
        $controllerName = $request->getControllerName();
        //controllerClassName= ucfirst($controllerName.'Controller');
        return new $controllerName($request);

        /*/if class_exists($controllerClassName){
                throw exception ('class does not exist')
    }*/
    }
}
?>