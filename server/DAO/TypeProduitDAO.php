<?php

include_once('DTO/TypeProduitDTO.php');
class TypeProduitDAO
{
    public static function get($id)
    {
        $type = null;

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM typeproduit WHERE idType = :idType');
        $state->bindValue(":idType", $id);
        $state->execute();
        $resultats = $state->fetchAll();

        if (sizeof($resultats) > 0)
        {
            $result = $resultats[0];
            $type = new TypeProduitDTO($result["nomType"]);
            $type->setIdType($result["idType"]);
        }

        return $type;
    }

    public static function getList()
    {
        $types = array();

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM typeproduit');
        $state->execute();
        $resultats = $state->fetchAll();

        foreach ($resultats	as $result)
        {
            $type = new TypeProduitDTO($result["nomType"]);
            $type->setIdType($result["idType"]);

            $types[] = $type;
        }
        return $types;
    }

    public static function delete($id)
    {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('DELETE FROM typeproduit WHERE idType = :idType');
        $state->bindValue(":idType", $id);
        $state->execute();
    }

    public static function insert($type)
    {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('INSERT INTO typeproduit(nomType) VALUES(:nomType)');
        $state->bindValue(":nomType", $type->getNomType());
        $state->execute();

        $type->setIdType($connex->lastInsertId());
    }

    public static function update($type)
    {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('UPDATE typeProduit SET nomType=:nomType WHERE idType = :idType');

        $state->bindValue(":nomType", $type->getNomType());
        $state->bindValue(":idType", $type->getIdType());
        $state->execute();
    }
}