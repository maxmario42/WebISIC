<?php

class DatabasePDO extends MyObject
{
    private static $_instance = null;
    private $conn;
    public function __construct()
    {
        $this->conn = new PDO(
            'mysql:host='._MYSQL_HOST.':'._MYSQL_PORT.';dbname='._MYSQL_DBNAME,
            _MYSQL_USER,
            _MYSQL_PASSWORD,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
        );
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public static function getCurrentPDO()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new DatabasePDO();
        }
        return self::$_instance;
    }

    /*public function query($sql, $options = array(), $fetch = PDO::FETCH_ASSOC)
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($options);
        if ($fetch == false) {
            return;
        }
        return $qres = $stmt->fetchAll();
    }*/

    public function lastInsertId()
    {
        return $this->conn->lastInsertId();
    }
}
