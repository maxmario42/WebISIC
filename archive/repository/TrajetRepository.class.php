<?php

class TrajetRepository extends Repository
{
    public function findFromTo($startId, $endId, $startTime, $endTime)
    {
        $db = DatabasePDO::getCurrentPDO();
        return $this->generateArrayFromResults($db->query(
            "SELECT ".$this->model::getTableName().".* FROM ".$this->model::getTableName()."
            JOIN ETAPE as START ON START.ID_TRAJET = TRAJET.ID_TRAJET
            JOIN ETAPE as END ON END.ID_TRAJET = TRAJET.ID_TRAJET
            WHERE START.ID_LIEU = ? AND END.ID_LIEU = ?
            AND START.HEURE < END.HEURE
            AND START.HEURE > ?
            AND START.HEURE < ?
            ORDER BY START.HEURE",
            // AND ( // Trajet complet ==> grisé
            //     SELECT COUNT(*) FROM PARTICIPANTS WHERE PARTICIPANTS.ID_TRAJET = TRAJET.ID_TRAJET
            // ) < TRAJET.PLACE",
            array($startId, $endId, $startTime->format("Y-m-d H:i:s"), $endTime->format("Y-m-d H:i:s"))
        ));
    }

    public function topCreators($limit = 10)
    {
        $db = DatabasePDO::getCurrentPDO();
        return $db->query(
            "SELECT ID_USER, COUNT(ID_TRAJET) AS COUNT FROM ".$this->model::getTableName()." GROUP BY ID_USER ORDER BY COUNT DESC LIMIT ".$limit
        );
    }

    public function findCurrentForUser($id)
    {
        $db = DatabasePDO::getCurrentPDO();
        return $this->generateArrayFromResults($db->query(
            "SELECT DISTINCT ".$this->model::getTableName().".".$this->model::getIdColumn().", ".$this->model::getTableName().".* FROM ".$this->model::getTableName()."
            JOIN ETAPE ON ETAPE.ID_TRAJET = TRAJET.ID_TRAJET
            WHERE ID_USER = ? AND ETAPE.HEURE > ?",
            array($id, (new DateTime())->format('Y-m-d H:i:s'))
        ));

    }
}
