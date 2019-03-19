<?php

class Session
/*
Cette classe gère la session en cours
*/
/*
{
    private static $_instance;
    private function __construct()
    //Début de la session
    {
        $this->startSession();
    }
    public static function getInstance()
    //Permet d'obtenir la session en cours
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Session();
        }
        return self::$_instance;
    }
    public function startSession()
    //Ouvre une session
    {
        session_start();
    }
    public function __set($name, $value)
    //Permet de définir la session
    {
        $_SESSION[$name] = $value;
    }
    public function __get($name)
    //Retourne une session en cours
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
    }
    public function __isset($name)
    //Vérifie l'existance d'une session
    {
        return isset($_SESSION[$name]);
    }
    public function destroy()
    //Fin d'une session
    {
        session_start();
        session_destroy();
    }
*/
}
