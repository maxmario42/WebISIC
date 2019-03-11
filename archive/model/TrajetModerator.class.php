<?php

class TrajetModerator extends Model
{
    private $idTrajet;
    private $trajet;
    private $idUser;
    private $user;

    public static function getTableName()
    {
        return 'TRAJET_MODERATOR';
    }
    public static function getColumns()
    {
        return array(
            'ID_TRAJET',
            'ID_USER',
        );
    }
    
    public function getError()
    {
        return false;
    }

    public static function getWhereClause()
    {
        return "WHERE ID_TRAJET = ? AND ID_USER = ?";
    }
    public function getWhereOptions()
    {
        return array($this->getIdTrajet(), $this->getIdUser());
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
}
