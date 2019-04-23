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
        return 'IDRC';
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
        $sth1 = static::db()->exec("INSERT INTO APPARTENIR (IDRC,ID_REPONSE) VALUES ($id,$idr)");
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
        $st = static::db()->query("SELECT  * FROM REPONSE_CHOISIE WHERE ID = $id AND ID_QUEST = $idq");
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Reponse_Choisie');
        $objects = $st->fetchAll(); //PDO::FETCH_ASSOCs
        foreach ($objects as $reponse)
        {
            $sth1 = static::db()->exec("DELETE FROM APPARTENIR WHERE IDRC = $reponse->IDRC");
            $sth2 = static::deleteWithId($reponse->IDRC);
        }
    }

    public static function choixQCU($idr, $idq, $id)
    {
        static::delete($id,$idq);
        $ok=Reponses_Possibles::getWithId($idr)->CORRECT;
        static::create($idr,$idq,$id,$ok);
    }

    public static function choixQRL($reponse, $idq, $id)
    {
        static::delete($id,$idq);
        $bonneReponse=Reponses_Possibles::getWithAnId($idq,'ID_QUEST');
        $ok=($bonneReponse->ENONCE==$reponse);
        static::create($bonneReponse->ID_REPONSE,$idq,$id,$ok);
    }
}
