<?php
class DatabasePDO extends MyObject {

    /*
    Encapsule un objet PDO.
    Design patter Singleton
    */
    private static $pdo = null;

    public static function getCurrentpdo() {
        //Gestion de l'unique instance
        if(is_null(static::$pdo)) {
            static::$pdo = new static();
            static::connect();
        }
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

   /* public function lastInsertId()
    {
        return static::$pdo->lastInsertId();
    }*/
}
?>