<?php

class Lieu extends Model
{
    private $lat;
    private $lon;
    private $address;
    private $nom;

    public static function getTableName()
    {
        return 'LIEU';
    }
    public static function getColumns()
    {
        return array(
            'LAT',
            'LON',
            'ADRESSE',
            'NOM_LIEU',
        );
    }

    public function getError()
    {
        if (!Validator::range($this->getLat(), array('min' => -90, 'max' => 90))) {
            return "Latitude invalide";
        }
        if (!Validator::range($this->getLon(), array('min' => -180, 'max' => 180))) {
            return "Longitude invalide";
        }
        if (!Validator::string($this->getAdresse(), array('min' => 1, 'max' => 255))) {
            return "Addresse invalide";
        }
        if (!Validator::string($this->getNomLieu(), array('min' => 1, 'max' => 50))) {
            return "Nom de lieu invalide";
        }
        return false;
    }

    public function getLat()
    {
        $this->load();
        return $this->lat;
    }
    public function setLat(string $lat)
    {
        $this->lat = $lat;
        return $this;
    }
    public function getLon()
    {
        $this->load();
        return $this->lon;
    }
    public function setLon(string $lon)
    {
        $this->lon = $lon;
        return $this;
    }
    public function getAdresse()
    {
        $this->load();
        return $this->address;
    }
    public function setAdresse(string $address)
    {
        $this->address = $address;
        return $this;
    }
    public function setNomLieu($nom)
    {
        $this->nom = $nom;
        return $this;
    }
    public function getNomLieu()
    {
        $this->load();
        return $this->nom;
    }
    public function __toString()
    {
        return $this->getNomLieu();
    }
}
