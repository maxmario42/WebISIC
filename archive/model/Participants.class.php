<?php

class Participants extends Model
{
    private $idUser;
    private $user;
    private $idTrajet;
    private $trajet;

    public static function getTableName()
    {
        return 'PARTICIPANTS';
    }
    public static function getColumns()
    {
        return array(
            'ID_USER',
            'ID_TRAJET',
        );
    }
    public static function getWhereClause()
    {
        return "WHERE ID_USER = ? AND ID_TRAJET = ?";
    }
    public function getWhereOptions()
    {
        return array($this->getIdUser(), $this->getIdTrajet());
    }
    public function getError()
    {
        return false;
    }
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
        return $this;
    }
    public function getIdUser()
    {
        return $this->idUser;
    }
    public function setUser(User $user)
    {
        $this->setIdUser($user->getId());
        return $this;
    }
    public function getUser()
    {
        if (null === $this->user) {
            $this->user = User::find($this->getIdUser());
        }
        return $this->user;
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
