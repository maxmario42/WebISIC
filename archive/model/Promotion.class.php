<?php

class Promotion extends Model
{
    private $type;
    private $nom;

    public static function getTableName()
    {
        return 'PROMOTION';
    }
    public static function getColumns()
    {
        return array(
            'TYPE_PROMOTION',
            'NOM_PROMOTION',
        );
    }

    public function getError()
    {
        if (!Validator::string($this->getNomPromotion(), array('min' => 1, 'max' => 15))) {
            return "Nom promotion invalide";
        }
        if (!Validator::string($this->getTypePromotion(), array('min' => 1, 'max' => 15))) {
            return "Type promotion invalide";
        }
        return false;
    }

    public function setTypePromotion($type)
    {
        $this->type = $type;
        return $this;
    }
    public function getTypePromotion()
    {
        $this->load();
        return $this->type;
    }
    public function setNomPromotion($nom)
    {
        $this->nom = $nom;
        return $this;
    }
    public function getNomPromotion()
    {
        $this->load();
        return $this->nom;
    }
    public function __toString()
    {
        return $this->getNomPromotion();
    }
}
