<?php


class ProduitController
{
    public function __construct(){}

    public function includeViewProduit()
    {
        include_once('produit.php');
    }

    public function getListProduit()
    {
        $liste = [];
        $listeProduit= [];
        $listeType=[];
        $produit = RequestSender::sendGetRequest("produit");
        $type = RequestSender::sendGetRequest("typeProduit");
        $produitDecoder =json_decode($produit);
        $typeDecoder =json_decode($type);
        foreach ($typeDecoder as $typ){
            $typeObj = new TypeProduitDTO($typ->idType,$typ->nomType);
            $listeType[] = $typeObj;
        }
        foreach ($produitDecoder as $prod){
            $produitObj =new ProduitDTO($prod->idProduit,$prod->nom,$prod->prix,$prod->idType);
            $listeProduit[] = $produitObj;
            }

        $liste[] = $listeType;
        $liste[] = $listeProduit;
        return $liste;
    }

    public static function getProduitById($idProduit)
    {
        $path = "produit/".$idProduit;
        $produit = RequestSender::sendGetRequest($path);
        $produit =json_decode($produit);
        $produitObj =new ProduitDTO($produit->idProduit,$produit->nom,$produit->prix,$produit->idType);
        return $produitObj;
    }

}