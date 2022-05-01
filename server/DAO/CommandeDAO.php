<?php

include_once('DTO/CommandeDTO.php');
class CommandeDAO
{
    public static function getByIdCommande($id)
    {
        $commande = null;

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM commande WHERE idCommande = :idCommande');
        $state->bindValue(":idCommande", $id);
        $state->execute();
        $resultats = $state->fetchAll();

        if (sizeof($resultats) > 0)
        {
            $result = $resultats[0];
            $commande = new CommandeDTO();
            $commande->setIdCommande($result["idCommande"]);
            $commande->setIdProduit($result["idProduit"]);
            $commande->setIdTable($result["idTable"]);
            $commande->setNbProduit($result["nbProduit"]);
        }

        return $commande;
    }

    public static function getList()
    {
        $commandes = array();

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM commande');
        $state->execute();
        $resultats = $state->fetchAll();

        foreach ($resultats	as $result)
        {
            $commande = new CommandeDTO();
            $commande->setIdCommande($result["idCommande"]);
            $commande->setIdProduit($result["idProduit"]);
            $commande->setIdTable($result["idTable"]);
            $commande->setNbProduit($result["nbProduit"]);
            $commandes[] = $commande;
        }
        return $commandes;
    }

    public static function delete($id)
    {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('DELETE FROM commande WHERE idCommande = :idCommande');
        $state->bindValue(":idCommande", $id);
        $state->execute();
    }

    public static function insert($commande)
    {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('INSERT INTO commande(idTable,idProduit,nbProduit) VALUES(:idTable,:idProduit,:nbProduit)');
        $state->bindValue(":idTable", $commande->getIdTable());
        $state->bindValue(":idProduit", $commande->getIdProduit());
        $state->bindValue(":nbProduit", $commande->getNbProduit());
        $state->execute();

    }

    public static function update($type)
    {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('UPDATE commande SET idTable=:idTable,idProduit=:idProduit,nbProduit=:nbProduit WHERE idCommande = :idCommande');
        $state->bindValue(":idTable", $type->getIdTable());
        $state->bindValue(":idProduit", $type->getIdProduit());
        $state->bindValue(":nbProduit", $type->getNbProduit());
        $state->bindValue(":idCommande", $type->getIdCommande());
        $state->execute();
    }
}