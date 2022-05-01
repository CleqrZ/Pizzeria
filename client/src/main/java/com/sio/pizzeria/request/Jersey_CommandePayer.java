/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.sio.pizzeria.request;

import com.sio.pizzeria.DTO.CommandePayerDTO;
import jakarta.ws.rs.client.Client;
import jakarta.ws.rs.client.ClientBuilder;
import jakarta.ws.rs.client.Entity;
import jakarta.ws.rs.client.Invocation;
import jakarta.ws.rs.client.WebTarget;
import jakarta.ws.rs.core.MediaType;
import jakarta.ws.rs.core.Response;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import org.json.JSONArray;
import org.json.JSONObject;

/**
 *
 * @author Lenovo P50
 */
public class Jersey_CommandePayer {
     
     public static void putCommandePayer(int idCommandePayer, int idHistoriqueProduit, int idHistoriqueTable, int nbProduit){
         Client client3 = ClientBuilder.newClient();
        WebTarget target3 = client3.target("http://localhost/Pizerria-Groupe-5/server/commandePayer");
        Invocation.Builder invo3 = target3.request(MediaType.APPLICATION_JSON_TYPE);
        invo3.header("some-header", "true");
        JSONObject json_object = new JSONObject();
        json_object.put("idCommandePayer", idCommandePayer);
        json_object.put("idHistoriqueProduit", idHistoriqueProduit);
        json_object.put("idHistoriqueTable", idHistoriqueTable);
        json_object.put("nbProduit", nbProduit);
        Response reponse3 = invo3.put(Entity.entity(json_object.toString(), MediaType.APPLICATION_FORM_URLENCODED_TYPE));//on fait un POST
        System.out.println(reponse3.getStatus());
        System.out.println(reponse3.getStatusInfo());
    }
     
      public static void insertCommandePayer(int idHistoriqueProduit, int idHistoriqueTable, int nbProduit){
         Client client3 = ClientBuilder.newClient();
        WebTarget target3 = client3.target("http://localhost/Pizerria-Groupe-5/server/commandePayer");
        Invocation.Builder invo3 = target3.request(MediaType.APPLICATION_JSON_TYPE);
        invo3.header("some-header", "true");
        JSONObject json_object = new JSONObject();
        json_object.put("idHistoriqueProduit", idHistoriqueProduit);
        json_object.put("idHistoriqueTable", idHistoriqueTable);
        json_object.put("nbProduit", nbProduit);
        Response reponse3 = invo3.post(Entity.entity(json_object.toString(), MediaType.APPLICATION_FORM_URLENCODED_TYPE));//on fait un POST
        System.out.println(reponse3.getStatus());
        System.out.println(reponse3.getStatusInfo());
    }
      
      public static CommandePayerDTO tranformToObject(JSONObject jsonObject) throws ParseException{
        System.out.println(jsonObject);
        Object ObjectIdHistoriqueProduit = jsonObject.get("idHistoriqueProduit");
        Object ObjectIdHistoriqueTable = jsonObject.get("idHistoriqueTable");
        Object ObjectNbProduit = jsonObject.get("nbProduit");
        Object ObjectDate = jsonObject.get("date");
        ObjectIdHistoriqueProduit = ObjectIdHistoriqueProduit.toString();
        ObjectIdHistoriqueTable = ObjectIdHistoriqueTable.toString();
        ObjectNbProduit = ObjectNbProduit.toString();
        ObjectDate = ObjectDate.toString();
        String strObjectIdHistoriqueProduit = ObjectIdHistoriqueProduit.toString();
        String strObjectIdHistoriqueTable = ObjectIdHistoriqueTable.toString();
        String strObjectNbProduit = ObjectNbProduit.toString();
        String strDate = ObjectDate.toString();
        Date date = new SimpleDateFormat(strDate).parse(strDate);
        CommandePayerDTO JC = new CommandePayerDTO(Integer.valueOf(strObjectIdHistoriqueProduit), Integer.valueOf(strObjectIdHistoriqueTable), Integer.valueOf(strObjectNbProduit), date);
        return JC;
    }
      
      public static ArrayList<CommandePayerDTO> tranformToObjectArray(JSONArray jsonArray) throws ParseException{
        
        ArrayList<CommandePayerDTO> listObject = new ArrayList<>();
        
        for(Object json : jsonArray){
            String strjson = json.toString();
            JSONObject object = new JSONObject(strjson);
            CommandePayerDTO pizza = tranformToObject(object);
            listObject.add(pizza);
        }
        
        return listObject;
    }
}
