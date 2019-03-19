<?php

abstract class Model extends MyObject
/*
Cette classe sert à factoriser les éléments communs à tous les modèles. 
Par exemple, toutes les classes de modèle devront communiquer avec la base de donnée. 
Pour cela, les modèles utiliseront l’unique objet permettant d’accéder à la base de données qui est instance de DatabasePDO.
*/
{
    private $loaded; //La base de donnée est-elle connectée ?
    protected $db; //Base de donnée connectée
    private $id; //ID de l'objet

     abstract public static function getTableName(); //Retourne le nom de la table
     abstract public static function getColumns(); //Retourne les colonnes d'un table
     abstract public function getError(); //Lève une erreur si une colonne n'est pas présente

    public function isValid()
    //Tester la validité d'une requête
    {
        return !$this->getError();
    }

    public function __construct($values = array(), $loaded = true)
    {
        $this->db = DatabasePDO::getCurrentPDO();
        $this->loadData($values);
        $this->loaded = $loaded;
        return $this;
    }

    public function load($override = true)
    //Charge tous les élements 
    {
        if ($this->loaded == false && $this->id !== null) {
            $this->loaded = true;
            $values = $this->db->query("SELECT * FROM ".static::getTableName()." ".static::getWhereClause(), $this->getWhereOptions())[0];
            $this->setId(null);
            $this->loadData($values, $override);
        }
    }

    protected function loadData($values = array(), $override = true)
    //
    {
        foreach ($values as $key => $value) {
            if ($key == static::getIdColumn()) { //Si on est sur la colonne de l'ID
                $this->setId($value);
            } else {
                if ($override || $this->get(static::getLocalName($key)) === null) {
                    $this->set(static::getLocalName($key), $value);
                }
            }
        }
    }

    private function set($field, $value)
    //Permet de définir une valeur sur un colonne donnée
    {
        $this->{'set'.ucfirst($field)}($value);
        return $this;
    }

    private function get($field)
    //Permet de récupérer une valeur d'un colonne donnée
    {
        return $this->{'get'.ucfirst($field)}();
    }
    
    public static function getLocalName($dbname)
    {
        return preg_replace('/ /', '', ucwords(strtolower(preg_replace('/_/', ' ', $dbname))));
    }

    public static function getIdColumn()
    //Permet d'obtenir le colonne Identifiant de notre table
    {
        return 'ID_'.static::getTableName();
    }

    public function getValues()
    //Permet de récupérer les valeurs de chaque colonne dans un Array
    {
        $values = array();
        foreach (static::getColumns() as $column) {
            $values[] = $this->get(static::getLocalName($column));
        }
        return $values;
    }

    public static function getWhereClause()
    //Retourne les conditions de la requête
    {
        return "WHERE ".static::getIdColumn()." = ?";
    }

    public function getWhereOptions()
    //Retourne les ...
    {
        return array($this->getId());
    }

    public function save()
    //Sauvegarde les éléments dans la base
    {
        if ($this->isInDb()) {
            $this->load(false);
            $columns = implode('=?, ', static::getColumns());
            if (strlen($columns)) {
                $columns .= "=?";
            }
            $this->db->query("UPDATE ".static::getTableName()." SET ".$columns." ".static::getWhereClause(), array_merge($this->getValues(), $this->getWhereOptions()), false);
        } else {
            $columns = "(".implode(', ', static::getColumns()).")";
            $mark = "(".implode(', ', array_fill(0, count($this->getColumns()), '?')).")";
            $this->db->query("INSERT INTO ".static::getTableName()." ".$columns." VALUES ".$mark, $this->getValues(), false);
            $this->setId($this->db->lastInsertId());
        }
        return $this;
    }

    public function delete()
    //Suprime une entrée d'une table
    {
        $this->db->query("DELETE FROM ".static::getTableName()." ".static::getWhereClause(), $this->getWhereOptions(), false);
        $this->setId(null);
    }

    public function getId()
    //Renvoie l'ID
    {
        return $this->id;
    }

    private function setId($id)
    //Permet de setter l'ID
    {
        $this->id = $id;
        return $this;
    }

    public function isInDb()
    //Un élément est-il dans la BDD ?
    {
        if (null == $this->getId()) {
            return false;
        }
        $this->load(false);
        return null != $this->getId();
    }
}
?>