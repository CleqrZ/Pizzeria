<?php


class CommandeController
{
    public function __construct()
    {}

    public function includeViewCommande()
    {
        include_once('commande.php');
    }

    public static function CommandeByIdTable($idTable)
    {
        $listeCommandes=[];
        $commandes = RequestSender::sendGetRequest("commande");
        $commandesDecode =json_decode($commandes);
        if ($commandesDecode != null){
            foreach ($commandesDecode as $commande){
                if($commande->idTable == $idTable){
                    $commandeObj = new CommandeDTO($commande->idCommande,$commande->idTable,$commande->idProduit,$commande->nbProduit);
                    $listeCommandes[] = $commandeObj;
                }

            }
        }
        return $listeCommandes;
    }


    public static function deleteCommande($id){
        $table = "commande";
        $commandes = RequestSender::sendDeleteRequest($table,$id);
    }

    public function deleteAllCommande($idTable){
        $listCommande = CommandeController::CommandeByIdTable($idTable);
        if($listCommande != null){
            foreach ($listCommande as $commande){
                CommandeController::deleteCommande($commande->getIdCommande());
            }
        }
    }
}