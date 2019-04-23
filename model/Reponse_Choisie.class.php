<?php

Class Reponse_Choisie extends Model
{

    public static function getTableName()
    {
        return 'REPONSE_CHOISIE';
    }

    public static function getColumns()
    {
        return array(
            'ID_QUEST',
            'IDRC',
            'ID',
            'OKPASOK'
        );
    }

    public static function getIDColumn()
    {
        return 'ID_REPONSE';
    }

    public static function create($idr, $idq, $id, $ok)
    {
       $sth=static::db()->prepare('INSERT INTO REPONSE_CHOISIE (ID_QUEST,ID,OKPASOK) VALUES (:idq,:id,:ok)');
        $sth->execute(array(
            'idq'=>$idq,
            'id'=>$id,
            'ok'=>$ok          
        ));
        $id = static::db()->lastInsertId();
        $sth1 = static::db()->exec("INSERT INTO APPARTENIR (IRC,ID_REPONSE) VALUES ($id,$idr)");
    }

    public static function update($idrc,$idq,$id, $ok)
    {
        $sth=static::db()->prepare("UPDATE REPONSE_CHOISIE SET ID_QUEST=:idq, ID=:id ,OKPASOK=:ok WHERE IDRC=:idrc");
        $sth->execute(array(
            'idrc'=>$idrc,
            'idq'=>$idq,
            'id'=>$id,
            'ok'=>$ok          
        ));
    }

    public static function delete($id,$idq)
    {
        //TODO
    }
}
