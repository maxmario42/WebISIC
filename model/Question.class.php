<?php

class Question extends Model
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
        $sth = static::db()->prepare("INSERT INTO QUESTION (INTITULE,TYPEQ,TEMPS_MAXIMAL) VALUES (:intitule,:typeq,:temps_max)");
        $res = $sth->execute(array(
            'intitule' => $intitule,
            'typeq' => $typeq,
            'temps_max' => $temps_max
        ));
        $id = static::db()->lastInsertId();
        $sth1 = static::db()->exec("INSERT INTO AJOUTER (IDQ,ID_QUEST) VALUES ($idq,$id)");
        return static::getWithId($id);
    }

    public static function getQuestions($idq)
    {
        $st = static::db()->query("SELECT QUESTION.INTITULE, QUESTION.ID_QUEST, QUESTION.TYPEQ, QUESTION.TEMPS_MAXIMAL
        FROM QUESTIONNAIRE
        JOIN AJOUTER on AJOUTER.IDQ=QUESTIONNAIRE.IDQ
        JOIN QUESTION on AJOUTER.ID_QUEST=QUESTION.ID_QUEST
        WHERE QUESTIONNAIRE.IDQ = $idq");
        $st->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Question');
        $object = $st->fetchAll();
        return $object;
    }

    public static function update($idquest, $intitule, $typeq, $temps_max)
    {
        $sth = static::db()->prepare("UPDATE QUESTION SET INTITULE=:intitule,TYPEQ=:typeq,TEMPS_MAXIMAL=:temps_max' WHERE ID_QUEST=:idquest");
        $res = $sth->execute(array(
            'intitule' => $intitule,
            'typeq' => $typeq,
            'temps_max' => $temps_max,
            'idquest' => $idquest
        ));
        return static::getWithId($idquest);
    }

    public static function delete($IDQ, $IDQuest)
    {
        static::db()->exec("DELETE FROM AJOUTER WHERE IDQ=$IDQ AND ID_QUEST=$IDQuest");
        static::deleteWithId($IDQuest);
    }
}
