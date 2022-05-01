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
public class TypeProduitDTO {
    
    private int idType;
    private String nomType;

    public TypeProduitDTO(String nomType) {
        this.nomType = nomType;
    }

    public int getIdType() {
        return idType;
    }

    public void setIdType(int idType) {
        this.idType = idType;
    }

    public String getNomType() {
        return nomType;
    }

    public void setNomType(String nomType) {
        this.nomType = nomType;
    }
    
    
}
