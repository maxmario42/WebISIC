<?php

class User extends Model
{
    private $idLogConnection;
    private $nom;
    private $prenom;
    private $email;
    private $telephone;
    private $password;
    private $admin;
    private $pseudo;
    private $banni;

    private $tripsCreated;
    private $vehicles;
    private $groups;

    public static function getTableName()
    {
        return 'USER';
    }
    public static function getColumns()
    {
        return array(
            'ID_LOG_CONNECTION',
            'NOM',
            'PRENOM',
            'EMAIL',
            'TELEPHONE',
            'PASSWORD',
            'ADMIN',
            'PSEUDO',
            'BANNI',
        );
    }

    public static function create($nom, $prenom, $email, $telephone, $password, $pseudo, $admin = 0, $banni = 0)
    {
        return new self(array(
            'NOM' => $nom,
            'PRENOM' => $prenom,
            'EMAIL' => $email,
            'TELEPHONE' => $telephone,
            'PLAIN_PASSWORD' => $password, // Used to encrypt password
            'ADMIN' => $admin,
            'PSEUDO' => $pseudo,
            'BANNI' => $banni,
        ));
    }
    public function getIdLogConnection()
    {
        $this->load();
        return $this->idLogConnection;
    }
    public function setIdLogConnection(string $idLogConnection)
    {
        $this->idLogConnection = $idLogConnection;
        return $this;
    }
    public function getNom()
    {
        $this->load();
        return $this->nom;
    }
    public function setNom(string $nom)
    {
        $this->nom = $nom;
        return $this;
    }
    public function getPrenom()
    {
        $this->load();
        return $this->prenom;
    }
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }
    public function getEmail()
    {
        $this->load();
        return $this->email;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }
    public function getTelephone()
    {
        $this->load();
        return $this->telephone;
    }
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
        return $this;
    }
    public function getPassword()
    {
        $this->load();
        return $this->password;
    }
    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }
    public function setPlainPassword(string $plainPassword)
    {
        $this->setPassword(hash('sha256', $plainPassword));
        return $this;
    }
    public function getAdmin()
    {
        $this->load();
        return $this->admin;
    }
    public function setAdmin($admin)
    {
        $this->admin = $admin;
        return $this;
    }
    public function getPseudo()
    {
        $this->load();
        return $this->pseudo;
    }
    public function setPseudo(string $pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }
    public function getBanni()
    {
        $this->load();
        return $this->banni;
    }
    public function setBanni($banni)
    {
        $this->banni = $banni;
        return $this;
    }
    public function getTripsCreated()
    {
        if (null === $this->tripsCreated) {
            $this->tripsCreated = Trajet::findBy(array('ID_USER' => $this->getId()));
        }
        return $this->tripsCreated;
    }
    public function getVehicles()
    {
        if (null === $this->vehicles) {
            $this->vehicles = Vehicule::findBy(array('ID_USER' => $this->getId()));
        }
        return $this->vehicles;
    }
    public function getGroups()
    {
        if (null === $this->groups) {
            $this->groups = GroupeUser::findBy(array('ID_USER' => $this->getId()));
        }
        return $this->groups;
    }
    public function hasVehicle(vehicule $vehicle)
    {
        foreach ($this->getVehicles() as $v) {
            if ($v->getId() == $vehicle->getId()) {
                return true;
            }
        }
        return false;
    }
    public function getError()
    {
        if (!Validator::string($this->getPseudo(), array('min' => 1, 'max' => 50))) {
            return "Taille de pseudo incorrecte.";
        }
        if (!Validator::string($this->getNom(), array('min' => 1, 'max' => 50))) {
            return "Taille de nom incorrecte.";
        }
        if (!Validator::string($this->getPrenom(), array('min' => 1, 'max' => 50))) {
            return "Taille de prénom incorrecte.";
        }
        if (!Validator::email($this->getEmail())) {
            return "Email incorrect.";
        }
        if (!Validator::string($this->getEmail(), array('min' => 1, 'max' => 255))) {
            return "Taille d'Email incorrecte.";
        }
        if ($this->getTelephone() && !Validator::phone($this->getTelephone())) {
            return "Téléphone incorrect.";
        }
        return false;
    }
    public function isInGroup(Groupe $group)
    {
        foreach ($this->getGroups() as $g) {
            if ($g->getIdGroupe() == $group->getId()) {
                return true;
            }
        }
        return false;
    }
}
