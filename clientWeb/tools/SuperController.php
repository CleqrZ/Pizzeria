<?php


class SuperController
{
    public static function callPage($page)
    {
        switch($page)
        {
            case "table":
                include_once("pages/table/TableController.php");

                $instanceController = new TableController();
                $instanceController->includeViewTable();
                break;

            case "produit":
                if (!isset($_GET['table'])){
                    header("index.php?page=table");
                }
                include_once("pages/table/TableController.php");
                include_once("pages/produit/ProduitController.php");
                include_once("pages/commande/CommandeController.php");
                $instanceController = new TableController();
                $instanceController->includeUpdateTable();
                $instanceController2 = new ProduitController();
                $instanceController2->includeViewProduit();
                $instanceController3 = new CommandeController();
                $instanceController3->includeViewCommande();
                break;

            case"delete":
                RequestSender::sendDeleteRequest("commande",$_GET['idProduit']);

                $path ="Location: index.php?page=produit&table=";
                $path.= $_GET['idTable'];
                header($path);
                break;

            case"deleteAll":
                include_once("pages/commande/CommandeController.php");
                $instanceController3 = new CommandeController();
                $instanceController3->deleteAllCommande($_GET['idTable']);
                $path ="Location: index.php?page=produit&table=";
                $path.= $_GET['idTable'];
                header($path);
                break;

            case"insert":
                include_once("pages/commande/CommandeController.php");
                $listCommande = CommandeController::CommandeByIdTable($_GET['idTable']);
                if($listCommande != null) {
                    $exist = false;
                    foreach ($listCommande as $commande) {
                        if ($commande->getIdProduit() == $_GET['idProduit']) {
                            $exist = true;
                            $commandeObj = new CommandeDTO($commande->getIdCommande(),$_GET['idTable'],$_GET['idProduit'],$_GET['nb']);
                            RequestSender::sendPutRequest("commande",$commandeObj);
                        }
                    }
                    if ($exist == false) {
                        $commandeObj = new CommandeDTO(1, $_GET['idTable'], $_GET['idProduit'], $_GET['nb']);
                        RequestSender::sendPostRequest("commande", $commandeObj);
                    }
                }
                else{
                    $commandeObj = new CommandeDTO(1,$_GET['idTable'],$_GET['idProduit'],$_GET['nb']);
                    RequestSender::sendPostRequest("commande",$commandeObj);
                }


                $path ="Location: index.php?page=produit&table=";
                $path.= $_GET['idTable'];
                header($path);
                break;
        }
    }
}