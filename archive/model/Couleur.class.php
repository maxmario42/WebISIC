<?php

class Couleur extends Model
{
    private $nom;

    public static function getTableName()
    {
        return 'COULEUR';
    }
    public static function getColumns()
    {
        return array(
            'NOM_COULEUR',
        );
    }

    public function getError()
    {
        if (!Validator::string($this->getNomCouleur(), array('min' => 1, 'max' => 50))) {
            return "Nom de couleur invalide.";
        }
        return false;
    }

    public function setNomCouleur($nom)
    {
        $this->nom = $nom;
        return $this;
    }
    public function getNomCouleur()
    {
        $this->load();
        return $this->nom;
    }
    public function __toString()
    {
        return $this->getNomCouleur();
    }
}
