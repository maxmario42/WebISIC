<?php

class DatabasePDO extends MyObject {

    private static $pdo = null;

    public static function getCurrentpdo() {

        if(is_null(static::$pdo)) {
            static::$pdo = new static();
        }
        static::connect();
        return static::$pdo;
        }
    public static function connect(){
        static::$pdo =new PDO(
            //Connexion à la base de données
            'mysql:host='._MYSQL_HOST.':'._MYSQL_PORT.';dbname='._MYSQL_DBNAME,
            _MYSQL_USER,
            _MYSQL_PASSWORD,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
        );
        static::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
?>

<?php
/*
class DatabasePDO extends MyObject
/*
Encapsule un objet PDO.
Design patter Singleton
*/
/*
{
    private static $instance = null;
    private $conn;
    public function __construct()
    {
        $this->conn = new PDO(
            //Connexion à la base de données
            'mysql:host='._MYSQL_HOST.':'._MYSQL_PORT.';dbname='._MYSQL_DBNAME,
            _MYSQL_USER,
            _MYSQL_PASSWORD,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
        );
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public static function getCurrentPDO()
    //Gestion de l'unique instance
    {
        if (is_null(self::$instance)) {
            self::$instance = new DatabasePDO();
        }
        return self::$instance;
    }

    /*
    public function query($sql)
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    */
    /*
    public function query($sql)
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE);
        $stmt->execute();

        $data->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function lastInsertId()
    {
        return $this->conn->lastInsertId();
    }
}
*/
?>