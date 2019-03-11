<?php

class Etudiant extends Model
{
    private $user;
    private $idPromotion;
    private $promotion;

    public static function getTableName()
    {
        return 'ETUDIANT';
    }

    public static function getIdColumn()
    {
        return 'ID_USER';
    }

    public static function getColumns()
    {
        return array(
            'ID_PROMOTION',
        );
    }

    public function getError()
    {
        if (!Validator::entity($this->getUser())) {
            return "L'utilisateur nexiste pas";
        }
        if (!Validator::entity($this->getPromotion())) {
            return "La promotion n'existe pas";
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
    public function setIdPromotion($idPromotion)
    {
        $this->idPromotion = $idPromotion;
        return $this;
    }
    public function getIdPromotion()
    {
        $this->load();
        return $this->idPromotion;
    }
    public function setPromotion(Promotion $promotion)
    {
        $this->setIdPromotion($promotion->getId());
        return $this;
    }
    public function getPromotion()
    {
        if (null === $this->promotion || $this->promotion->getId() != $this->getIdPromotion()) {
            $this->promotion = Promotion::find($this->getIdPromotion());
        }
        return $this->promotion;
    }
}
