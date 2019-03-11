<?php

abstract class Model extends MyObject
{
    private $loaded;
    private $db;
    private $id;

    abstract public static function getTableName();
    abstract public static function getColumns();
    abstract public function getError();

    public function isValid()
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

    public static function __callStatic($name, $arguments)
    {
        $repository = get_called_class().'Repository';
        return (new $repository(get_called_class()))->$name(...$arguments);
    }

    public function load($override = true)
    {
        if ($this->loaded == false && $this->id !== null) {
            $this->loaded = true;
            $values = $this->db->query("SELECT * FROM ".static::getTableName()." ".static::getWhereClause(), $this->getWhereOptions())[0];
            $this->setId(null);
            $this->loadData($values, $override);
        }
    }

    protected function loadData($values = array(), $override = true)
    {
        foreach ($values as $key => $value) {
            if ($key == static::getIdColumn()) {
                $this->setId($value);
            } else {
                if ($override || $this->get(static::getLocalName($key)) === null) {
                    $this->set(static::getLocalName($key), $value);
                }
            }
        }
    }

    private function set($field, $value)
    {
        $this->{'set'.ucfirst($field)}($value);
        return $this;
    }

    private function get($field)
    {
        return $this->{'get'.ucfirst($field)}();
    }
    
    public static function getLocalName($dbname)
    {
        return preg_replace('/ /', '', ucwords(strtolower(preg_replace('/_/', ' ', $dbname))));
    }

    public static function getIdColumn()
    {
        return 'ID_'.static::getTableName();
    }

    public function getValues()
    {
        $values = array();
        foreach (static::getColumns() as $column) {
            $values[] = $this->get(static::getLocalName($column));
        }
        return $values;
    }

    public static function getWhereClause()
    {
        return "WHERE ".static::getIdColumn()." = ?";
    }

    public function getWhereOptions()
    {
        return array($this->getId());
    }

    public function save()
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
    {
        $this->db->query("DELETE FROM ".static::getTableName()." ".static::getWhereClause(), $this->getWhereOptions(), false);
        $this->setId(null);
    }

    public function getId()
    {
        return $this->id;
    }

    private function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function isInDb()
    {
        if (null == $this->getId()) {
            return false;
        }
        $this->load(false);
        return null != $this->getId();
    }
}
