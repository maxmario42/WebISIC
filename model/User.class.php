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
    
    public static function create($nom, $prenom, $mail, $matricule, $statut, $promo, $annee, $mdp, $login) 
    {
        if(isset($matricule)&&isset($statut))
        {
            static::db()->exec("INSERT INTO UTILISATEUR (nom,prenom,type_utilisateur,matricule,statut,mail_enseignant,mdp,login) VALUES('$nom', '$prenom', 'Enseignant','$matricule','$statut','$mail','$mdp','$login')");
        }
        else
        {
            static::db()->exec("INSERT INTO UTILISATEUR (nom,prenom,type_utilisateur,promo,annee_de_sortie,mail_etudiant,mdp,login) VALUES('$nom', '$prenom', 'Etudiant','$promo','$annee','$mail','$mdp','$login')");
        }
        
        return static::tryLogin($login, $mdp);
    }

    public static function update($oldLogin, $type, $nom, $prenom, $mail, $spe1, $spe2, $mdp, $login)
    {
        if($type=='Enseignant'){
            static::db()->exec("UPDATE UTILISATEUR SET nom='$nom',prenom='$prenom',type_utilisateur='Enseignant',matricule='$spe1',statut='$spe2',mail_enseignant='$mail',mdp='$mdp',login='$login' WHERE LOGIN='$oldLogin'");
        }
        else
        {
            static::db()->exec("UPDATE UTILISATEUR SET nom='$nom',prenom='$prenom',type_utilisateur='Etudiant',promo='$spe1',annee_de_sortie='$spe2',mail_etudiant='$mail',mdp='$mdp',login='$login' WHERE LOGIN='$oldLogin'");
        }
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
