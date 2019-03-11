<?php

class EtapeRepository extends Repository
{
    public function find($id)
    {
        static::unsupportedMethod('find');
    }

    public function nbTrajetByDay($minDate)
    {
        $db = DatabasePDO::getCurrentPDO();
        return $db->query(
            "SELECT COUNT(DISTINCT ID_TRAJET) AS COUNT, DATE_FORMAT(HEURE, '%Y-%m-%d') as DAY FROM ".$this->model::getTableName()." WHERE HEURE >= ? GROUP BY DAY ORDER BY DAY DESC",
            array($minDate->format("Y-m-d")." 00:00:00")
        );
    }
    public function nbTrajetByMonth($minDate)
    {
        $db = DatabasePDO::getCurrentPDO();
        return $db->query(
            "SELECT COUNT(DISTINCT ID_TRAJET) AS COUNT, DATE_FORMAT(HEURE, '%Y-%m') as MONTH FROM ".$this->model::getTableName()." WHERE HEURE >= ? GROUP BY MONTH ORDER BY MONTH DESC",
            array($minDate->format("Y-m")."-01 00:00:00")
        );
    }
    public function nbTrajetByYear($minDate)
    {
        $db = DatabasePDO::getCurrentPDO();
        return $db->query(
            "SELECT COUNT(DISTINCT ID_TRAJET) AS COUNT, DATE_FORMAT(HEURE, '%Y') as YEAR FROM ".$this->model::getTableName()." WHERE HEURE >= ? GROUP BY YEAR ORDER BY YEAR DESC",
            array($minDate->format("Y")."-01-01 00:00:00")
        );
    }
    public function topSites($limit = 10)
    {
        $db = DatabasePDO::getCurrentPDO();
        return $db->query(
            "SELECT COUNT(*) as COUNT, ID_LIEU FROM ".$this->model::getTableName()." GROUP BY ID_LIEU ORDER BY COUNT DESC LIMIT ".$limit
        );
    }
}
