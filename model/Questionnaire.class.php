<?php

Class Questionnaire extends Model{
    public static function getTableName()
    {
        return 'QUESTIONAIRE';
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
            'LIEN_HTTP',
            
        );
    }

    public static function getIDColumn()
    {
        return 'IDQ';
    }
    

   public static function create($id,$titre, $description, $etat,$date_o,$date_f,$mode_access,$lien_http ){
        
     static::db()->exec("INSERT INTO QUESTIONNAIRE ( id, titre, description, etat, date_ouverture, date_fermeture, mode_acces, lien_http) VALUES ('$id',''$titre', '$description', '$etat','$date_o','$date_f','$mode_access','$lien_http')");
     return static::showQuest($titre);
    }


    public static function showQuest($titre){
        $st = static::db()->query("select  * from QUESTIONNAIRE where titre='$titre'");
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Questionnaire");
        $questio = $st->fetch(); //PDO::FETCH_ASSOCs
        return $questio;
    }

    public static function isTitreUsed($titre){
        $st = static::db()->query("select titre from QUESTIONNAIRE where titre='$titre'");   
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Questionnaire");
        $questio = $st-> fetch();
        return $questio!=null;
    }
}

?>