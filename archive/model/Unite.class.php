<?php

class Unite extends Model
{
    private $nom;

    public static function getTableName()
    {
        return 'UNITE';
    }
    public static function getColumns()
    {
        return array(
            'NOM_UNITE',
        );
    }
    
    public function getError()
    {
        if (!Validator::string($this->getNomUnite(), array('min' => 1, 'max' => 255))) {
            return "Nom Type invalide";
        }
        return false;
    }

    public function setNomUnite($nom)
    {
        $this->nom = $nom;
        return $this;
    }
    public function getNomUnite()
    {
        $this->load();
        return $this->nom;
    }
    public function __toString()
    {
        return $this->getNomUnite();
    }
}
