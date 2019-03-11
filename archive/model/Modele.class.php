<?php

class Modele extends Model
{
    private $nom;
    private $idMarque;
    private $marque;
    private $annee;

    public static function getTableName()
    {
        return 'MODELE';
    }
    public static function getColumns()
    {
        return array(
            'ID_MARQUE',
            'ANNEE',
            'NOM_MODELE',
        );
    }

    public function getError()
    {
        if (!Validator::string($this->getNomModele(), array('min' => 1, 'max' => 50))) {
            return "Nom de modele invalide.";
        }
        if (!Validator::entity($this->getMarque())) {
            return "Marque invalide.";
        }
        return false;
    }

    public function setIdMarque($idMarque)
    {
        $this->idMarque = $idMarque;
        return $this;
    }
    public function getIdMarque()
    {
        $this->load();
        return $this->idMarque;
    }
    public function setMarque(Marque $marque)
    {
        $this->setIdMarque($marque->getId());
        $this->marque = $marque;
        return $this;
    }
    public function getMarque()
    {
        if (null === $this->marque) {
            $this->marque = Marque::find($this->getIdMarque());
        }
        return $this->marque;
    }
    public function setNomModele($nom)
    {
        $this->nom = $nom;
        return $this;
    }
    public function getNomModele()
    {
        $this->load();
        return $this->nom;
    }
    public function setAnnee(int $annee)
    {
        $this->annee = $annee;
        return $this;
    }
    public function getAnnee()
    {
        $this->load();
        return $this->annee;
    }
    public function __toString()
    {
        return $this->getMarque().' - '.$this->modeleString();
    }
    public function modeleString()
    {
        return $this->getNomModele() . " (" . $this->getAnnee() . ")";
    }
}
