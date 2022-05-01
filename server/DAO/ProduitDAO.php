<?php

include_once('DTO/ProduitDTO.php');
class ProduitDAO
{
    public static function get($id)
    {
        $prod = null;

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM produit WHERE idProduit = :idProduit');
        $state->bindValue(":idProduit", $id);
        $state->execute();
        $resultats = $state->fetchAll();

        if (sizeof($resultats) > 0)
        {
            $result = $resultats[0];
            $prod = new ProduitDTO($result["nom"],$result["prix"],$result["idType"]);
            $prod->setIdProduit($result["idProduit"]);
        }

        return $prod;
    }

    public static function getList()
    {
        $prods = array();

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM produit');
        $state->execute();
        $resultats = $state->fetchAll();

        foreach ($resultats	as $result)
        {
            $prod = new ProduitDTO($result["nom"],$result["prix"],$result["idType"]);
            $prod->setIdProduit($result["idProduit"]);

            $prods[] = $prod;
        }
        return $prods;
    }

    public static function delete($id)
    {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('DELETE FROM produit WHERE idProduit = :idProduit');
        $state->bindValue(":idProduit", $id);
        $state->execute();
    }

    public static function insert($prod)
    {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('INSERT INTO produit(nom,prix,idType) VALUES(:nom,:prix,:idType)');
        $state->bindValue(":nom", $prod->getNom());
        $state->bindValue(":prix", $prod->getPrix());
        $state->bindValue(":idType", $prod->getIdType());
        $state->execute();

        $prod->setIdType($connex->lastInsertId());
    }

    public static function update($prod)
    {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('UPDATE produit SET nom=:nom,prix=:prix WHERE idProduit = :idProduit');

        $state->bindValue(":nom", $prod->getNom());
        $state->bindValue(":prix", $prod->getPrix());
        $state->bindValue(":idProduit", $prod->getIdProduit());
        $state->execute();
    }
}