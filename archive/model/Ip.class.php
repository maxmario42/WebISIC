<?php

class Ip extends Model
{
    private $ip;
    private $ipBanni;
    public static function getTableName()
    {
        return 'IP';
    }
    public static function getColumns()
    {
        return array(
            'IP',
            'IP_BANNI',
        );
    }

    public function getError()
    {
        return false;
    }

    public function getIp()
    {
        $this->load();
        return $this->ip;
    }
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }
    public function getIpBanni()
    {
        $this->load();
        return $this->ipBanni;
    }
    public function setIpBanni($ipBanni)
    {
        $this->ipBanni = $ipBanni;
        return $this;
    }
    public function __toString()
    {
        return $this->getIp();
    }
}
