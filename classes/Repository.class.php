<?php
/*
abstract class Repository extends MyObject
{
    protected $model;
    
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function find($id)
    {
        return new $this->model(array($this->model::getIdColumn() => $id), false);
    }

    public function findAll()
    {
        $db = DatabasePDO::getCurrentPDO();
        return $this->generateArrayFromResults($db->query("SELECT * FROM ".$this->model::getTableName()));
    }
    
    public function findBy(array $fieldValue)
    {
        $db = DatabasePDO::getCurrentPDO();
        return $this->generateArrayFromResults($db->query(
            "SELECT * FROM ".$this->model::getTableName()." WHERE ".implode('= ? AND ', array_keys($fieldValue))." = ?",
            array_values($fieldValue)
        ));
    }
    
    public function findOneBy(array $fieldValue)
    {
        $db = DatabasePDO::getCurrentPDO();
        return new $this->model($db->query(
            "SELECT * FROM ".$this->model::getTableName()." WHERE ".implode('= ? AND ', array_keys($fieldValue))." = ? LIMIT 1",
            array_values($fieldValue)
        )[0]);
    }
    
    public function countBy($field, $value)
    {
        $db = DatabasePDO::getCurrentPDO();
        return $db->query("SELECT COUNT(*) FROM ".$this->model::getTableName()." WHERE ".$field." = ?", array($value))[0]['COUNT(*)'];
    }

    public function countAll()
    {
        $db = DatabasePDO::getCurrentPDO();
        return $db->query("SELECT COUNT(*) FROM ".$this->model::getTableName())[0]['COUNT(*)'];
    }

    protected function generateArrayFromResults($qresults)
    {
        $results = array();
        foreach ($qresults as $result) {
            if (count($result)) {
                $results[] = new $this->model($result);
            }
        }
        return $results;
    }
*/
}
?>