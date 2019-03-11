<?php

class Trajet extends Model
{
    private $idTypeTrajet;
    private $typeTrajet;
    private $idUser;
    private $user;
    private $place;
    private $bloquer;

    private $participants;
    private $etapes;
    private $vehicules;
    private $moderators;

    public static function getTableName()
    {
        return 'TRAJET';
    }
    public static function getColumns()
    {
        return array(
            'ID_USER',
            'ID_TYPE_TRAJET',
            'PLACE',
            'BLOQUER',
        );
    }
    
    public function getError()
    {
        // @TODO
        return false;
    }

    public function getPlacesRestantes()
    {
        return $this->getPlace() - count($this->getParticipants());
    }
    public function isFull()
    {
        return $this->getBloquer() || $this->getPlacesRestantes() <= 0;
    }
    
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
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
    public function setUser(User $user)
    {
        $this->setIdUser($user->getId());
        $this->user = $user;
        return $this;
    }
    public function setIdTypeTrajet($idTypeTrajet)
    {
        $this->idTypeTrajet = $idTypeTrajet;
        return $this;
    }
    public function getIdTypeTrajet()
    {
        $this->load();
        return $this->idTypeTrajet;
    }
    public function getTypeTrajet()
    {
        if (null === $this->typeTrajet || $this->typeTrajet->getId() != $this->getIdTypeTrajet()) {
            $this->typeTrajet = TypeTrajet::find($this->getIdTypeTrajet());
        }
        return $this->typeTrajet;
    }
    public function setTypeTrajet(TypeTrajet $typeTrajet)
    {
        $this->setIdTypeTrajet($typeTrajet->getId());
        $this->typeTrajet = $typeTrajet;
        return $this;
    }

    public function getPlace()
    {
        return $this->place;
    }
    public function setPlace($place)
    {
        $this->place = $place;
        return $this;
    }
    public function getBloquer()
    {
        return $this->bloquer;
    }
    public function setBloquer($bloquer)
    {
        $this->bloquer = $bloquer;
        return $this;
    }

    public function getParticipants()
    {
        if (null === $this->participants) {
            $this->participants = Participants::findBy(array("ID_TRAJET" => $this->getId()));
        }
        return $this->participants;
    }
    public function addParticipant(Participants $participant)
    {
        $participant->setTrajet($this);
        $this->participants = null; // @TODO improve add
        return $this;
    }
    public function removeParticipant(Participant $participant)
    {
        $participant->delete();
        $this->participants = null; // @TODO improve delete
        return $this;
    }
    public function getEtapes()
    {
        if (null === $this->etapes) {
            $this->etapes = Etape::findBy(array("ID_TRAJET" => $this->getId()));
        }
        return $this->etapes;
    }
    public function addEtape(Etape $etape)
    {
        $etape->setTrajet($this);
        $this->etapes = null; // @TODO improve add
        return $this;
    }
    public function removeEtape(Etape $etape)
    {
        $etape->delete();
        $this->etapes = null; // @TODO improve delete using time
        return $this;
    }
    public function getVehicules()
    {
        if (null === $this->vehicules) {
            $this->vehicules = VehiculeTrajet::findBy(array("ID_TRAJET" => $this->getId()));
        }
        return $this->vehicules;
    }
    public function addVehicule(Vehicule $vehicule)
    {
        $vehicule->setTrajet($this);
        $this->vehicules = null; // @TODO improve add
        return $this;
    }
    public function removeVehicule(Vehicule $vehicule)
    {
        $vehicule->delete();
        $this->vehicules = null; // @TODO improve delete using time
        return $this;
    }
    public function getModerators()
    {
        if (null === $this->moderators) {
            $this->moderators = TrajetModerator::findBy(array("ID_TRAJET" => $this->getId()));
        }
        return $this->moderators;
    }
    public function setModerators($moderators)
    {
        $this->moderators = $moderators;
        return $this;
    }
    public function addModerator(TrajetModerator $moderator)
    {
        $moderator->setTrajet($this);
        $this->moderators = null; // @TODO improve add
        return $this;
    }
    public function removeModerator(TrajetModerator $moderator)
    {
        $moderator->delete();
        $this->moderators = null; // @TODO improve delete
        return $this;
    }
    
    public function isCreator(User $user)
    {
        return $this->getIdUser() == $user->getId();
    }

    public function isAdmin(User $user)
    {
        return $user->getAdmin() || $this->isCreator($user);
    }
    
    public function isModerator(User $user)
    {
        if ($this->isAdmin($user)) {
            return true;
        }
        foreach ($this->getModerators() as $moderator) {
            if ($moderator->getIdUser() == $user->getId()) {
                return true;
            }
        }
        return false;
    }
    public function isSignup(User $user)
    {
        if ($this->isCreator($user)) {
            return true;
        }
        foreach ($this->getParticipants() as $participant) {
            if ($participant->getIdUser() == $user->getId()) {
                return true;
            }
        }
        return false;
    }
}
