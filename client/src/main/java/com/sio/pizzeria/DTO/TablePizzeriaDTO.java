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
public class TablePizzeriaDTO {
    	
    private int idTable;
    private int numeroTable;
    private int nbPersonne;

    public TablePizzeriaDTO(int numeroTable, int nbPersonne) {
        this.numeroTable = numeroTable;
        this.nbPersonne = nbPersonne;
    }

    public int getIdTable() {
        return idTable;
    }

    public void setIdTable(int idTable) {
        this.idTable = idTable;
    }

    public int getNumeroTable() {
        return numeroTable;
    }

    public void setNumeroTable(int numeroTable) {
        this.numeroTable = numeroTable;
    }

    public int getNbPersonne() {
        return nbPersonne;
    }

    public void setNbPersonne(int nbPersonne) {
        this.nbPersonne = nbPersonne;
    }
    
    
}
