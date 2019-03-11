<?php

class GroupeUser extends Model
{
    private $idGroupe;
    private $groupe;
    private $idUser;
    private $user;

    public static function getTableName()
    {
        return 'GROUPE_USER';
    }
    public static function getColumns()
    {
        return array(
            'ID_GROUPE',
            'ID_USER',
        );
    }
    public static function getWhereClause()
    {
        return "WHERE ID_GROUPE = ? AND ID_USER = ?";
    }
    public function getWhereOptions()
    {
        return array($this->getIdGroupe(), $this->getIdUser());
    }

    public function getError()
    {
        return false;
    }

    public function setIdGroupe($idGroupe)
    {
        $this->idGroupe = $idGroupe;
        return $this;
    }
    public function getIdGroupe()
    {
        return $this->idGroupe;
    }
    public function setGroupe(Groupe $groupe)
    {
        $this->setIdGroupe($groupe->getId());
        return $this;
    }
    public function getGroupe()
    {
        if (null === $this->groupe) {
            $this->groupe = Groupe::find($this->getIdGroupe());
        }
        return $this->groupe;
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
