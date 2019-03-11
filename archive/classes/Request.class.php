<?php

class Request extends MyObject
{
    private static $_instance = null;
    private $action;
    private $controller;
    private $connection;
    private $user = null;

    public function __construct()
    {
        $this->setController($this->GET('controller'));
        $this->setAction($this->GET('action'));
        $this->user = Session::getInstance()->user;
    }
    public static function getCurrentRequest()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Request();
        }
        return self::$_instance;
    }
    public function getControllerName()
    {
        return $this->controller.'Controller';
    }
    public function getActionName()
    {
        return $this->action.'Action';
    }
    public function getController()
    {
        return $this->controller;
    }
    public function getAction()
    {
        return $this->action;
    }
    public function setAction($action)
    {
        $this->action = $action ?: 'default';
        return $this;
    }
    public function setController($controller)
    {
        $this->controller = ucfirst($controller) ?: 'Anonymous';
        return $this;
    }
    public function GET($key, $default = '')
    {
        if (isset($_GET[$key])) {
            return $_GET[$key];
        }
        return $default;
    }
    public function POST($key, $default = false)
    {
        if (isset($_POST[$key])) {
            return $_POST[$key];
        }
        return $default;
    }
    public function REQUEST($key, $default = false)
    {
        if (isset($_REQUEST[$key])) {
            return $_REQUEST[$key];
        }
        return $default;
    }
    public function set($key, $value)
    {
        $this->{'set'.ucfirst($key)}($value);
        return $this;
    }
    public function setUser($user)
    {
        if (!$user instanceof User) {
            Session::getInstance()->user = $user;
        } else {
            Session::getInstance()->user = $user->getId();
        };
        $this->user = $user;
        return $this;
    }
    public function getUser()
    {
        if ($this->user == null || $this->user instanceof User) {
            return $this->user;
        }
        $this->setUser(User::find($this->user));
        return $this->user;
    }
    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
    public function getConnection()
    {
        return $this->connection;
    }
    public function setConnection($connection)
    {
        $this->connection = $connection;
        return $this;
    }
    public function notify($type, $message)
    {
        $session = Session::getInstance();
        if (!isset($session->notifications)) {
            $session->notifications = array();
        }
        $notifications = $session->notifications;
        $notifications[] = array(
            'type' => $type,
            'message' => $message,
        );
        $session->notifications = $notifications;
    }
    public function resetNotifications()
    {
        Session::getInstance()->notifications = array();
    }
    public function getNotifications()
    {
        return Session::getInstance()->notifications;
    }
}
