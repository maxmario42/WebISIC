<?php

class Vehicule extends Model
{
    private $idCouleur;
    private $idModele;
    private $idUser;
    private $user;
    
    public static function getTableName()
    {
        return 'VEHICULE';
    }
    public static function getColumns()
    {
        return array(
            'ID_COULEUR',
            'ID_MODELE',
            'ID_USER',
        );
    }
    
    public function getError()
    {
        // @TODO
        return false;
    }

    public function setIdCouleur($idCouleur)
    {
        $this->idCouleur = $idCouleur;
        return $this;
    }
    public function getIdCouleur()
    {
        $this->load();
        return $this->idCouleur;
    }
    public function getCouleur()
    {
        return Couleur::find($this->getIdCouleur());
    }
    public function setIdModele($idModele)
    {
        $this->idModele = $idModele;
        return $this;
    }
    public function getIdModele()
    {
        $this->load();
        return $this->idModele;
    }
    public function getModele()
    {
        return Modele::find($this->getIdModele());
    }
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
        return $this;
    }
    public function setUser(User $user)
    {
        $this->setIdUser($user->getId());
        $this->user = $user;
        return $this;
    }
    public function getIdUser()
    {
        $this->load();
        return $this->idUser;
    }
    public function getUser()
    {
        if (null === $this->user) {
            $this->user = User::find($this->getIdUser());
        }
        return $this->user;
    }
    public function __toString()
    {
        return (string) $this->getModele();
    }
}
