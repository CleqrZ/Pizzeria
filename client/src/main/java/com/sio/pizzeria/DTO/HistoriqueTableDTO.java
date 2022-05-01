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
public class HistoriqueTableDTO {
    	
    private int idHistoriqueTable;
    private int historiqueNumeroTable;
    private int historiqueNbPersonne;

    public HistoriqueTableDTO(int historiqueNumeroTable, int historiqueNbPersonne) {
        this.historiqueNumeroTable = historiqueNumeroTable;
        this.historiqueNbPersonne = historiqueNbPersonne;
    }

    public int getIdHistoriqueTable() {
        return idHistoriqueTable;
    }

    public void setIdHistoriqueTable(int idHistoriqueTable) {
        this.idHistoriqueTable = idHistoriqueTable;
    }

    public int getHistoriqueNumeroTable() {
        return historiqueNumeroTable;
    }

    public void setHistoriqueNumeroTable(int historiqueNumeroTable) {
        this.historiqueNumeroTable = historiqueNumeroTable;
    }

    public int getHistoriqueNbPersonne() {
        return historiqueNbPersonne;
    }

    public void setHistoriqueNbPersonne(int historiqueNbPersonne) {
        this.historiqueNbPersonne = historiqueNbPersonne;
    }

    
}
