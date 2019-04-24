<?php
class Participer extends Model
/*
Ce Model gère les participations des utilisateurs à un questionnaire.
*/
{
    public static function getTableName()
    {
        return "PARTICIPER";
    }

    public static function getColumns()
    {
        return array(
            'ID',
            'IDQ',
            'DATE_PARTICIPATION',
            'CLASSEMENT',
            'SCORE',
        );
    }

    public static function getIDColumn()
    {
        return ""; //Pas d'ID car issu d'une relation N-N
    }

    public static function debutParticipation($ID,$IDQ)
    //Initialise une participation. Contrôle aussi si la personne a déjà répondue.
    {
        //On teste si rien n'a été tenté
        $st = static::db()->query("SELECT * FROM PARTICIPER WHERE ID =$ID AND IDQ=$IDQ");   
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Participer');
        $object = $st-> fetch();
        if ($object==null)
        {
            $sth = static::db()->exec("INSERT INTO PARTICIPER (ID,IDQ) VALUES ($ID,$IDQ)");
            return true;
        }
        
        //On teste si une participation n'est pas achevée
        $st = static::db()->query("SELECT * FROM PARTICIPER WHERE ID =$ID AND IDQ=$IDQ AND SCORE IS NULL AND CLASSEMENT IS NULL"); 
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Participer');
        $object = $st-> fetch();
        if ($object!=null)
        {
            return true;
        }
        return false; //Le questionnaire a déjà été complété par la personne
    }

    public static function finParticipation($ID,$IDQ)
    //Conclut une participation
    {
        $score = static::calculScore($ID,$IDQ);
        $st = static::db()->query("UPDATE PARTICIPER SET SCORE=$score, CLASSEMENT=1, DATE_PARTICIPATION=CURDATE() WHERE ID = $ID AND IDQ=$IDQ");
    }

    public static function abandon($ID,$IDQ)
    //Supprime une participation
    {
        $st = static::db()->query("DELETE FROM PARTICIPER WHERE ID =$ID AND IDQ=$IDQ");
    }

    public static function mesParticipation($ID)
    //Récupère les participations d'un utilisateur
    {
        $st = static::db()->query("SELECT * FROM PARTICIPER WHERE ID =$ID AND SCORE IS NOT NULL AND CLASSEMENT IS NOT NULL"); 
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Participer');
        $object = $st-> fetchAll();
        return $object;
    }

    public static function lesParticipation($IDQ)
    //Récupère les participations d'un questionnaire
    {
        $st = static::db()->query("SELECT * FROM PARTICIPER WHERE IDQ =$IDQ AND SCORE IS NOT NULL AND CLASSEMENT IS NOT NULL"); 
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Participer');
        $object = $st-> fetchAll();
        return $object;
    }

    public static function uneParticipation($ID,$IDQ)
    //Récupère les participations d'un utilisateur
    {
        $st = static::db()->query("SELECT * FROM PARTICIPER WHERE ID =$ID AND IDQ=$IDQ AND SCORE IS NOT NULL AND CLASSEMENT IS NOT NULL"); 
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Participer');
        $object = $st-> fetch();
        return $object;
    }

    public static function calculScore($ID,$IDQ)
    //Calcule le score (Mauvais résultat)
    {
        $st = static::db()->query("SELECT SUM(RC.OKPASOK*RQ.PLUS)
        FROM QUESTIONNAIRE AS Q
        JOIN AJOUTER ON Q.IDQ = AJOUTER.IDQ
        JOIN QUESTION AS QU ON QU.ID_QUEST = AJOUTER.ID_QUEST
        JOIN REPONSE_CHOISIE AS RC ON RC.ID_QUEST = QU.ID_QUEST
        JOIN APPARTENIR AS APP ON APP.IDRC = RC.IDRC
        JOIN REPONSES_POSSIBLES AS R ON R.ID_REPONSE= APP.ID_REPONSE
        JOIN REGLES_QUESTIONNAIRE AS RQ ON RQ.ID_REGLES_QUEST = Q.ID_REGLES_QUEST
        JOIN PARTICIPER AS PAR ON PAR.IDQ=Q.IDQ
        JOIN UTILISATEUR AS PARTICIPANT ON PARTICIPANT.ID= RC.ID
        WHERE Q.IDQ=$IDQ AND PARTICIPANT.ID =$ID");
        $object = $st-> fetch();
        return (int)$object[0];
    }
}