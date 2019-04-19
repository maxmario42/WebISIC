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
       $sth=static::db()->prepare('INSERT INTO REPONSES_POSSIBLES (ID_QUEST,ENONCE,CORRECT,COLONNE1OU2) VALUES (:idq,:enonce,:correct,:colonne)');
        $sth->execute(array(
            'idq'=>$idq,
            'enonce'=>$enonce,
            'correct'=>$correct,
            'colonne'=>$colonne           
        ));
        
   
    }

    public static function update($idr,$idq,$enonce, $correct, $colonne)
    {
        $sth=static::db()->prepare("UPDATE REPONSES_POSSIBLES SET ID_QUEST=:idq, ENONCE=:enonce ,CORRECT=:correct,COLONNE1OU2=:colonne WHERE ID_REPONSE=:idr");
        $sth->execute(array(
            'idr' => $idr,
            'idq'=>$idq,
            'enonce'=>$enonce,
            'correct'=>$correct,
            'colonne'=>$colonne           
        ));
    }
}


?>