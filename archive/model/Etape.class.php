<?php

class Etape extends Model
{
    private $idTrajet;
    private $trajet;
    private $idLieu;
    private $lieu;
    private $heure;

    public static function getTableName()
    {
        return 'ETAPE';
    }
    public static function getColumns()
    {
        return array(
            'ID_TRAJET',
            'ID_LIEU',
            'HEURE',
        );
    }

    public static function getWhereClause()
    {
        return "WHERE ID_TRAJET = ? AND ID_LIEU = ?";
    }
    public function getWhereOptions()
    {
        return array($this->getIdTrajet(), $this->getIdLieu());
    }

    public function getError()
    {
        // @TODO Find how to valid only partially
        // if (!Validator::entity($this->getTrajet())) {
        //     return "Trajet invalide";
        // }
        if (!Validator::date($this->getHeure())) {
            return "Date invalide";
        }
        if (!Validator::entity($this->getLieu())) {
            return "Lieu invalide";
        }
        return false;
    }

    public function setIdTrajet($idTrajet)
    {
        $this->idTrajet = $idTrajet;
        return $this;
    }
    public function getIdTrajet()
    {
        return $this->idTrajet;
    }
    public function setTrajet(Trajet $trajet)
    {
        $this->setIdTrajet($trajet->getId());
        return $this;
    }
    public function getTrajet()
    {
        if (null === $this->trajet) {
            $this->trajet = Trajet::find($this->getIdTrajet());
        }
        return $this->trajet;
    }
    public function setIdLieu($idLieu)
    {
        $this->idLieu = $idLieu;
        return $this;
    }
    public function getIdLieu()
    {
        return $this->idLieu;
    }
    public function setLieu(Lieu $lieu)
    {
        $this->setIdLieu($lieu->getId());
        return $this;
    }
    public function getLieu()
    {
        if (null === $this->lieu) {
            $this->lieu = Lieu::find($this->getIdLieu());
        }
        return $this->lieu;
    }
    public function setHeure($heure)
    {
        $this->heure = $heure;
        return $this;
    }
    public function getHeure()
    {
        $this->load();
        return $this->heure;
    }
}
