<?php

include_once('tools/DatabaseLinker.php');
include_once('DAO/ProduitDAO.php');
class ProduitController
{
    private $requestMethod;
    private $prodId = null;

    public function __construct($requestMethod, $id) {
        $this->requestMethod = $requestMethod;
        $this->prodId = $id;
    }

    public function processRequest() {

        $response = $this->notFoundResponse();

        switch ($this->requestMethod) {
            case 'GET':
                if (isset($this->prodId)) {
                    $response = $this->getProduit($this->prodId);
                } else {
                    $response = $this->getAllProduit();
                };
                break;
            case 'POST':
                $response = $this->createProduit();
                break;
            case 'PUT':
                if (empty($this->prodId)) {
                    $response = $this->updateProduit();
                }
                break;
            case 'DELETE':
                if($this->prodId){
                    $response = $this->deleteProduit($this->prodId);
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

    public function getAllProduit() {
        $result = ProduitDAO::getList();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);

        return $response;
    }

    private function getProduit($id) {
        $result = ProduitDAO::get($id);
        if ($result == null) {
            return $this->notFoundResponse();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function createProduit(){
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (empty($input["nom"]) or empty($input["prix"]) or empty($input["idType"])){
            return $this->unprocessableEntityResponse();
        }
        $obj =new ProduitDTO($input["nom"],$input["prix"],$input["idType"]);
        $type = ProduitDAO::insert($obj);

        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = json_encode($type);
        return $response;
    }

    private function updateProduit() {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (empty($input["idProduit"]) or empty($input["nom"]) or empty($input["prix"])) {
            return $this->unprocessableEntityResponse();
        }
        $obj =new ProduitDTO($input["nom"],$input["prix"],$input["idType"]);
        $obj->setIdProduit($input["idProduit"]);
        $modif = ProduitDAO::update($obj);

        $response['status_code_header'] = 'HTTP/1.1 201 Updated';
        $response['body'] = json_encode($modif);
        return $response;
    }

    private function deleteProduit($id) {
        $result = ProduitDAO::delete($id);

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