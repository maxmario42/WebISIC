<?php
abstract class Model extends MyObject {
    /*
    Couche d'abstraction pour accéder à notre Base de donnée. Chaque Model dispose de méthodes génériques et spécifiques.
    */
        
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
        if (!isset($this->props[$prop]))
        {
            return "";
        }
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
        $st = static::db()->prepare("select  * from ".static::getTableName()." where ".$IDField." = ?");
        $st->execute([$ID]);
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
        $st = static::db()->query("SELECT  * FROM ".static::getTableName()." WHERE ".$IDField." ='$ID'");
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, get_called_class());
        $objects = $st->fetchAll(); //PDO::FETCH_ASSOCs
        return $objects;
    }
    public static function getAll(){
        //Retourne un ensemble d'objet en fonction d'une ID on peut choisir l'ID voulue avec le deuxième argument
        $st = static::db()->query("SELECT  * FROM ".static::getTableName());
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, get_called_class());
        $objects = $st->fetchAll(); //PDO::FETCH_ASSOCs
        return $objects;
    }
    
    public static function isUsed($value,$field){
        //Permet de savoir si un objet est déjà présent dans le base
        $st = static::db()->query("SELECT ".$field." FROM ".static::getTableName()." WHERE ".$field."='$value'");   
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, get_called_class());
        $object = $st-> fetch();
        return $object!=null;
    }

    public static function deleteWithId($ID){
        //Supprime un objet en fonction d'une ID
        static::deleteWithAnId($ID,static::getIDColumn());
    }

    public static function deleteWithAnId($ID, $IDField){
        //Supprime un objet en fonction d'une ID, on peut choisir l'ID voulue avec le deuxième argument
        $st = static::db()->prepare("DELETE FROM ".static::getTableName()." WHERE ".$IDField." = ?");
        $st->execute([$ID]);
    }
}
?>