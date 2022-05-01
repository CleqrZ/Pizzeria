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
public class HistoriqueProduitDTO {
     

    private int idHistorique;
    private String nomProduit;
    private float prixProduit;
    private int idType;

    public HistoriqueProduitDTO(String nomProduit, float prixProduit, int idType) {
        this.nomProduit = nomProduit;
        this.prixProduit = prixProduit;
        this.idType = idType;
    }

    
    
    public int getIdHistorique() {
        return idHistorique;
    }

    public void setIdHistorique(int idHistorique) {
        this.idHistorique = idHistorique;
    }

    public String getNomProduit() {
        return nomProduit;
    }

    public void setNomProduit(String nomProduit) {
        this.nomProduit = nomProduit;
    }

    public float getPrixProduit() {
        return prixProduit;
    }

    public void setPrixProduit(int prixProduit) {
        this.prixProduit = prixProduit;
    }

    public int getIdType() {
        return idType;
    }

    public void setIdType(int idType) {
        this.idType = idType;
    }

    
}
