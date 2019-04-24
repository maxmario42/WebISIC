<?php

class Questionnaire extends Model
/*
Ce Model gère les questionnaires
*/
{

    public static function getTableName()
    {
        return 'QUESTIONNAIRE';
    }

    public static function getColumns()
    {
        return array(
            'IDQ',
            'ID',
            'TITRE',
            'ID_REGLES_QUEST',
            'DESCRIPTION',
            'ETAT',
            'DATE_OUVERTURE',
            'DATE_FERMETURE',
            'MODE_ACCES',
            'LIEN_HTTP',
        );
    }

    public static function getIDColumn()
    {
        return 'IDQ';
    }

    public static function create($id, $titre, $id_regles, $description, $etat, $date_o, $date_f, $mode_access, $lien_http)
    {
        $sth = static::db()->prepare('INSERT INTO QUESTIONNAIRE (id,titre,id_regles_quest,description,etat,date_ouverture,date_fermeture,mode_acces,lien_http)
         VALUES (:id, :titre, :id_regles, :description, :etat,:date_o, :date_f, :mode_access, :lien_http)');

        $res = $sth->execute(array(
            'id' => $id,
            'id_regles' => $id_regles,
            'titre' => $titre,
            'description' => $description,
            'etat' => $etat,
            'date_o' => $date_o,
            'date_f' => $date_f,
            'mode_access' => $mode_access,
            'lien_http' => $lien_http,
        ));
        return static::getWithId(static::db()->lastInsertId());
    }

    public static function update($IDQ, $titre, $description, $etat, $date_o, $date_f, $mode_acces)
    {
        $sth = static::db()->prepare("UPDATE QUESTIONNAIRE SET titre=:titre,description=:description,etat=:etat,date_ouverture=:date_o,date_fermeture=:date_f,mode_acces=:mode_acces WHERE IDQ=:IDQ");
        $sth->execute(array(
            'IDQ' => $IDQ,
            'titre' => $titre,
            'description' => $description,
            'etat' => $etat,
            'date_o' => $date_o,
            'date_f' => $date_f,
            'mode_acces' => $mode_acces,
        ));
        return static::getWithId($IDQ);
    }
}
