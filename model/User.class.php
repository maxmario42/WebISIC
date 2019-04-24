<?php
class User extends Model
/*
Ce Model gère les utilisateurs.
Il y a deux entrées différentes pour les mails car on voulait gérer des participants sans compte (Juste avec nom et prénom), ça vient de notre MCD
*/
{

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
        if (isset($matricule) && isset($statut)) {
            $sth = static::db()->prepare('INSERT INTO UTILISATEUR (nom,prenom,type_utilisateur,matricule,statut,mail_enseignant,mdp,login) 
                VALUES(:nom, :prenom, "Enseignant", :matricule,:statut, :mail,:mdp,:login)');
            $res = $sth->execute(array(
                'nom' => $nom,
                'prenom' => $prenom,
                'matricule' => $matricule,
                'statut' => $statut,
                'mail' => $mail,
                'mdp' => $mdp,
                'login' => $login
            ));
        } else {
            $sth = static::db()->prepare('INSERT INTO UTILISATEUR (nom,prenom,type_utilisateur,matricule,statut,mail_enseignant,mdp,login) VALUES(:nom, :prenom, "Etudiant", :matricule,:statut, :mail,:mdp,:login)');
            $res = $sth->execute(array(
                'nom' => $nom,
                'prenom' => $prenom,
                'matricule' => $matricule,
                'statut' => $statut,
                'mail' => $mail,
                'mdp' => $mdp,
                'login' => $login
            ));
        }

        return static::tryLogin($login, $mdp);
    }

    public static function update($oldLogin, $type, $nom, $prenom, $mail, $spe1, $spe2, $mdp, $login)
    {
        if ($type == 'Enseignant') {

            $sth = static::db()->prepare("UPDATE UTILISATEUR SET nom=:nom, prenom=:prenom,type_utilisateur='Enseignant',matricule=:spe1, statut=:spe2,mail_enseignant=:mail, mdp=:mdp, login=:login WHERE LOGIN=:oldLogin");
            var_dump($sth);
            $res = $sth->execute(array(

                'nom' => $nom,
                'prenom' => $prenom,
                'spe1' => $spe1,
                'spe2' => $spe2,
                'mail' => $mail,
                'mdp' => $mdp,
                'login' => $login,
                'oldLogin' => $oldLogin
            ));
        } else {
                $sth = static::db()->prepare('UPDATE UTILISATEUR SET nom=:nom, prenom=:prenom,type_utilisateur="Etudiant",matricule=:spe1,statut=:spe2,mail_etudiant=:mail,mdp=:mdp,login=:login WHERE LOGIN=:oldLogin');
                $res = $sth->execute(array(
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'spe1' => $spe1,
                    'spe2' => $spe2,
                    'mail' => $mail,
                    'mdp' => $mdp,
                    'login' => $login,
                    'oldLogin' => $oldLogin
                ));
            }
        return static::tryLogin($login, $mdp);
    }

    public static function tryLogin($login, $mdp)
    {
        $st = static::db()->query("select  * from UTILISATEUR where login='$login' and mdp='$mdp'");
        $st->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "User");
        $user = $st->fetch(); //PDO::FETCH_ASSOCs
        return $user;
    }
}
