<?php

include_once('tools/DatabaseLinker.php');
include_once('DAO/CommandePayerDAO.php');
class CommandePayerByTableController
{
    private $requestMethod;
    private $commandeIdTable = null;

    public function __construct($requestMethod, $idTable) {
        $this->requestMethod = $requestMethod;
        $this->commandeIdTable = $idTable;
    }


    public function processRequest() {

        $response = $this->notFoundResponse();

        switch ($this->requestMethod) {
            case 'GET':
                if (isset($this->commandeIdTable)) {
                    $response = $this->getCommandeByTable($this->commandeIdTable);
                }
                else {
                    $response = $this->getAllCommande();
                };
                break;
            case 'POST':
                $response = $this->createCommande();
                break;
            case 'PUT':
                if (empty($this->commandeIdTable)) {
                    $response = $this->updateCommandeByTable();
                }
                break;
            case 'DELETE':
                if($this->commandeIdTable){
                    $response = $this->deleteCommande($this->commandeIdTable);
                }
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }

        header($response['status_code_header']);
        if ($response['body'] != null && $response['status_code_header'] === "HTTP/1.1 200 OK") {
            echo $response['body'];
        }
        else {
            echo $response['status_code_header'];
            echo $response['body'];
        }
    }

    public function getAllCommande() {
        $result = CommandePayerDAO::getList();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);

        return $response;
    }

    private function getCommandeByTable($id) {
        $result = CommandePayerDAO::getByIdCommande($id);
        if ($result == null) {
            return $this->notFoundResponse();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }


    private function createCommande(){
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (empty($input["idHistoriqueProduit"]) or empty($input["idHistoriqueTable"]) or empty($input["nbProduit"])) {
            return $this->unprocessableEntityResponse();
        }
        $obj =new CommandePayerDTO();
        $obj->setIdHistoriqueTable($input["idHistoriqueTable"]);
        $obj->setIdHistoriqueProduit($input["idHistoriqueProduit"]);
        $obj->setNbProduit($input["nbProduit"]);
        $commande = CommandePayerDAO::insert($obj);

        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = json_encode($commande);
        return $response;
    }

    private function updateCommandeByTable() {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (empty($input["idHistoriqueProduit"])or empty($input["idCommandePayer"]) or empty($input["idHistoriqueTable"]) or empty($input["nbProduit"])) {
            return $this->unprocessableEntityResponse();
        }
        $obj =new CommandePayerDTO();
        $obj->setIdCommandePayer($input["idCommandePayer"]);
        $obj->setIdHistoriqueTable($input["idHistoriqueTable"]);
        $obj->setIdHistoriqueProduit($input["idHistoriqueProduit"]);
        $obj->setNbProduit($input["nbProduit"]);
        $modif = CommandePayerDAO::update($obj);

        $response['status_code_header'] = 'HTTP/1.1 201 Updated';
        $response['body'] = json_encode($modif);
        return $response;
    }


    private function deleteCommande($id) {
        $result = CommandePayerDAO::delete($id);

        $response['status_code_header'] = 'HTTP/1.1 200 Successful deletion';
        $response['body'] = null;
        return $response;
    }

    private function unprocessableEntityResponse() {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    private function notFoundResponse() {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}