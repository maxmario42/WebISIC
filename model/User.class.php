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

    public static function createEtu($nom, $prenom, $mail, $promo, $annee, $mdp, $login) 
    {
        static::db()->exec("INSERT INTO UTILISATEUR (nom,prenom,type_utilisateur,promo,annee_de_sortie,mail_etudiant,mdp,login) VALUES('$nom', '$prenom', 'Etudiant','$promo','$annee','$mail','$mdp','$login')");
        return static::tryLogin($login, $mdp);
    }

    public static function createProf($nom, $prenom, $mail, $matricule, $statut, $mdp, $login) 
    {
        static::db()->exec("INSERT INTO UTILISATEUR (nom,prenom,type_utilisateur,matricule,statut,mail_enseignant,mdp,login) VALUES('$nom', '$prenom', 'Enseignant','$matricule','$statut','$mail','$mdp','$login')");
        return static::tryLogin($login, $mdp);
    }

    public static function update($oldLogin, $nom, $prenom, $mail_etudiant, $mdp, $login)
    {
        static::db()->exec("UPDATE UTILISATEUR SET nom='$nom',prenom='$prenom',type_utilisateur='Etudiant',mail_etudiant='$mail_etudiant',mdp='$mdp',login='$login' WHERE LOGIN='$oldLogin'");
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
