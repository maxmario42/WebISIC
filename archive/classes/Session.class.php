<?php

class Session
{
    private static $_instance;
    private function __construct()
    {
        $this->startSession();
    }
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Session();
        }
        return self::$_instance;
    }
    public function startSession()
    {
        session_start();
    }
    public function __set($name, $value)
    {
        $_SESSION[$name] = $value;
    }
    public function __get($name)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
    }
    public function __isset($name)
    {
        return isset($_SESSION[$name]);
    }
    public function destroy()
    {
        session_start();
        session_destroy();
    }
}
