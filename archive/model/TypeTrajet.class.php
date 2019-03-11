<?php

class TypeTrajet extends Model
{
    private $nom;

    public static function getTableName()
    {
        return 'TYPE_TRAJET';
    }
    public static function getColumns()
    {
        return array(
            'NOM_TYPE',
        );
    }

    public function getError()
    {
        if (!Validator::string($this->getNomType(), array('min' => 1, 'max' => 255))) {
            return "Nom Type invalide";
        }
        return false;
    }

    public function setNomType($nom)
    {
        $this->nom = $nom;
        return $this;
    }
    public function getNomType()
    {
        $this->load();
        return $this->nom;
    }
    public function __toString()
    {
        return $this->getNomType();
    }
}
