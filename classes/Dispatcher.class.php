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
        return new $controllerName($request);
    }
}
?>