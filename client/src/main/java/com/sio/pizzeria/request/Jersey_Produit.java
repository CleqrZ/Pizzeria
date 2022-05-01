/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.sio.pizzeria.request;

import com.sio.pizzeria.DTO.ProduitDTO;
import jakarta.ws.rs.client.Client;
import jakarta.ws.rs.client.ClientBuilder;
import jakarta.ws.rs.client.Entity;
import jakarta.ws.rs.client.Invocation;
import jakarta.ws.rs.client.WebTarget;
import jakarta.ws.rs.core.MediaType;
import jakarta.ws.rs.core.Response;
import java.util.ArrayList;
import org.json.JSONArray;
import org.json.JSONObject;

/**
 *
 * @author Lenovo P50
 */
public class Jersey_Produit {

    
    public static void putProduit(int idProduit, String nom, float prix, int idType){
        Client client3 = ClientBuilder.newClient();
        WebTarget target3 = client3.target("http://localhost/Pizerria-Groupe-5/server/produit");
        Invocation.Builder invo3 = target3.request(MediaType.APPLICATION_JSON_TYPE);
        invo3.header("some-header", "true");
        JSONObject json_object = new JSONObject();
        json_object.put("idProduit", idProduit);
        json_object.put("nom", nom);
        json_object.put("prix", prix);
        json_object.put("idType", idType);
        Response reponse3 = invo3.put(Entity.entity(json_object.toString(), MediaType.APPLICATION_FORM_URLENCODED_TYPE));//on fait un POST
        System.out.println(reponse3.getStatus());
        System.out.println(reponse3.getStatusInfo());
    }
    
    public static void insertProduit(String nom, float prix, int idType){
        Client client4 = ClientBuilder.newClient();
        WebTarget target4 = client4.target("http://localhost/Pizerria-Groupe-5/server/produit");
        Invocation.Builder invo4 = target4.request(MediaType.APPLICATION_JSON_TYPE);
        invo4.header("some-header", "true");
        JSONObject json_object = new JSONObject();
        json_object.put("nom", nom);//on insert dans l'objet JSON {"nomMarque", "NVIDIA"} par exemple
        json_object.put("prix", prix);
        json_object.put("idType", idType);
        Response reponse4 = invo4.post(Entity.entity(json_object.toString(), MediaType.APPLICATION_FORM_URLENCODED_TYPE));//on fait un POST
        System.out.println(reponse4.getStatus());
        System.out.println(reponse4.getStatusInfo());
    }
    
    public static ProduitDTO tranformToObject(JSONObject jsonObject){
        System.out.println(jsonObject);
        Object ObjectNomProduit = jsonObject.get("nom");
        Object ObjectPrixProduit = jsonObject.get("prix");
        Object ObjectIdType = jsonObject.get("idType");
        String strObjectNomProduit = ObjectNomProduit.toString();
        String strObjectPrixProduit = ObjectPrixProduit.toString();
        String strObjectIdType = ObjectIdType.toString();
        Float floatObjectPrixProduit = Float.valueOf(strObjectPrixProduit);
        ProduitDTO JC = new ProduitDTO(strObjectNomProduit, floatObjectPrixProduit , Integer.valueOf(strObjectIdType));
        return JC;
    }
    
    public static ArrayList<ProduitDTO> tranformToObjectArray(JSONArray jsonArray){
        
        ArrayList<ProduitDTO> listObject = new ArrayList<>();
        
        for(Object json : jsonArray){
            String strjson = json.toString();
            JSONObject object = new JSONObject(strjson);
            ProduitDTO pizza = tranformToObject(object);
            listObject.add(pizza);
        }
        
        return listObject;
    }
}
