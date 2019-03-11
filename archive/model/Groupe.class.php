<?php

class Groupe extends Model
{
    private $nom;

    public static function getTableName()
    {
        return 'GROUPE';
    }
    public static function getColumns()
    {
        return array(
            'NOM_GROUPE',
        );
    }

    public function getError()
    {
        if (!Validator::string($this->getNomGroupe(), array('min' => 1, 'max' => 50))) {
            return "Nom groupe invalide";
        }
        return false;
    }
    
    public function setNomGroupe($nom)
    {
        $this->nom = $nom;
        return $this;
    }
    public function getNomGroupe()
    {
        $this->load();
        return $this->nom;
    }
    public function __toString()
    {
        return $this->getNomGroupe();
    }
}
