package com.sio.pizzeria;

import com.sio.pizzeria.DTO.CommandeDTO;
import com.sio.pizzeria.DTO.ProduitDTO;
import com.sio.pizzeria.DTO.TablePizzeriaDTO;
import com.sio.pizzeria.request.Jersey_Commande;
import com.sio.pizzeria.request.Jersey_Produit;
import com.sio.pizzeria.request.Jersey_TablePizzeria;
import com.sio.pizzeria.request.basicCommande;
import java.io.IOException;
import java.net.URL;
import java.util.ArrayList;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.event.EventHandler;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.geometry.Insets;
import javafx.scene.Node;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.MenuButton;
import javafx.scene.control.MenuItem;
import javafx.scene.control.TextArea;
import javafx.scene.control.TitledPane;
import javafx.scene.image.ImageView;
import javafx.scene.input.MouseEvent;
import javafx.scene.layout.Background;
import javafx.scene.layout.BackgroundFill;
import javafx.scene.layout.CornerRadii;
import javafx.scene.layout.GridPane;
import javafx.scene.layout.Pane;
import javafx.scene.layout.VBox;
import javafx.scene.paint.Color;
import org.json.JSONArray;

public class PrimaryController implements Initializable {

    @FXML
    private void switchToSecondary() throws IOException {
        App.setRoot("secondary");
    }
    

    @FXML
    private Button btnAfficherTable;

    @FXML
    private Button btnAfficherProduit;
    
    @FXML
    private Button btnCréerTable;

    @FXML
    private Button btnCréerProduit;

    @FXML
    private Button btnHistorique;

    @FXML
    private Button buttunRefresh;

    @FXML
    private Pane pnlStatus;

    @FXML
    private Label lblStatus;
    
    @FXML
    private ImageView btnClose;
    
    @FXML
    private GridPane panelAccueil;

    @FXML
    private GridPane panelAfficher;

    @FXML
    private GridPane panelCréer;
    
    @FXML
    private GridPane pnlhistorique;
    
    @FXML
    private GridPane panelCreateTable;
    
    @FXML
    private MenuButton MenuType;

    @FXML
    private MenuItem TypePizza;

    @FXML
    private MenuItem TypeBoisson;

    @FXML
    private MenuItem TypeDessert;
    
    
    @FXML
    private VBox containerTables;
    
    @FXML
    private VBox containernum;
    
    @FXML
    private VBox containernbPersonne;
    
    @FXML
    private VBox containerProduit;
    
    @FXML
    private VBox containerDetails;

    @FXML
    private VBox containerPrix;
    
    @FXML
    private TextArea areaProduit;
    
    @FXML 
    private TextArea areaPrix;
    
    @FXML
    private Button create;
    
    @FXML
    private TextArea areaNumTable;
    
    @FXML
    private TextArea areaNbPersonne;
    
    @FXML
    private Button createTable;
    
    private int id = 0;

    
    @FXML
    private void handleClick (ActionEvent event){
        if (event.getSource() == btnHistorique){
            lblStatus.setText("Historique");
            pnlStatus.setBackground(new Background(new BackgroundFill(Color.RED, CornerRadii.EMPTY, Insets.EMPTY)));
            pnlhistorique.toFront();
        }
        else
        if (event.getSource() == btnAfficherTable){
            lblStatus.setText("Tables");
            pnlStatus.setBackground(new Background(new BackgroundFill(Color.FIREBRICK, CornerRadii.EMPTY, Insets.EMPTY)));
            panelAccueil.toFront(); 
        }
        else
        if (event.getSource() == btnCréerTable){
            lblStatus.setText("Création de Tables");
            pnlStatus.setBackground(new Background(new BackgroundFill(Color.ORANGE, CornerRadii.EMPTY, Insets.EMPTY)));
            panelCreateTable.toFront(); 
        }
        else
        if (event.getSource() == btnAfficherProduit){
            lblStatus.setText("Afficher");
            pnlStatus.setBackground(new Background(new BackgroundFill(Color.BLUE, CornerRadii.EMPTY, Insets.EMPTY)));
            panelAfficher.toFront();
        }
        else
        if (event.getSource() == btnCréerProduit){
            lblStatus.setText("Créer");
            pnlStatus.setBackground(new Background(new BackgroundFill(Color.PURPLE, CornerRadii.EMPTY, Insets.EMPTY)));
            panelCréer.toFront();
        }
    }
    
    
    
    
    
    
    @FXML
    private void selectMenu (ActionEvent event){
        id = 0;
        
    
        if ((MenuItem) event.getSource() == TypePizza){
            MenuType.setText("Pizza");
            id = 1;
        }
        else
        if (event.getSource() == TypeBoisson){
            MenuType.setText("Boisson");
            id = 2;

        } 
        else
        if (event.getSource() == TypeDessert){
            MenuType.setText("Dessert");
            id = 3;

        }
    }
    
    @FXML
    private void handleClose (javafx.scene.input.MouseEvent event){
        if (event.getSource() == btnClose){
            System.exit(0);
        }
    }
    
    
    private void affichageTable(){
        
        JSONArray listTable = basicCommande.getCommandeAll("tablePizzeria");
        //JSONArray listCommande = basicCommande.getCommandeAll("commande");
  
        
        ArrayList<TablePizzeriaDTO> listetable = new ArrayList<>();
        //ArrayList<CommandeDTO> listeCommande = new ArrayList<>();
 
        
        
        listetable = Jersey_TablePizzeria.tranformToObjectArray(listTable);
        /*listeCommande = Jersey_Commande.tranformToObjectArray(listCommande);
   
        
        String commandes = String.valueOf(listeCommande);
        System.out.println(commandes);
        */
        
        for (TablePizzeriaDTO table :listetable){
            
            int num = table.getNumeroTable();
            int nbPersonne = table.getNbPersonne();
            
            TitledPane commandeDetails = new TitledPane();
            commandeDetails.setText("table" +" " + num);
            
            
                /*for(CommandeDTO commande : listeCommande){
                    
                   int id = commande.getIdCommande();
                   
                   Label test = new Label();
                   test.setText(commandes);
                   commandeDetails.setContent(test);
                   
                    
                }
            */  
                
            
            
            
            String numero = String.valueOf(num);
            String nombres = String.valueOf(nbPersonne);
            
            Label numTable = new Label();
            Label nombre = new Label();
            
            numTable.setText(numero);
            nombre.setText(nombres);
            
            containernbPersonne.getChildren().add(nombre);
            containernum.getChildren().add(numTable);
            containerDetails.getChildren().add(commandeDetails);
        }

    }
    
    private void creationTable(){

        EventHandler<MouseEvent> créerTable = new EventHandler<>(){
            @Override
            public void handle(MouseEvent t) {
                int id = Integer.parseInt(areaNumTable.getText());
                int nbPersonne = Integer.parseInt(areaNbPersonne.getText());
                Jersey_TablePizzeria.insertTablePizzeria(id,id,nbPersonne);
            }
            
};
        
        createTable.addEventHandler(MouseEvent.MOUSE_CLICKED, créerTable);
    }
    
    
    private void creationProduit(){

        EventHandler<MouseEvent> créer = new EventHandler<>(){
            @Override
            public void handle(MouseEvent t) {
                float f = Float.parseFloat(areaPrix.getText());
                Jersey_Produit.insertProduit(areaProduit.getText(),f,id);
                System.out.println(f);
            }
};
        
        create.addEventHandler(MouseEvent.MOUSE_CLICKED, créer);
    }
/*
    private void modifierProduit(){
         EventHandler<MouseEvent> modifier = new EventHandler<>() {
                @Override
                public void handle(MouseEvent t) {
                    
                    Stage modif = new Stage();
                    VBox VBoxmodif = new VBox();
                    Label libelleProduit = new Label();
                    Label Prix = new Label();
                    TextArea areaProduit = new TextArea();
                    TextArea areaPrix = new TextArea();
                    
                    libelleProduit.setText();
                    typeProduit.setText();
                    Prix.setText();
                    
                    modif.getChildren().add(VBoxmodif);
                }    
            };
    }
*/
    
    
    private void affichageProduit(){
        JSONArray listProduit = basicCommande.getCommandeAll("produit");
        
        
        ArrayList<ProduitDTO> listproduit =  new ArrayList<>();
        listproduit = Jersey_Produit.tranformToObjectArray(listProduit);
               
        System.out.println(listproduit);
        for (ProduitDTO produit : listproduit){
            
            
            EventHandler<MouseEvent> supprimer = new EventHandler<>() {
                @Override
                public void handle(MouseEvent t) {
                    basicCommande.deleteCommande("produit", produit.getIdProduit());
                }    
            };

            
            String nom = produit.getNomProduit();
            String prix = String.valueOf(produit.getPrix());
            
            
            Label nomProduit = new Label();
            Label prixProduit = new Label(); 
            Button modif = new Button();
            Button suppr = new Button();
            
            modif.setText("modifier");
            suppr.setText("supprimmer");
            suppr.addEventHandler(MouseEvent.MOUSE_CLICKED, supprimer);
            
            nomProduit.setText(nom);
            prixProduit.setText(prix);
            
            containerProduit.getChildren().add(nomProduit);
            containerProduit.getChildren().add(prixProduit);
            containerProduit.getChildren().add(modif);
            containerProduit.getChildren().add(suppr);            
        }  
    }


    @Override
    public void initialize(URL url, ResourceBundle rb) {
       affichageTable();
       affichageProduit();
       creationProduit();
       creationTable();
    }  
}
