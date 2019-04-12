<?php

Class Questionnaire extends Model{

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

    public static function create($id,$titre, $description, $etat,$date_o,$date_f,$mode_access,$lien_http)
    {
       static::db()->exec("INSERT INTO QUESTIONNAIRE (id,titre,id_regles_quest,description,etat,date_ouverture,date_fermeture,mode_acces,lien_http) VALUES ($id,'$titre',1,'$description','$etat','$date_o','$date_f','$mode_access','$lien_http')");
       return static::getWithAnId($titre,'TITRE');
    }

    public static function update($IDQ,$titre, $description,$etat,$date_o,$date_f,$mode_acces){
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

?>