<?php
// Load my root class 
require_once(__ROOT_DIR . '/classes/MyObject.class.php');

class Request extends MyObject{

    private static $request;

    public static function getCurrentRequest(){
        return self::$request;
    }
}