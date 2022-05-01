/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.sio.pizzeria.DTO;


/**
 *
 * @author Lenovo P50
 */
public class ProduitDTO {
    
    private int idProduit;
    private String nomProduit;
    private float prix;
    private int idType;

    public ProduitDTO(String nomProduit, float prix, int idType) {
        this.nomProduit = nomProduit;
        this.prix = prix;
        this.idType = idType;
    }



    public int getIdProduit() {
        return idProduit;
    }

    public void setIdProduit(int idProduit) {
        this.idProduit = idProduit;
    }

    public String getNomProduit() {
        return nomProduit;
    }

    public void setNomProduit(String nomProduit) {
        this.nomProduit = nomProduit;
    }

    public float getPrix() {
        return prix;
    }

    public void setPrix(int prix) {
        this.prix = prix;
    }

    public int getIdType() {
        return idType;
    }

    public void setIdType(int idType) {
        this.idType = idType;
    }

    
    
}
