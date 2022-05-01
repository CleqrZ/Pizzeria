#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: tablePizzeria
#------------------------------------------------------------

CREATE TABLE tablePizzeria(
        idTable     Int  Auto_increment,
        numeroTable Int,
        nbPersonne  Int
	,CONSTRAINT tablePizzeria_PK PRIMARY KEY (idTable)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: historiqueTable
#------------------------------------------------------------

CREATE TABLE historiqueTable(
        idHistoriqueTable     Int  Auto_increment,
        historiqueNumeroTable Int,
        historiqueNbPersonne  Int
	,CONSTRAINT historiqueTable_PK PRIMARY KEY (idHistoriqueTable)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: typeProduit
#------------------------------------------------------------

CREATE TABLE typeProduit(
        idType  Int  Auto_increment,
        nomType Varchar (30)
	,CONSTRAINT typeProduit_PK PRIMARY KEY (idType)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: produit
#------------------------------------------------------------

CREATE TABLE produit(
        idProduit Int  Auto_increment,
        nom       Varchar (100),
        prix      Float,
        idType    Int
	,CONSTRAINT produit_PK PRIMARY KEY (idProduit)

	,CONSTRAINT produit_typeProduit_FK FOREIGN KEY (idType) REFERENCES typeProduit(idType)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: historiqueProduit
#------------------------------------------------------------

CREATE TABLE historiqueProduit(
        idHistorique Int  Auto_increment,
        nomProduit   Varchar (30),
        prixProduit  Float,
        idType       Int
	,CONSTRAINT historiqueProduit_PK PRIMARY KEY (idHistorique)

	,CONSTRAINT historiqueProduit_typeProduit_FK FOREIGN KEY (idType) REFERENCES typeProduit(idType)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commande
#------------------------------------------------------------

CREATE TABLE commande(
        idCommande Int Auto_increment,
        idTable   Int,
        idProduit Int,
        nbProduit Int
	,CONSTRAINT commande_PK PRIMARY KEY (idCommande)

	,CONSTRAINT commande_tablePizzeria_FK FOREIGN KEY (idTable) REFERENCES tablePizzeria(idTable)
	,CONSTRAINT commande_produit0_FK FOREIGN KEY (idProduit) REFERENCES produit(idProduit)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commandePayer
#------------------------------------------------------------

CREATE TABLE commandePayer(
        idCommandePayer Int Auto_increment,
        idHistoriqueProduit Int,
        idHistoriqueTable Int,
        nbProduit Int,
        date Date
	,CONSTRAINT commandePayer_PK PRIMARY KEY (idCommandePayer)

	,CONSTRAINT commandePayer_historiqueProduit_FK FOREIGN KEY (idHistoriqueProduit) REFERENCES historiqueProduit(idHistorique)
	,CONSTRAINT commandePayer_historiqueTable0_FK FOREIGN KEY (idHistoriqueTable) REFERENCES historiqueTable(idHistoriqueTable)
)ENGINE=InnoDB;

