<?php

class Questionnaire extends Model
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
        //$sql="INSERT INTO QUESTIONNAIRE (id,titre,id_regles_quest,description,etat,date_ouverture,date_fermeture,mode_acces,lien_http)  VALUES($id,$titre,$id_regles,$description,$etat,$date_o,$date_f,$mode_access,$lien_http)";
        
        $sth=static::db()->prepare('INSERT INTO QUESTIONNAIRE (id,titre,id_regles_quest,description,etat,date_ouverture,date_fermeture,mode_acces,lien_http)
         VALUES (:id, :titre, :id_regles, :description, :etat,:date_o, :date_f, :mode_access, :lien_http)');
        
       /* $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->bindParam(':titre',$titre,PDO::PARAM_STR);
        $sth->bindParam(':id_regles',$id_regles,PDO::PARAM_INT);
        $sth->bindParam(':description',$description,PDO::PARAM_STR);
        $sth->bindParam(':etat',$etat,PDO::PARAM_STR);
        $sth->bindParam(':date_o',$date_o);
        $sth->bindParam(':date_f',$date_f);
        $sth->bindParam(':mode_access',$mode_access,PDO::PARAM_STR);
        $sth->bindParam(':lien_http',$lien_http,PDO::PARAM_STR);
        $sth->execute(); */
        
        $sth->execute(array(
            'id' => $id,
            'titre' => $titre,
            'id_regles' => $id_regles,
            'description' => $description,
            'etat' => $etat,
            'date_o' => $date_o,
            'date_f' => $date_f,
            'mode_access' => $mode_access,
            'lien_http' => $lien_http,
        ));
        var_dump(static::db()->lastInsertId());
        return static::db()->lastInsertId();
    }

    public static function update($IDQ, $titre, $description, $etat, $date_o, $date_f, $mode_acces)
    {
        static::db()->exec("UPDATE QUESTIONNAIRE SET titre='$titre',description='$description',etat='$etat',date_ouverture='$date_o',date_fermeture='$date_f',mode_acces='$mode_acces' WHERE IDQ=$IDQ");
    }

    /*
    public static function isTitreUsed($titre){
        $st = static::db()->query("select titre from QUESTIONNAIRE where titre='$titre'");   
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Questionnaire");
        $questio = $st-> fetch();
        return $questio!=null;
    }
    */
}
