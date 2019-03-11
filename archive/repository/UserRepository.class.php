<?php

class UserRepository extends Repository
{
    public function listByName()
    {
        $db = DatabasePDO::getCurrentPDO();
        return $this->generateArrayFromResults($db->query("SELECT * FROM ".$this->model::getTableName()." ORDER BY NOM ASC"));
    }
}
