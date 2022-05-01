<?php

include_once('tools/DatabaseLinker.php');
include_once('DAO/TypeProduitDAO.php');
class TypeProduitController
{
    private $requestMethod;
    private $typeId = null;

    public function __construct($requestMethod, $id) {
        $this->requestMethod = $requestMethod;
        $this->typeId = $id;
    }


    public function processRequest() {

        $response = $this->notFoundResponse();

        switch ($this->requestMethod) {
            case 'GET':
                if (isset($this->typeId)) {
                    $response = $this->getType($this->typeId);
                } else {
                    $response = $this->getAllType();
                }
                break;
            case 'POST':
                $response = $this->createType();
                break;
            case 'PUT':
                if (empty($this->typeId)) {
                    $response = $this->updateType();
                }
                break;
            case 'DELETE':
                if($this->typeId){
                    $response = $this->deleteType($this->typeId);
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

    public function getAllType() {
        $result = TypeProduitDAO::getList();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);

        return $response;
    }

    private function getType($id) {
        $result = TypeProduitDAO::get($id);
        if ($result == null) {
            return $this->notFoundResponse();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function createType(){
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (empty($input["nomType"])) {
            return $this->unprocessableEntityResponse();
        }
        $obj =new TypeProduitDTO($input["nomType"]);
        $type = TypeProduitDAO::insert($obj);

        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = json_encode($type);
        return $response;
    }

    private function updateType() {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (empty($input["idType"]) or empty($input["nomType"])) {
            return $this->unprocessableEntityResponse();
        }
        $obj =new TypeProduitDTO($input["nomType"]);
        $obj->setIdType($input["idType"]);
        $modif = TypeProduitDAO::update($obj);

        $response['status_code_header'] = 'HTTP/1.1 201 Updated';
        $response['body'] = json_encode($modif);
        return $response;
    }

    private function deleteType($id) {
        $result = TypeProduitDAO::delete($id);

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