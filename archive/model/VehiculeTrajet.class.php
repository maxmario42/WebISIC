<?php

class VehiculeTrajet extends Model
{
    private $idVehicule;
    private $vehicule;
    private $idTrajet;
    private $trajet;

    public static function getTableName()
    {
        return 'VEHICULE_TRAJET';
    }
    public static function getColumns()
    {
        return array(
            'ID_VEHICULE',
            'ID_TRAJET',
        );
    }
    
    public function getError()
    {
        return false;
    }

    public static function getWhereClause()
    {
        return "WHERE ID_VEHICULE = ? AND ID_TRAJET = ?";
    }
    public function getWhereOptions()
    {
        return array($this->getIdVehicule(), $this->getIdTrajet());
    }
    public function setIdVehicule($idVehicule)
    {
        $this->idVehicule = $idVehicule;
        return $this;
    }
    public function getIdVehicule()
    {
        return $this->idVehicule;
    }
    public function setVehicule(Vehicule $vehicule)
    {
        $this->setIdVehicule($vehicule->getId());
        return $this;
    }
    public function getVehicule()
    {
        if (null === $this->vehicule) {
            $this->vehicule = Vehicule::find($this->getIdVehicule());
        }
        return $this->vehicule;
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
}
