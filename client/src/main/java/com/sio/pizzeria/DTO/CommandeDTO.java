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
public class CommandeDTO {
    private int idCommande;
    private int idTable;
    private int idProduit;
    private int nbProduit;

    public CommandeDTO(int idTable, int idProduit, int nbProduit) {
        this.idTable = idTable;
        this.idProduit = idProduit;
        this.nbProduit = nbProduit;
    }
    
    
    
    public int getIdCommande() {
        return idCommande;
    }

    public void setIdCommande(int idCommande) {
        this.idCommande = idCommande;
    }

    public int getIdTable() {
        return idTable;
    }

    public void setIdTable(int idTable) {
        this.idTable = idTable;
    }

    public int getIdProduit() {
        return idProduit;
    }

    public void setIdProduit(int idProduit) {
        this.idProduit = idProduit;
    }

    public int getNbProduit() {
        return nbProduit;
    }

    public void setNbProduit(int nbProduit) {
        this.nbProduit = nbProduit;
    }
    
    
}
