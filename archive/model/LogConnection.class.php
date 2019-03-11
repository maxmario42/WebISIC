<?php

class LogConnection extends Model
{
    private $idIp;
    private $date;
    public static function getTableName()
    {
        return 'LOG_CONNECTION';
    }
    public static function getColumns()
    {
        return array(
            'ID_IP',
            'DATE',
        );
    }

    public function getError()
    {
        return false;
    }

    public function getIdIp()
    {
        $this->load();
        return $this->idIp;
    }
    public function setIdIp($idIp)
    {
        $this->idIp = $idIp;
        return $this;
    }
    public function getDate()
    {
        $this->load();
        return $this->date;
    }
    public function setDate($date)
    {
        $this->date = $date->format("Y-m-d H:i:s");
        return $this;
    }
}
