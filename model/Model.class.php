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
        //Retourne un objet en fonction de son ID
        $st = static::db()->query("select  * from ".static::getTableName()." where ".static::getIDColumn()." ='$ID'");
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, get_called_class());
        $object = $st-> fetch();
        return $object;
    }
    public static function getAllWithId($IDField,$ID){
        //Retourne un ensemble d'objet en fonction d'une ID
        $qresults = static::db()->query("select  * from ".static::getTableName()." where ".$IDField." ='$ID'");
        $results = array();
        foreach ($qresults as $result) {
            if (count($result)) {
                $results[] = new $this->get_called_class($result);
            }
        }
        return $results;
    }
}
?>