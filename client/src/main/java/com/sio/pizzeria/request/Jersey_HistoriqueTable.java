/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.sio.pizzeria.request;

import com.sio.pizzeria.DTO.HistoriqueTableDTO;
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
public class Jersey_HistoriqueTable {
    
    public static void putHistoriqueTable(int idHistoriqueTable, int HistoriqueNumeroTable, int historiqueNbPersonne){
        Client client3 = ClientBuilder.newClient();
        WebTarget target3 = client3.target("http://localhost/Pizerria-Groupe-5/server/historiqueTable");
        Invocation.Builder invo3 = target3.request(MediaType.APPLICATION_JSON_TYPE);
        invo3.header("some-header", "true");
        JSONObject json_object = new JSONObject();
        json_object.put("idHistoriqueTable", idHistoriqueTable);
        json_object.put("historiqueNumeroTable", HistoriqueNumeroTable);
        json_object.put("historiqueNbPersonne", historiqueNbPersonne);
        Response reponse3 = invo3.put(Entity.entity(json_object.toString(), MediaType.APPLICATION_FORM_URLENCODED_TYPE));//on fait un POST
        System.out.println(reponse3.getStatus());
        System.out.println(reponse3.getStatusInfo());
    }
    
    public static void insertHistoriqueTable(float HistoriqueNumeroTable, int historiqueNbPersonne){
        Client client4 = ClientBuilder.newClient();
        WebTarget target4 = client4.target("http://localhost/Pizerria-Groupe-5/server/historiqueTable");
        Invocation.Builder invo4 = target4.request(MediaType.APPLICATION_JSON_TYPE);
        invo4.header("some-header", "true");
        JSONObject json_object = new JSONObject();
        json_object.put("historiqueNumeroTable", HistoriqueNumeroTable);//on insert dans l'objet JSON {"nomMarque", "NVIDIA"} par exemple
        json_object.put("historiqueNbPersonne", historiqueNbPersonne);
        Response reponse4 = invo4.post(Entity.entity(json_object.toString(), MediaType.APPLICATION_FORM_URLENCODED_TYPE));//on fait un POST
        System.out.println(reponse4.getStatus());
        System.out.println(reponse4.getStatusInfo());
    }
    
     public static HistoriqueTableDTO tranformToObject(JSONObject jsonObject){
        System.out.println(jsonObject);
        Object ObjectHistoriqueNumeroTable = jsonObject.get("historiqueNumeroTable");
        Object ObjectHistoriqueNbPersonne = jsonObject.get("historiqueNbPersonne");
        ObjectHistoriqueNumeroTable = ObjectHistoriqueNumeroTable.toString();
        ObjectHistoriqueNbPersonne = ObjectHistoriqueNbPersonne.toString();
        String strObjectHistoriqueNumeroTable =  ObjectHistoriqueNumeroTable.toString();
        String strObjectHistoriqueNbPersonne = ObjectHistoriqueNbPersonne.toString();
        HistoriqueTableDTO JC = new HistoriqueTableDTO(Integer.valueOf(strObjectHistoriqueNumeroTable), Integer.valueOf(strObjectHistoriqueNbPersonne));
        return JC;
    }
     
     public static ArrayList<HistoriqueTableDTO> tranformToObjectArray(JSONArray jsonArray){
        
        ArrayList<HistoriqueTableDTO> listObject = new ArrayList<>();
        
        for(Object json : jsonArray){
            String strjson = json.toString();
            JSONObject object = new JSONObject(strjson);
            HistoriqueTableDTO pizza = tranformToObject(object);
            listObject.add(pizza);
        }
        
        return listObject;
    }
}
