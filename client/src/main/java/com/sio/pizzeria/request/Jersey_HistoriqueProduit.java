/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.sio.pizzeria.request;

import com.sio.pizzeria.DTO.HistoriqueProduitDTO;
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
public class Jersey_HistoriqueProduit {
     
     public static void putHistoriqueProduit(int idHistorique, String nomProduit, float prixProduit, int idType){
        Client client3 = ClientBuilder.newClient();
        WebTarget target3 = client3.target("http://localhost/Pizerria-Groupe-5/server/historiqueProduit");
        Invocation.Builder invo3 = target3.request(MediaType.APPLICATION_JSON_TYPE);
        invo3.header("some-header", "true");
        JSONObject json_object = new JSONObject();
        json_object.put("idHistorique", idHistorique);
        json_object.put("nomProduit", nomProduit);
        json_object.put("prixProduit", prixProduit);
        json_object.put("idType", idType);
        Response reponse3 = invo3.put(Entity.entity(json_object.toString(), MediaType.APPLICATION_FORM_URLENCODED_TYPE));//on fait un POST
        System.out.println(reponse3.getStatus());
        System.out.println(reponse3.getStatusInfo());
    }
     
     public static void insertHistoriqueProduit(String nomProduit, float prixProduit, int idType){
        Client client4 = ClientBuilder.newClient();
        WebTarget target4 = client4.target("http://localhost/Pizerria-Groupe-5/server/historiqueProduit");
        Invocation.Builder invo4 = target4.request(MediaType.APPLICATION_JSON_TYPE);
        invo4.header("some-header", "true");
        JSONObject json_object = new JSONObject();
        json_object.put("nomProduit", nomProduit);//on insert dans l'objet JSON {"nomMarque", "NVIDIA"} par exemple
        json_object.put("prixProduit", prixProduit);
        json_object.put("idType", idType);
        Response reponse4 = invo4.post(Entity.entity(json_object.toString(), MediaType.APPLICATION_FORM_URLENCODED_TYPE));//on fait un POST
        System.out.println(reponse4.getStatus());
        System.out.println(reponse4.getStatusInfo());
    }
     
     public static HistoriqueProduitDTO tranformToObject(JSONObject jsonObject){
        System.out.println(jsonObject);
        Object ObjectNomProduit = jsonObject.get("nomProduit");
        Object ObjectPrixProduit = jsonObject.get("prixProduit");
        Object ObjectIdType = jsonObject.get("idType");
        ObjectNomProduit = ObjectNomProduit.toString();
        ObjectPrixProduit = ObjectPrixProduit.toString();
        ObjectIdType = ObjectIdType.toString();
        String strObjectNomProduit = ObjectNomProduit.toString();
        String strObjectPrixProduit = ObjectPrixProduit.toString();
        String strObjectIdType = ObjectIdType.toString();
         Float floatObjectPrixProduit = Float.valueOf(strObjectPrixProduit);
        HistoriqueProduitDTO JC = new HistoriqueProduitDTO(strObjectNomProduit, floatObjectPrixProduit, Integer.valueOf(strObjectIdType));
        return JC;
    }
     
     public static ArrayList<HistoriqueProduitDTO> tranformToObjectArray(JSONArray jsonArray){
        
        ArrayList<HistoriqueProduitDTO> listObject = new ArrayList<>();
        
        for(Object json : jsonArray){
            String strjson = json.toString();
            JSONObject object = new JSONObject(strjson);
            HistoriqueProduitDTO pizza = tranformToObject(object);
            listObject.add(pizza);
        }
        
        return listObject;
    }
}
