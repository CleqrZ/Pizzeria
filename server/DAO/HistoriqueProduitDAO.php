<?php

include_once('DTO/HistoriqueProduitDTO.php');
class HistoriqueProduitDAO
{
    public static function get($id)
    {
        $prod = null;

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM historiqueproduit WHERE idHistorique = :idHistorique');
        $state->bindValue(":idHistorique", $id);
        $state->execute();
        $resultats = $state->fetchAll();

        if (sizeof($resultats) > 0)
        {
            $result = $resultats[0];
            $prod = new HistoriqueProduitDTO($result["nomProduit"],$result["prixProduit"],$result["idType"]);
            $prod->setIdHistorique($result["idHistorique"]);
        }

        return $prod;
    }

    public static function getList()
    {
        $prods = array();

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM historiqueproduit');
        $state->execute();
        $resultats = $state->fetchAll();

        foreach ($resultats	as $result)
        {
            $prod = new HistoriqueProduitDTO($result["nomProduit"],$result["prixProduit"],$result["idType"]);
            $prod->setIdHistorique($result["idHistorique"]);

            $prods[] = $prod;
        }
        return $prods;
    }

    public static function delete($id)
    {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('DELETE FROM historiqueproduit WHERE idHistorique = :idHistorique');
        $state->bindValue(":idHistorique", $id);
        $state->execute();
    }

    public static function insert($prod)
    {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('INSERT INTO historiqueproduit(nomProduit,prixProduit,idType) VALUES(:nomProduit,:prixProduit,:idType)');
        $state->bindValue(":nomProduit", $prod->getNomProduit());
        $state->bindValue(":prixProduit", $prod->getPrixProduit());
        $state->bindValue(":idType", $prod->getIdType());
        $state->execute();

        $prod->setIdType($connex->lastInsertId());
    }

    public static function update($prod)
    {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('UPDATE historiqueproduit SET nomProduit=:nomProduit,prixProduit=:prixProduit WHERE idHistorique = :idHistorique');

        $state->bindValue(":nomProduit", $prod->getNomProduit());
        $state->bindValue(":prixProduit", $prod->getPrixProduit());
        $state->bindValue(":idHistorique", $prod->getIdHistorique());
        $state->execute();
    }
}