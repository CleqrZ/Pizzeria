<?php

include_once('tools/DatabaseLinker.php');
include_once('DAO/CommandeDAO.php');
class CommandeByTableController
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
        $result = CommandeDAO::getList();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);

        return $response;
    }

    private function getCommandeByTable($id) {
        $result = CommandeDAO::getByIdCommande($id);
        if ($result == null) {
            return $this->notFoundResponse();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }


    private function createCommande(){
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (empty($input["idTable"]) or empty($input["idProduit"]) or empty($input["nbProduit"])) {
            return $this->unprocessableEntityResponse();
        }
        $obj =new CommandeDTO();
        $obj->setIdTable($input["idTable"]);
        $obj->setIdProduit($input["idProduit"]);
        $obj->setNbProduit($input["nbProduit"]);
        $commande = CommandeDAO::insert($obj);

        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = json_encode($commande);
        return $response;
    }

    private function updateCommandeByTable() {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (empty($input["idTable"]) or empty($input["idCommande"])  or empty($input["idProduit"]) or empty($input["nbProduit"])) {
            return $this->unprocessableEntityResponse();
        }
        $obj =new CommandeDTO();
        $obj->setIdCommande($input["idCommande"]);
        $obj->setIdTable($input["idTable"]);
        $obj->setIdProduit($input["idProduit"]);
        $obj->setNbProduit($input["nbProduit"]);
        $modif = CommandeDAO::update($obj);

        $response['status_code_header'] = 'HTTP/1.1 201 Updated';
        $response['body'] = json_encode($modif);
        return $response;
    }


    private function deleteCommande($id) {
        $result = CommandeDAO::delete($id);

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
}}