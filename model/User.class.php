<?php
class User extends Model {
        
        //protected static $currentUser;

     /*   public function __construct($user) {
			static::$currentUser = $user;
        }*/
        
        /*public function getUser(){
            return static::$currentUser;
        }*/
        /*
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
        */
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
       
        return $user;
    }
	
      /*  public function getId($login){
            return $this->props['ID'];
        }*/
        /*
    public function id(){
        return $this->props['ID'];  
    }
    */
    public static function isLoginUsed($login){
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
}
?>
