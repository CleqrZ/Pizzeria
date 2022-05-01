/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.sio.pizzeria.DTO;

import java.util.Date;

/**
 *
 * @author Lenovo P50
 */
public class CommandePayerDTO {
    

    private int idCommandePayer;
    private int idHistoriqueProduit;
    private int idHistoriqueTable;
    private int nbProduit;
    private Date date;

    public CommandePayerDTO(int idHistoriqueProduit, int idHistoriqueTable, int nbProduit, Date date) {
        this.idCommandePayer = idCommandePayer;
        this.idHistoriqueProduit = idHistoriqueProduit;
        this.idHistoriqueTable = idHistoriqueTable;
        this.nbProduit = nbProduit;
        this.date = date;
    }

    
    
    public int getIdCommandePayer() {
        return idCommandePayer;
    }

    public void setIdCommandePayer(int idCommandePayer) {
        this.idCommandePayer = idCommandePayer;
    }

    public int getIdHistoriqueProduit() {
        return idHistoriqueProduit;
    }

    public void setIdHistoriqueProduit(int idHistoriqueProduit) {
        this.idHistoriqueProduit = idHistoriqueProduit;
    }

    public int getIdHistoriqueTable() {
        return idHistoriqueTable;
    }

    public void setIdHistoriqueTable(int idHistoriqueTable) {
        this.idHistoriqueTable = idHistoriqueTable;
    }

    public int getNbProduit() {
        return nbProduit;
    }

    public void setNbProduit(int nbProduit) {
        this.nbProduit = nbProduit;
    }

    public Date getDate() {
        return date;
    }

    public void setDate(Date date) {
        this.date = date;
    }
    
    
}
