<?php
abstract class Model extends MyObject {
        
    protected $props;
    
    abstract public static function getTableName();
    abstract public static function getColumns();
    abstract public static function getIDColumn();
		
	public function __construct($props = array()) {
		$this->props = $props;
	}
		

	protected static function db(){
    //Renvoie le PDO actuel
		return DatabasePDO::getCurrentpdo();
	}

	protected static function query($sql){
        // Exécute la requête $sql et retourne des objets modèles
		$st = static::db()->query($sql) or die("sql query error ! request : " . $sql);
        $st->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class());
        $object = $st-> fetch();
        return $object;
	}


	public function __get($prop) {
        //Permet de récupérer la valeur de la colonne $prop
		return $this->props[$prop];
	}
	
	public function __set($prop, $val) {
        //Permet de setter la valeur de la colonne $prop
		$this->props[$prop] = $val;
    }
    
    public static function getWithId($ID){
        //Retourne un objet en fonction d'une ID
        return static::getWithAnId($ID,static::getIDColumn());
    }

    public static function getWithAnId($ID, $IDField){
        //Retourne un objet en fonction d'une ID, on peut choisir l'ID voulue avec le deuxième argument
        $st = static::db()->query("select  * from ".static::getTableName()." where ".$IDField." ='$ID'");
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, get_called_class());
        $object = $st-> fetch();
        return $object;
    }

    public static function getAllWithId($ID){
        //Retourne un ensemble d'objet en fonction d'une ID
        return static::getAllWithAnId($ID,static::getIDColumn());
    }

    public static function getAllWithAnId($ID,$IDField){
        //Retourne un ensemble d'objet en fonction d'une ID on peut choisir l'ID voulue avec le deuxième argument
        $st = static::db()->query("SELECT  * from ".static::getTableName()." WHERE ".$IDField." ='$ID'");
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, get_called_class());
        $objects = $st->fetchAll(); //PDO::FETCH_ASSOCs
        
        return $objects;
    }
    
    public static function isUsed($value,$field){
        $st = static::db()->query("select ".$field." from ".static::getTableName()." where ".$field."='$value'");   
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, get_called_class());
        $object = $st-> fetch();
        return $object!=null;
    }
}
?>