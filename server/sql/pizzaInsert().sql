#------------------------------------------------------------
# Insertion: typeProduit
#------------------------------------------------------------

INSERT INTO typeProduit(nomType)
VALUES ("pizza"),
("boisson"),
("dessert");

#------------------------------------------------------------
# Insertion: Produit
#------------------------------------------------------------

INSERT INTO produit(nom,prix,idType)
VALUES ("pizza peperonie",5.5,1),
("coca", 2,2),
("tarte au pomme",4.5,3);

#------------------------------------------------------------
# Insertion: Produit
#------------------------------------------------------------

INSERT INTO tablepizzeria(numeroTable,nbPersonne)
VALUES (1,0),
(2,0),
(3,0);