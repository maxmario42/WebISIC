<?php

class LogConnectionRepository extends Repository
{
    public function countByIdIp($ip, $date)
    {
        $db = DatabasePDO::getCurrentPDO();
        return $db->query(
            "SELECT COUNT(*) FROM ".$this->model::getTableName()." WHERE ID_IP = ? AND DATE > ?",
            array($ip, $date->format("Y-m-d H:i:s"))
            )[0]['COUNT(*)'];
    }

    public function countNumberAccountCreation($id, $date)
    {
        $db = DatabasePDO::getCurrentPDO();
        return $db->query(
            "SELECT COUNT(*) FROM ".$this->model::getTableName()."
                INNER JOIN USER ON USER.ID_LOG_CONNECTION = LOG_CONNECTION.ID_LOG_CONNECTION
                WHERE ID_IP = ? AND LOG_CONNECTION.DATE > ?",
            array($id, $date->format("Y-m-d H:i:s"))
            )[0]['COUNT(*)'];
    }
}
