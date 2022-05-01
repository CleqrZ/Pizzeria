<?php


class CommandeDTO implements JsonSerializable
{
    private $idCommande;
    private $idTable;
    private $idProduit;
    private $nbProduit;

    public function __construct()
    {
    }

    public function getIdCommande()
    {
        return $this->idCommande;
    }

    public function setIdCommande($idCommande)
    {
        $this->idCommande = $idCommande;
    }

    public function getIdTable()
    {
        return $this->idTable;
    }

    public function setIdTable($idTable)
    {
        $this->idTable = $idTable;
    }

    public function getIdProduit()
    {
        return $this->idProduit;
    }

    public function setIdProduit($idPrduit)
    {
        $this->idProduit = $idPrduit;
    }


    public function getNbProduit()
    {
        return $this->nbProduit;
    }


    public function setNbProduit($nbProduit)
    {
        $this->nbProduit = $nbProduit;
    }


    public function jsonSerialize()
    {
        return array(
            'idCommande' => $this->idCommande,
            'idTable' => $this->idTable,
            'idProduit' => $this->idProduit,
            'nbProduit' => $this->nbProduit,
        );
    }

}