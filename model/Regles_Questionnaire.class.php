<?php

class Regles_Questionnaire extends Model
{

    public static function getTableName()
    {
        return 'REGLES_QUESTIONNAIRE';
    }

    public static function getColumns()
    {
        return array(
            'TEMPS_TOTALE',
            'REVENIR_ARRIERE',
            'ID_REGLES_QUEST',
            'PLUS',
            'MOINS',
            'NEUTRE',
        );
    }

    public static function getIDColumn()
    {
        return 'ID_REGLES_QUEST';
    }

    public static function create($temps, $revenir, $plus, $moins, $neutre)
    {
        static::db()->exec("INSERT INTO REGLES_QUESTIONNAIRE (TEMPS_TOTALE, REVENIR_ARRIERE, PLUS, MOINS, NEUTRE) VALUES ($temps,$revenir,$plus,$moins,$neutre)");
        return static::getWithAnId($titre,'TITRE'); //A résoudre
    }

    public static function update($IDRQ, $temps, $revenir, $plus, $moins, $neutre)
    {
        static::db()->exec("UPDATE REGLES_QUESTIONNAIRE SET TEMPS_TOTALE=$temps,REVENIR_ARRIERE=$revenir,PLUS=$plus,MOINS=$moins,NEUTRE=$neutre WHERE ID_REGLES_QUEST=$IDRQ");
        return static::getWithId($IDRQ);
    }
}
