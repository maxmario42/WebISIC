<?php

class Dispatcher extends MyObject
{
    public static function dispatch(Request $request)
    {
        $controllerName = $request->getControllerName();
        return new $controllerName($request);
    }
}
