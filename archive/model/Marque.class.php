<?php

class Marque extends Model
{
    private $nom;

    public static function getTableName()
    {
        return 'MARQUE';
    }
    public static function getColumns()
    {
        return array(
            'NOM_MARQUE',
        );
    }

    public function getError()
    {
        if (!Validator::string($this->getNomMarque(), array('min' => 1, 'max' => 50))) {
            return "Nom de marque invalide.";
        }
        return false;
    }

    public function setNomMarque($nom)
    {
        $this->nom = $nom;
        return $this;
    }
    public function getNomMarque()
    {
        $this->load();
        return $this->nom;
    }
    public function __toString()
    {
        return $this->getNomMarque();
    }
}
