<?php

class Agent extends Model
{
    private $user;
    private $idLieu;
    private $lieu;
    private $idUnite;
    private $unite;
    private $idFonction;
    private $fonction;

    public static function getTableName()
    {
        return 'AGENT';
    }

    public static function getIdColumn()
    {
        return 'ID_USER';
    }

    public static function getColumns()
    {
        return array(
            'ID_LIEU',
            'ID_UNITE',
            'ID_FONCTION',
        );
    }

    public function getError()
    {
        if (!Validator::entity($this->getUser())) {
            return "L'utilisateur nexiste pas";
        }
        if (!Validator::entity($this->getUnite())) {
            return "L'unité n'existe pas";
        }
        if ($this->getLieu() && !Validator::entity($this->getLieu())) {
            return "Le lieu n'existe pas";
        }
        if ($this->getFonction() && !Validator::entity($this->getFonction())) {
            return "L'utilisateur nexiste pas";
        }
        return false;
    }

    public function setUser(User $user)
    {
        $this->setId($user->getId());
        return $this;
    }
    public function getUser()
    {
        if (null === $this->user || $this->user->getId() != $this->getId()) {
            $this->user = User::find($this->getId());
        }
        return $this->user;
    }
    public function setIdLieu($idLieu)
    {
        $this->idLieu = $idLieu;
        return $this;
    }
    public function getIdLieu()
    {
        $this->load();
        return $this->idLieu;
    }
    public function setLieu(Lieu $lieu)
    {
        $this->setIdLieu($lieu->getId());
        return $this;
    }
    public function getLieu()
    {
        if ($this->getIdLieu() === null) {
            return null;
        }
        if (null === $this->lieu || $this->lieu->getId() != $this->getIdLieu()) {
            $this->lieu = Lieu::find($this->getIdLieu());
        }
        return $this->lieu;
    }
    public function setIdUnite($idUnite)
    {
        $this->idUnite = $idUnite;
        return $this;
    }
    public function getIdUnite()
    {
        $this->load();
        return $this->idUnite;
    }
    public function setUnite(Unite $unite)
    {
        $this->setIdUnite($unite->getId());
        return $this;
    }
    public function getUnite()
    {
        if (null === $this->unite || $this->unite->getId() != $this->getIdUnite()) {
            $this->unite = Unite::find($this->getIdUnite());
        }
        return $this->unite;
    }
    public function setIdFonction($idFonction)
    {
        $this->idFonction = $idFonction;
        return $this;
    }
    public function getIdFonction()
    {
        $this->load();
        return $this->idFonction;
    }
    public function setFonction(Fonction $fonction)
    {
        $this->setIdFonction($fonction->getId());
        return $this;
    }
    public function getFonction()
    {
        if ($this->getIdFonction() === null) {
            return null;
        }
        if (null === $this->fonction || $this->fonction->getId() != $this->getIdFonction()) {
            $this->fonction = Fonction::find($this->getIdFonction());
        }
        return $this->fonction;
    }
}
