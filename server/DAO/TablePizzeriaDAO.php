<?php

include_once('DTO/TablePizzeriaDTO.php');
class TablePizzeriaDAO
{
    public static function get($id)
    {
        $type = null;

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM tablepizzeria WHERE idTable = :idTable');
        $state->bindValue(":idTable", $id);
        $state->execute();
        $resultats = $state->fetchAll();

        if (sizeof($resultats) > 0)
        {
            $result = $resultats[0];
            $type = new TablePizzeriaDTO($result["numeroTable"],$result["nbPersonne"]);
            $type->setIdTable($result["idTable"]);
        }

        return $type;
    }

    public static function getList()
    {
        $types = array();

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM tablepizzeria');
        $state->execute();
        $resultats = $state->fetchAll();

        foreach ($resultats	as $result)
        {
            $type = new TablePizzeriaDTO($result["numeroTable"],$result["nbPersonne"]);
            $type->setIdTable($result["idTable"]);

            $types[] = $type;
        }
        return $types;
    }

    public static function delete($id)
    {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('DELETE FROM tablepizzeria WHERE idTable = :idTable');
        $state->bindValue(":idTable", $id);
        $state->execute();
    }

    public static function insert($type)
    {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('INSERT INTO tablepizzeria(numeroTable,nbPersonne) VALUES(:numeroTable,:nbPersonne)');
        $state->bindValue(":numeroTable", $type->getNumeroTable());
        $state->bindValue(":nbPersonne", $type->getNbPersonne());
        $state->execute();

        $type->setIdTable($connex->lastInsertId());
    }

    public static function update($type)
    {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('UPDATE tablepizzeria SET numeroTable=:numeroTable,nbPersonne=:nbPersonne WHERE idTable = :idTable');

        $state->bindValue(":numeroTable", $type->getNumeroTable());
        $state->bindValue(":nbPersonne", $type->getNbPersonne());
        $state->bindValue(":idTable", $type->getIdTable());
        $state->execute();
    }
}