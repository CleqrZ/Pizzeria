<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// méthodes HTTP autorisées
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
// durée d'expiration du cache
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// url du dossier du webservice
$pathWs = "Pizerria-Groupe-5/";
$fullUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url = str_replace($pathWs . "server/", "", $fullUrl);
$urlParts = explode( '/', $url );

// méthode HTTP utilisée (GET, POST, PUT, DELETE)
$requestMethod = $_SERVER["REQUEST_METHOD"];


// fonction de chargement automatique des fichiers
function includeFileWithClassName($class_name)
{
    // répertoires contenant les classes
    $directorys = array(
        'controllers/',
        'DAO/',
        'DTO/',
        'tools/'
    );

    // pour chaque répertoire
    foreach($directorys as $directory)
    {
        // si le fichier existe
        if(file_exists($directory.$class_name . '.php'))
        {
            // inclus le fichier une seule fois
            require_once($directory.$class_name . '.php');
            return;
        }
    }
}

// enregistrement de la fonction de chargement automatique des fichiers
spl_autoload_register('includeFileWithClassName');


// en fonction de l'URL appelée, on charge différents controllers
switch ($urlParts[1]) {

    case "typeProduit" :

        $marqueId = null;
        if (isset($urlParts[2])) {
            $marqueId = (int) $urlParts[2];
        }

        $controller = new TypeProduitController($requestMethod, $marqueId);
        $controller->processRequest();
        break;

    case "produit" :
        $produitId = null;
        if (isset($urlParts[2])) {
            $produitId = (int) $urlParts[2];
        }

        $controller = new ProduitController($requestMethod, $produitId);
        $controller->processRequest();
        break;

    case "historiqueProduit":

        $produitId = null;
        if (isset($urlParts[2])) {
            $produitId = (int) $urlParts[2];
        }

        $controller = new HistoriqueProduitController($requestMethod, $produitId);
        $controller->processRequest();
        break;

    case "tablePizzeria":
        $tableId = null;
        if (isset($urlParts[2])) {
            $tableId = (int) $urlParts[2];
        }

        $controller = new TablePizzeriaController($requestMethod, $tableId);
        $controller->processRequest();
        break;


    case"historiqueTable":
        $tableId = null;
        if (isset($urlParts[2])) {
            $tableId = (int) $urlParts[2];
        }

        $controller = new HistoriqueTableController($requestMethod, $tableId);
        $controller->processRequest();
        break;


    case "commande" :
        $commandeIdTable = null;
        if (isset($urlParts[2])) {
            $commandeIdTable = (int) $urlParts[2];
        }


        $controller = new CommandeByTableController($requestMethod, $commandeIdTable);
        $controller->processRequest();
        break;



    case "commandePayer" :
        $commandeIdTable = null;
        if (isset($urlParts[2])) {
            $commandeIdTable = (int) $urlParts[2];
        }


        $controller = new CommandePayerByTableController($requestMethod, $commandeIdTable);
        $controller->processRequest();
        break;



    default :
        header("HTTP/1.1 404 Not Found");
        exit();
        break;
}
