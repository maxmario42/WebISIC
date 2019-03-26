<?php
class User extends Model {

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
    public static function getIDColumn()
    {
        return 'ID';
    }
    public static function create($nom, $prenom, $mail_etudiant, $mdp, $login) {
        static::db()->exec("INSERT INTO UTILISATEUR (nom,prenom,type_utilisateur,mail_etudiant,mdp,login) VALUES('$nom', '$prenom', 'Etudiant','$mail_etudiant','$mdp','$login')");
        return static::tryLogin($login, $mdp);
    }
                
    public static function tryLogin($login, $mdp){
        $st = static::db()->query("select  * from UTILISATEUR where login='$login' and mdp='$mdp'");
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "User");
        $user = $st->fetch(); //PDO::FETCH_ASSOCs
        return $user;
    }
	
    public static function isLoginUsed($login){
        $st = static::db()->query("select login from UTILISATEUR where login='$login'");   
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "User");
        $user = $st-> fetch();
        return $user!=null;
    }
}
?>
