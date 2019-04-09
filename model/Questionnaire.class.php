<?php

Class Questionnaire extends Model{

   public function create($titre, $description, $etat,$date_o,$date_f,$mode_access,$lien_http ){
        /*
    INSERT INTO `QUESTIONNAIRE`(`IDQ`, `ID`, `TITRE`, `ID_REGLES_QUEST`, `DESCRIPTION`, `ETAT`, `DATE_OUVERTURE`, `DATE_FERMETURE`, `MODE_ACCES`, `LIEN_HTTP`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10])
        */
    }


    public static function showQuest($titre){
        $st = static::db()->query("select  * from QUESTIONNAIRE where titre='$titre'");
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Questionnaire");
        $questio = $st->fetch(); //PDO::FETCH_ASSOCs
        return $questio;
    }


    public static function update($IDQ,$titre, $description,$etat,$date_o,$date_f,$mode_acces){
        static::db()->exec("UPDATE QUESTIONNAIRE SET titre='$titre',description='$description',etat='$etat',date_ouverture='$date_o',date_fermeture='$date_f',mode_acces='$mode_acces' WHERE IDQ=$IDQ");
    }
    public static function isTitreUsed($titre){
        $st = static::db()->query("select titre from QUESTIONNAIRE where titre='$titre'");   
        $st ->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Questionnaire");
        $questio = $st-> fetch();
        return $questio!=null;
    }
}

?>