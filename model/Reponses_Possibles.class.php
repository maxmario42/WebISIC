<?php

Class Reponses_Possibles extends Model
{

    public static function getTableName()
    {
        return 'REPONSES_POSSIBLES';
    }

    public static function getColumns()
    {
        return array(
            'ID_REPONSE',
            'ID_QUEST',
            'ENONCE',
            'CORRECT',
            'COLONNE1OU2'
        );
    }

    public static function getIDColumn()
    {
        return 'ID_REPONSE';
    }

    public static function create($idq, $enonce, $correct, $colonne)
    {
        static::db()->exec("INSERT INTO REPONSES_POSSIBLES (ID_QUEST,ENONCE,CORRECT,COLONNE1OU2) VALUES ($idq,'$enonce',$correct,$colonne)");
    }

    public static function update($idr,$idq,$enonce, $correct, $colonne)
    {
        static::db()->exec("UPDATE REPONSES_POSSIBLES SET ID_QUEST=$idq, ENONCE='$enonce',CORRECT=$correct,COLONNE1OU2=$colonne WHERE ID_REPONSE=$idr");
    }
}

?>