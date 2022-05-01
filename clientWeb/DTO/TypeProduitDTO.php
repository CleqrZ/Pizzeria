<?php


class TypeProduitDTO implements JsonSerializable
{
    private $idType;
    private $nomType;

    public function __construct($idType,$nomType)
    {
        $this->idType = $idType;
        $this->nomType = $nomType;
    }

    public function getIdType()
    {
        return $this->idType;
    }

    public function setIdType($idType)
    {
        $this->idType = $idType;
    }

    public function getNomType()
    {
        return $this->nomType;
    }

    public function setNomType($nomType)
    {
        $this->nomType = $nomType;
    }

    public function jsonSerialize()
    {
        return array(
            'idType' => $this->idType,
            'nomType' => $this->nomType,
        );
    }
}