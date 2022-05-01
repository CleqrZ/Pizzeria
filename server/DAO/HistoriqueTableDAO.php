<?php

include_once('DTO/HistoriqueTableDTO.php');
class HistoriqueTableDAO
{
    public static function get($id)
    {
        $type = null;

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM historiquetable WHERE idHistoriqueTable = :idHistoriqueTable');
        $state->bindValue(":idHistoriqueTable", $id);
        $state->execute();
        $resultats = $state->fetchAll();

        if (sizeof($resultats) > 0)
        {
            $result = $resultats[0];
            $type = new HistoriqueTableDTO($result["historiqueNumeroTable"],$result["historiqueNbPersonne"]);
            $type->setIdHistoriqueTable($result["idHistoriqueTable"]);
        }

        return $type;
    }

    public static function getList()
    {
        $types = array();

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM historiquetable');
        $state->execute();
        $resultats = $state->fetchAll();

        foreach ($resultats	as $result)
        {
            $type = new HistoriqueTableDTO($result["historiqueNumeroTable"],$result["historiqueNbPersonne"]);
            $type->setIdHistoriqueTable($result["idHistoriqueTable"]);

            $types[] = $type;
        }
        return $types;
    }

    public static function delete($id)
    {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('DELETE FROM historiquetable WHERE idHistoriqueTable = :idHistoriqueTable');
        $state->bindValue(":idHistoriqueTable", $id);
        $state->execute();
    }

    public static function insert($type)
    {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('INSERT INTO historiquetable(historiqueNumeroTable,historiqueNbPersonne) VALUES(:historiqueNumeroTable,:historiqueNbPersonne)');
        $state->bindValue(":historiqueNumeroTable", $type->getHistoriqueNumeroTable());
        $state->bindValue(":historiqueNbPersonne", $type->getHistoriqueNbPersonne());
        $state->execute();

        $type->setIdHistoriqueTable($connex->lastInsertId());
    }

    public static function update($type)
    {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('UPDATE historiquetable SET historiqueNumeroTable=:historiqueNumeroTable,historiqueNbPersonne=:historiqueNbPersonne WHERE idHistoriqueTable = :idHistoriqueTable');

        $state->bindValue(":historiqueNumeroTable", $type->getHistoriqueNumeroTable());
        $state->bindValue(":historiqueNbPersonne", $type->getHistoriqueNbPersonne());
        $state->bindValue(":idHistoriqueTable", $type->getIdHistoriqueTable());
        $state->execute();
    }
}