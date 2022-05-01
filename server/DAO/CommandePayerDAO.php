<?php

include_once('DTO/CommandePayerDTO.php');
class CommandePayerDAO
{
    public static function getByIdCommande($id)
    {
        $commande = null;

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM commandepayer WHERE idCommandePayer = :idCommandePayer');
        $state->bindValue(":idCommandePayer", $id);
        $state->execute();
        $resultats = $state->fetchAll();

        if (sizeof($resultats) > 0)
        {
            $result = $resultats[0];
            $commande = new CommandePayerDTO();
            $commande->setIdCommandePayer($result["idCommandePayer"]);
            $commande->setIdHistoriqueProduit($result["idHistoriqueProduit"]);
            $commande->setIdHistoriqueTable($result["idHistoriqueTable"]);
            $commande->setNbProduit($result["nbProduit"]);
            $commande->setDate($result['date']);
        }

        return $commande;
    }

    public static function getList()
    {
        $commandes = array();

        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('SELECT * FROM commandepayer');
        $state->execute();
        $resultats = $state->fetchAll();

        foreach ($resultats	as $result)
        {
            $commande = new CommandePayerDTO();
            $commande->setIdCommandePayer($result["idCommandePayer"]);
            $commande->setIdHistoriqueProduit($result["idHistoriqueProduit"]);
            $commande->setIdHistoriqueTable($result["idHistoriqueTable"]);
            $commande->setNbProduit($result["nbProduit"]);
            $commande->setDate($result['date']);
            $commandes[] = $commande;
        }
        return $commandes;
    }

    public static function delete($id)
    {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('DELETE FROM commandepayer WHERE idCommandePayer = :idCommandePayer');
        $state->bindValue(":idHistoriqueTable", $id);
        $state->execute();
    }


    public static function insert($commande)
    {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('INSERT INTO commandepayer(idHistoriqueTable,idHistoriqueProduit,nbProduit,date) VALUES(:idHistoriqueTable,:idHistoriqueProduit,:nbProduit,CURRENT_DATE())');
        $state->bindValue(":idHistoriqueTable", $commande->getIdHistoriqueTable());
        $state->bindValue(":idHistoriqueProduit", $commande->getIdHistoriqueProduit());
        $state->bindValue(":nbProduit", $commande->getNbProduit());
        $state->execute();

    }

    public static function update($type)
    {
        $connex = DatabaseLinker::getConnexion();

        $state = $connex->prepare('UPDATE commandepayer SET idHistoriqueTable=:idHistoriqueTable,idHistoriqueProduit=:idHistoriqueProduit,nbProduit=:nbProduit WHERE idCommandePayer=:idCommandePayer');
        $state->bindValue(":idHistoriqueTable", $type->getIdHistoriqueTable());
        $state->bindValue(":idHistoriqueProduit", $type->getIdHistoriqueProduit());
        $state->bindValue(":nbProduit", $type->getNbProduit());
        $state->bindValue(":idCommandePayer", $type->getIdCommandePayer());
        $state->execute();
    }

}