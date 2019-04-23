<?php
class Participer extends Model
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
            'TITRE',
            'DATE_PARTICIPATION',
            'CLASSEMENT',
            'SCORE',
        );
    }

    public static function getIDColumn()
    {
        return "";
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
        $st = static::db()->query("UPDATE PARTICIPER SET SCORE=1, CLASSEMENT=1 WHERE ID = $ID AND IDQ=$IDQ");
    }

    public static function abandon($ID,$IDQ)
    {
        $st = static::db()->query("DELETE FROM PARTICIPER WHERE ID =$ID AND IDQ=$IDQ");
    }
}