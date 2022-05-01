<?php


class HistoriqueTableDTO implements JsonSerializable
{
    private $idHistoriqueTable;
    private $historiqueNumeroTable;
    private $historiqueNbPersonne;


    public function __construct($historiqueNumeroTable, $historiqueNbPersonne)
    {
        $this->historiqueNumeroTable = $historiqueNumeroTable;
        $this->historiqueNbPersonne = $historiqueNbPersonne;
    }

    public function getIdHistoriqueTable()
    {
        return $this->idHistoriqueTable;
    }

    public function setIdHistoriqueTable($idHistoriqueTable)
    {
        $this->idHistoriqueTable = $idHistoriqueTable;
    }

    public function getHistoriqueNumeroTable()
    {
        return $this->historiqueNumeroTable;
    }

    public function setHistoriqueNumeroTable($historiqueNumeroTable)
    {
        $this->historiqueNumeroTable = $historiqueNumeroTable;
    }

    public function getHistoriqueNbPersonne()
    {
        return $this->historiqueNbPersonne;
    }

    public function setHistoriqueNbPersonne($historiqueNbPersonne)
    {
        $this->historiqueNbPersonne = $historiqueNbPersonne;
    }

    public function jsonSerialize()
    {
        return array(
            'idHistoriqueTable' => $this->idHistoriqueTable,
            'historiqueNumeroTable' => $this->historiqueNumeroTable,
            'historiqueNbPersonne' => $this->historiqueNbPersonne,
        );
    }

}