<?php


class ProduitDTO implements JsonSerializable
{
    private $idProduit;
    private $nom;
    private $prix;
    private $idType;

    public function __construct($nom, $prix, $idType)
    {
        $this->nom = $nom;
        $this->prix = $prix;
        $this->idType = $idType;
    }

    public function getIdProduit()
    {
        return $this->idProduit;
    }

    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrix()
    {
        return $this->prix;
    }


    public function setPrix($prix)
    {
        $this->prix = $prix;
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
            'idProduit' => $this->idProduit,
            'nom' => $this->nom,
            'prix' => $this->prix,
            'idType' => $this->idType,
        );
    }
}