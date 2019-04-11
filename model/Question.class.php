<?php

Class Question extends Model{

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
}

?>