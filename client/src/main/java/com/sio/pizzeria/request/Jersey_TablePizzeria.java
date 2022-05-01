/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.sio.pizzeria.request;

import com.sio.pizzeria.DTO.TablePizzeriaDTO;
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
public class Jersey_TablePizzeria {
 
    public static void putTablePizzeria(int idTable, int numeroTable, int nbPersonne){
        Client client3 = ClientBuilder.newClient();
        WebTarget target3 = client3.target("http://localhost/Pizerria-Groupe-5/server/tablePizzeria");
        Invocation.Builder invo3 = target3.request(MediaType.APPLICATION_JSON_TYPE);
        invo3.header("some-header", "true");
        JSONObject json_object = new JSONObject();
        json_object.put("idTable", idTable);
        json_object.put("numeroTable", numeroTable);
        json_object.put("nbPersonne", nbPersonne);
        Response reponse3 = invo3.put(Entity.entity(json_object.toString(), MediaType.APPLICATION_FORM_URLENCODED_TYPE));//on fait un POST
        System.out.println(reponse3.getStatus());
        System.out.println(reponse3.getStatusInfo());
    }
    
    
    public static void insertTablePizzeria(int idTable, int numeroTable, int nbPersonne){
        Client client4 = ClientBuilder.newClient();
        WebTarget target4 = client4.target("http://localhost/Pizerria-Groupe-5/server/tablePizzeria");
        Invocation.Builder invo4 = target4.request(MediaType.APPLICATION_JSON_TYPE);
        invo4.header("some-header", "true");
        JSONObject json_object = new JSONObject();
        json_object.put("idTable", idTable);//on insert dans l'objet JSON {"nomMarque", "NVIDIA"} par exemple
        json_object.put("numeroTable", numeroTable);
        json_object.put("nbPersonne", nbPersonne);
        Response reponse4 = invo4.post(Entity.entity(json_object.toString(), MediaType.APPLICATION_FORM_URLENCODED_TYPE));//on fait un POST
        System.out.println(reponse4.getStatus());
        System.out.println(reponse4.getStatusInfo());
    }
    
    public static TablePizzeriaDTO tranformToObject(JSONObject jsonObject){
        System.out.println(jsonObject);
        Object ObjectNumeroTable = jsonObject.get("numeroTable");
        Object ObjectNbPersonne = jsonObject.get("nbPersonne");
        ObjectNumeroTable = ObjectNumeroTable.toString();
        ObjectNbPersonne = ObjectNbPersonne.toString();
        String strObjectNumeroTable = ObjectNumeroTable.toString();
        String strObjectNbPersonne = ObjectNbPersonne.toString();
        TablePizzeriaDTO JC = new TablePizzeriaDTO(Integer.valueOf(strObjectNumeroTable), Integer.valueOf(strObjectNbPersonne));
        return JC;
    }
    
    public static ArrayList<TablePizzeriaDTO> tranformToObjectArray(JSONArray jsonArray){
        
        ArrayList<TablePizzeriaDTO> listObject = new ArrayList<>();
        
        for(Object json : jsonArray){
            String strjson = json.toString();
            JSONObject object = new JSONObject(strjson);
            TablePizzeriaDTO pizza = tranformToObject(object);
            listObject.add(pizza);
        }
        
        return listObject;
    }
        
}
