<?php

Class Question extends Model
{

    public static function getTableName()
    {
        return 'QUESTION';
    }

    public static function getColumns()
    {
        return array(
            'INTITULE',
            'ID_QUEST',
            'TYPEQ',
            'TEMPS_MAXIMAL',
        );
    }

    public static function getIDColumn()
    {
        return 'ID_QUEST';
    }

    public static function create($idq, $intitule, $typeq, $temps_max)
    {
        static::db()->exec("INSERT INTO QUESTIONNAIRE (INTITULE,TYPEQ,TEMPS_MAXIMAL) VALUES ('$intitule','$typeq',$temps_max)");
        static::db()->exec("INSERT INTO AJOUTER (IDQ,ID_QUEST) VALUES ($idq,".PDO::lastInsertId.")");
        return static::getWithId($idq);
    }

    public static function update($idquest, $intitule, $typeq, $temps_max){
        static::db()->exec("UPDATE QUESTIONNAIRE SET INTITULE='$intitule',TYPEQ='$typeq',TEMPS_MAXIMAL='$temps_max' WHERE ID_QUEST=$idquest");
    }
}

?>