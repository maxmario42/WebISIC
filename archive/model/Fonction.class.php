<?php

class Fonction extends Model
{
    private $nom;

    public static function getTableName()
    {
        return 'FONCTION';
    }
    public static function getColumns()
    {
        return array(
            'NOM_FONCTION',
        );
    }

    public function getError()
    {
        if (!Validator::string($this->getNomFonction(), array('min' => 1, 'max' => 50))) {
            return "Nom fonction invalide";
        }
        return false;
    }

    public function setNomFonction($nom)
    {
        $this->nom = $nom;
        return $this;
    }
    public function getNomFonction()
    {
        $this->load();
        return $this->nom;
    }
    public function __toString()
    {
        return $this->getNomFonction();
    }
}
