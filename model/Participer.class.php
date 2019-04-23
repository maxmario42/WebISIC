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
    //Initialise une participation. Contrôle si la personne a déjà répondue.
    {
        $st = static::db()->query("SELECT * FROM PARTICPER WHERE ID =$ID AND IDQ=$IDQ");   
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, get_called_class());
        $object = $st-> fetch();
        if ($object==null)
        {
            $sth = static::db()->exec("INSERT INTO PARTICIPER (ID,IDQ) VALUES ($ID,$IDQ)");
            return true;
        }
        return false;
    }

    public static function abandon($ID,$IDQ)
    {
        $st = static::db()->query("DELETE FROM PARTICPER WHERE ID =$ID AND IDQ=$IDQ");
    }
}