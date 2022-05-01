<?php
class TableController
{
    public function __construct()
    {}

    public function includeViewTable()
    {
        include_once('table.php');
    }

    public function includeUpdateTable()
    {
        include_once('tableUpdate.php');
    }

    public function getTable()
    {
        $listeTable=[];
        $listeTableVide=[];
        $listeTableOccupe=[];
        $tables = RequestSender::sendGetRequest("tablePizzeria");
        $tableDecoder =json_decode($tables);
        foreach ($tableDecoder as $table){
            if($table->nbPersonne == "0" ){
                $tableObj =new TablePizzeriaDTO($table->idTable,$table->numeroTable,$table->nbPersonne);
                $listeTableVide[] = $tableObj;
            }
            else{
                $tableObj =new TablePizzeriaDTO($table->idTable,$table->numeroTable,$table->nbPersonne);
                $listeTableOccupe[] = $tableObj;
            }

        }
        $listeTable[] = $listeTableVide;
        $listeTable[]= $listeTableOccupe;
        return $listeTable;
    }
    public function getTableById($idTable){
        $path = "tablePizzeria/".$idTable;
        $table = RequestSender::sendGetRequest($path);
        $table =json_decode($table);
        $tableObj =new TablePizzeriaDTO($table->idTable,$table->numeroTable,$table->nbPersonne);
        return $tableObj;

    }

    public function updateTable($idTable,$nbPersonne){
        $table =$this->getTableById($idTable);
        $tableObj =new TablePizzeriaDTO($idTable, $table->getNumeroTable(), $nbPersonne);
        RequestSender::sendPutRequest("tablePizzeria",$tableObj);
    }
}