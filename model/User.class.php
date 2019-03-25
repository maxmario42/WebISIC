<?php
    class User extends Model {
        
        //protected static $currentUser;

     /*   public function __construct($user) {
			static::$currentUser = $user;
        }*/
        
        /*public function getUser(){
            return static::$currentUser;
        }*/

        private $nom;
        private $prenom;
        private $type_utilisateur;
        protected $id;
        private $matricule;
        private $statut;
        private $mail_enseignant;
        private $promo;
        private $annee_de_sortie;
        private $mail_etudiant;
        private $mdp;
        private $login;

        public static function getTableName()
        {
            return 'UTILISATEUR';
        }
        public static function getColumns()
        {
            return array(
                'NOM',
                'PRENOM',
                'TYPE_UTILISATEUR',
                'ID',
                'MATRICULE',
                'STATUT',
                'MAIL_ENSEIGNANT',
                'PROMO',
                'ANNEE_DE_SORTIE',
                'MAIL_ETUDIANT',
                'MDP',
                'LOGIN',
            );
        }
        
        public static function create($nom, $prenom, $mail_etudiant, $mdp, $login) {
            static::db()->exec("INSERT INTO UTILISATEUR (nom,prenom,type_utilisateur,mail_etudiant,mdp,login) VALUES('$nom', '$prenom', 'Etudiant','$mail_etudiant','$mdp','$login')");
            return static::tryLogin($login, $mdp);
        }
                
        public static function tryLogin($login, $mdp){
            $st = static::db()->query("select  * from UTILISATEUR where login='$login' and mdp='$mdp'");
            $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "User");
            
            $user = $st->fetch(); //PDO::FETCH_ASSOC
            var_dump($user);
            return $user;
        }
	
      /*  public function getId($login){
            return $this->props['ID'];
        }*/

    public function id(){
        return $this->props['ID'];
        
    }

    public static function isLoginUsed ($login){
        $st = static::db()->query("select login from UTILISATEUR where login='$login'");   
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "User");
        $user = $st-> fetch();
        return $user!=null;
    }

    public static function getWithId($userId){
        $st = static::db()->query("select  * from UTILISATEUR where id ='$userId'");
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "User");
        $user = $st-> fetch();
        return $user;
            

    }
    public function login(){
        return $this ->login;

    }

    public function mail(){
        return $this ->mail_etudiant;

    }

    public function prenom(){
        return $this ->prenom;

    }

    public function nom(){
        return $this ->nom;

    }
}
?>
<?php
/*
class User extends Model
{
    private $nom;
    private $prenom;
    private $type_utilisateur;
    private $id;
    private $matricule;
    private $statut;
    private $mail_enseignant;
    private $promo;
    private $annee_de_sortie;
    private $mail_etudiant;
    private $mdp;
    private $login;

    public static function getTableName()
    {
        return 'UTILISATEUR';
    }
    public static function getColumns()
    {
        return array(
            'NOM',
            'PRENOM',
            'TYPE_UTILISATEUR',
            'ID',
            'MATRICULE',
            'STATUT',
            'MAIL_ENSEIGNANT',
            'PROMO',
            'ANNEE_DE_SORTIE',
            'MAIL_ETUDIANT',
            'MDP',
            'LOGIN',
        );
    }
    public static function isloginUsed($key)
    //Teste si le login est déjà utilisé lors d'une incription
    {  
        $db = DatabasePDO::getCurrentPDO();
        $sql = "SELECT LOGIN FROM UTILISATEUR WHERE LOGIN = \"".$key."\";";
       // $sql = "SELECT COUNT(*) FROM UTILISATEUR WHERE LOGIN = \"".$key."\";";
        echo $sql;
        $request = $db->query($sql);
        print_r($request);
        if(sizeof($request)==0){
            return false;
        }else{
            return true;
        }
       // $users=$request->fetchAll(PDO::FETCH_CLASS,'User');
       // return count($users)!=0;

    }

    public function toHtml(){
		echo "<ul><li>LOGIN  :".$this->getLogin()." ";
		echo "<li>NOM    : ".$this->getNom()."</li>";
		echo "<li>PRENOM : ".$this->getPrenom()."</li>";
	}

    public function getError()
    {
        //TODO
    }

    public static function create($nom, $prenom, $type_utilisateur='Invite', $matricule=NULL, $statut=NULL, $mail_enseignant=NULL, $promo=NULL, $annee_de_sortie=NULL, $mail_etudiant=NULL, $mdp=NULL, $login=NULL)
    {
        return new self(array(
            'NOM'=>$nom,
            'PRENOM'=>$prenom,
            'TYPE_UTILISATEUR'=>$type_utilisateur,
            'ID'=>$id,
            'MATRICULE'=>$matricule,
            'STATUT'=>$statut,
            'MAIL_ENSEIGNANT'=>$mail_enseignant,
            'PROMO'=>$promo,
            'ANNEE_DE_SORTIE'=>$annee_de_sortie,
            'MAIL_ETUDIANT'=>$mail_etudiant,
            'MDP'=>$mdp,
            'LOGIN'=>$login,
        ));
    }
    /*
    GETTER ET SETTERS
    Chaque variable possède un getter et un setter. 
    Le getter a pour nom getNomVariable et le setter setNomVariable
    */
    /*
    Variables communes
    */
    /*
    //Gestion de l'ID
    public function getId()
    {
        $this->load();
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    //Gestion du Nom
    public function getNom()
    {
        $this->load();
        return $this->nom;
    }
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    //Gestion du Prénom.
    public function getPrenom()
    {
        $this->load();
        return $this->prenom;
    }
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    //Gestion du type d'utilisateur
    public function getType()
    {
        $this->load();
        return $this->type_utilisateur;
    }
    public function setType($type_utilisateur)
    {
        $this->type_utilisateur = $type_utilisateur;
        return $this;
    }

    /*
    Variables réservées aux profs (NULL pour les autres)
    */
    /*
    //Gestion du matricule de l'enseignant
    public function getMatricule()
    {
        $this->load();
        return $this->matricule;
    }
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;
        return $this;
    }

    //Gestion du statut de l'enseignant
    public function getStatut()
    {
        $this->load();
        return $this->statut;
    }
    public function setStatut($statut)
    {
        $this->statut = $statut;
        return $this;
    }

    //Gestion du mail de l'enseignant
    public function getEmailEnseignant()
    {
        $this->load();
        return $this->email_Enseignant;
    }
    public function setEmailEnseignant($email_Enseignant)
    {
        $this->email_Enseignant = $email_Enseignant;
        return $this;
    }

    /*
    Variables réservées aux étudiants (NULL pour les autres)
    */
    /*
    //Gestion de la promo de l'étudiant
    public function getPromo()
    {
        $this->load();
        return $this->promo;
    }
    public function setPromo($promo)
    {
        $this->promo = $promo;
        return $this;
    }
    
    //Gestion de l'année de sortie de l'étudiant
    public function getAnneeDeSortie()
    {
        $this->load();
        return $this->annee_de_sortie;
    }
    public function setAnneeDeSortie($annee_de_sortie)
    {
        $this->annee_de_sortie = $annee_de_sortie;
        return $this;
    }

    //Gestion du mail de l'étudiant
    public function getEmailEtudiant()
    {
        $this->load();
        return $this->email_Etudiant;
    }
    public function setEmailEtudiant($email_Etudiant)
    {
        $this->email_Etudiant = $email_Etudiant;
        return $this;
    }

    /*
    Variables utilisée pour prof et étudiant connecté
    */
    /*
    //Gestion du mot de passe
    public function getMDP()
    {
        $this->load();
        return $this->mdp;
    }
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
        return $this;
    }
    public function setPlainPassword($plainPassword)
    {
        $this->setPassword(hash('sha256', $plainPassword));
        return $this;
    }

    //Gestion du login
    public function getLogin()
    {
        $this->load();
        return $this->login;
    }
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }
}
*/
?>