<?php


class TablePizzeriaDTO implements JsonSerializable
{
    private $idTable;
    private $numeroTable;
    private $nbPersonne;

    public function __construct($numeroTable, $nbPersonne)
    {
        $this->numeroTable = $numeroTable;
        $this->nbPersonne = $nbPersonne;
    }

    public function getIdTable()
    {
        return $this->idTable;
    }

    public function setIdTable($idTable)
    {
        $this->idTable = $idTable;
    }

    public function getNumeroTable()
    {
        return $this->numeroTable;
    }

    public function setNumeroTable($numeroTable)
    {
        $this->numeroTable = $numeroTable;
    }

    public function getNbPersonne()
    {
        return $this->nbPersonne;
    }

    public function setNbPersonne($nbPersonne)
    {
        $this->nbPersonne = $nbPersonne;
    }

    public function jsonSerialize()
    {
        return array(
            'idTable' => $this->idTable,
            'numeroTable' => $this->numeroTable,
            'nbPersonne' => $this->nbPersonne,
        );
    }
}