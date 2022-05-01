/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.sio.pizzeria.request;

import jakarta.ws.rs.client.Client;
import jakarta.ws.rs.client.ClientBuilder;
import jakarta.ws.rs.client.Invocation;
import jakarta.ws.rs.client.WebTarget;
import jakarta.ws.rs.core.MediaType;
import jakarta.ws.rs.core.Response;
import org.json.JSONArray;
import org.json.JSONObject;

/**
 *
 * @author Lenovo P50
 */
public class basicCommande {
    
     public static JSONObject getCommande(String nomOperation, int idCommande){
        Client client = ClientBuilder.newClient(); //créé un nouveau client 
        WebTarget target = client.target("http://localhost/Pizerria-Groupe-5/server/"+nomOperation+"/"+idCommande); //cible une ressource web
        Invocation.Builder invo = target.request(MediaType.TEXT_PLAIN_TYPE); //créer une nouvelle invocation
        invo.header("some-header", "true"); 
        Response reponse = invo.get();  //appel de la requete
        JSONObject jsonObject = new JSONObject(reponse.readEntity(String.class));
        return jsonObject;
    }
     
     public static JSONArray getCommandeAll(String nomOperation){
        Client client = ClientBuilder.newClient(); //créé un nouveau client 
        WebTarget target = client.target("http://localhost/Pizerria-Groupe-5/server/"+nomOperation); //cible une ressource web
        Invocation.Builder invo3 = target.request(MediaType.TEXT_PLAIN_TYPE); //créer une nouvelle invocation
        invo3.header("some-header", "true"); 
        Response reponse = invo3.get();  //appel de la requete
        String result = reponse.readEntity(String.class);
        JSONArray jsonObject2 = new JSONArray(result);
        return jsonObject2;
    }
    
    public static void deleteCommande(String nomOperation, int idCommande){
        Client client2 = ClientBuilder.newClient();
        WebTarget target2 = client2.target("http://localhost/Pizerria-Groupe-5/server/"+nomOperation+"/"+idCommande);
        Invocation.Builder invo2 = target2.request(MediaType.TEXT_PLAIN_TYPE); //créer une nouvelle invocation
        invo2.header("some-header", "true"); 
        Response reponse = invo2.delete();  //appel de la requete
        System.out.println("cela renvoie " + reponse);
        System.out.println(reponse.getStatus()); //renvoie le status
        System.out.println(reponse.readEntity(String.class)); // donne l'objet total
        System.out.println(reponse.getStatusInfo()); //renvoie reason
    }
    
}
