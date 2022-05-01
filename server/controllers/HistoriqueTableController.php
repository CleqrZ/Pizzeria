<?php

include_once('tools/DatabaseLinker.php');
include_once('DAO/HistoriqueTableDAO.php');
class HistoriqueTableController
{
    private $requestMethod;
    private $tableId = null;

    public function __construct($requestMethod, $id) {
        $this->requestMethod = $requestMethod;
        $this->tableId = $id;
    }


    public function processRequest() {

        $response = $this->notFoundResponse();

        switch ($this->requestMethod) {
            case 'GET':
                if (isset($this->tableId)) {
                    $response = $this->gettable($this->tableId);
                } else {
                    $response = $this->getAllTable();
                };
                break;
            case 'POST':
                $response = $this->createTable();
                break;
            case 'PUT':
                if (empty($this->tableId)) {
                    $response = $this->updateTable();
                }
                break;
            case 'DELETE':
                if($this->tableId){
                    $response = $this->deleteTable($this->tableId);
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

    public function getAllTable() {
        $result = HistoriqueTableDAO::getList();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);

        return $response;
    }

    private function getTable($id) {
        $result = HistoriqueTableDAO::get($id);
        if ($result == null) {
            return $this->notFoundResponse();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function createTable(){
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (empty($input["historiqueNumeroTable"]) or empty($input["historiqueNbPersonne"])) {
            return $this->unprocessableEntityResponse();
        }
        $obj =new HistoriqueTableDTO($input["historiqueNumeroTable"],$input["historiqueNbPersonne"]);
        $table = HistoriqueTableDAO::insert($obj);

        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = json_encode($table);
        return $response;
    }

    private function updateTable() {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (empty($input["idHistoriqueTable"]) or empty($input["historiqueNumeroTable"]) or empty($input["historiqueNbPersonne"])) {
            return $this->unprocessableEntityResponse();
        }
        $obj =new HistoriqueTableDTO($input["historiqueNumeroTable"],$input["historiqueNbPersonne"]);
        $obj->setIdHistoriqueTable($input["idHistoriqueTable"]);
        $modif = HistoriqueTableDAO::update($obj);

        $response['status_code_header'] = 'HTTP/1.1 201 Updated';
        $response['body'] = json_encode($modif);
        return $response;
    }

    private function deleteTable($id) {
        $result = HistoriqueTableDAO::delete($id);

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