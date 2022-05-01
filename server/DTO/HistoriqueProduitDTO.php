<?php


class HistoriqueProduitDTO implements JsonSerializable
{
    private $idHistorique;
    private $nomProduit;
    private $prixProduit;
    private $idType;


    public function __construct($nomProduit, $prixProduit, $idType)
    {
        $this->nomProduit = $nomProduit;
        $this->prixProduit = $prixProduit;
        $this->idType = $idType;
    }

    public function getIdHistorique()
    {
        return $this->idHistorique;
    }

    public function setIdHistorique($idHistorique)
    {
        $this->idHistorique = $idHistorique;
    }

    public function getNomProduit()
    {
        return $this->nomProduit;
    }

    public function setNomProduit($nomProduit)
    {
        $this->nomProduit = $nomProduit;
    }

    public function getPrixProduit()
    {
        return $this->prixProduit;
    }

    public function setPrixProduit($prixProduit)
    {
        $this->prixProduit = $prixProduit;
    }
    public function getIdType()
    {
        return $this->idType;
    }

    public function setIdType($idType)
    {
        $this->idType = $idType;
    }

    public function jsonSerialize()
    {
        return array(
            'idHistorique' => $this->idHistorique,
            'nomProduit' => $this->nomProduit,
            'prixProduit' => $this->prixProduit,
            'idType' => $this->idType
        );
    }
}