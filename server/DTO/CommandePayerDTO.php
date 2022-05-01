<?php


class CommandePayerDTO implements JsonSerializable
{
    private $idCommandePayer;
    private $idHistoriqueProduit;
    private $idHistoriqueTable;
    private $nbProduit;
    private $date;

    public function __construct()
    {
    }


    public function getIdCommandePayer()
    {
        return $this->idCommandePayer;
    }

    public function setIdCommandePayer($idCommandePayer)
    {
        $this->idCommandePayer = $idCommandePayer;
    }

    public function getIdHistoriqueProduit()
    {
        return $this->idHistoriqueProduit;
    }

    public function setIdHistoriqueProduit($idHistoriqueProduit)
    {
        $this->idHistoriqueProduit = $idHistoriqueProduit;
    }

    public function getIdHistoriqueTable()
    {
        return $this->idHistoriqueTable;
    }

    public function setIdHistoriqueTable($idHistoriqueTable)
    {
        $this->idHistoriqueTable = $idHistoriqueTable;
    }

    public function getNbProduit()
    {
        return $this->nbProduit;
    }

    public function setNbProduit($nbProduit)
    {
        $this->nbProduit = $nbProduit;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function jsonSerialize()
    {
        return array(
            'idCommandePayer' => $this->idCommandePayer,
            'idHistoriqueProduit' => $this->idHistoriqueProduit,
            'idHistoriqueTable' => $this->idHistoriqueTable,
            'nbProduit' => $this->nbProduit,
            'date' => $this->date,
        );
    }

}