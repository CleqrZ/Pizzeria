<?php
$listCommande = CommandeController::CommandeByIdTable($_GET['table']);


echo "<div class='col-lg-12 col-12 d-flex justify-content-center'>"."<div class='col-lg-12 col-12 d-flex justify-content-center'>";
echo "<label> Commande de la table </label> ".$_GET['table']." :<br>";
echo "</div>"."</div>";
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-12 d-flex justify-content-center">
            <div class="col-lg-12 col-12 d-flex justify-content-center">
                <form action="index.php?" method="GET" style="background-color: #FEC238; margin-top:10px;">
                    <input type="hidden" name="page" value="deleteAll"/>
                    <input type="hidden" name="idTable" value="<?php echo $_GET['table']; ?>" style="font-size: 17px;font-weight: bold;border: 7px outset rgba(178,0,0,0.55);border-radius: 0px 20px 0px 0px;"/>
                    <button type="submit">Vider Commande</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php


if($listCommande != null){
    foreach ($listCommande as $commande){
        ?>
        <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12 col-12 d-flex justify-content-center">
        <div class="col-lg-12 col-12 d-flex justify-content-center">
        <?php
        $produit =ProduitController::getProduitById($commande->getIdProduit());
        echo $commande->getNbProduit()." ". $produit->getNom();
        ?>
        </div>
        </div>
        </div>
        <div class="row">
        <div class="col-lg-12 col-12 d-flex justify-content-center">
            <div class="col-lg-12 col-12 d-flex justify-content-center">
                <form action="index.php?" method="GET" style="background-color: #FEC238; margin-top:10px;">
                    <input type="hidden" name="page" value="delete"/>
                    <input type="hidden" name="idTable" value="<?php echo $_GET['table']; ?>"/>
                    <input type="hidden" name="idProduit" value="<?php echo $commande->getIdCommande(); ?>"/>
                    <button type="submit">Supprimer</button>
                </form>
            </div>

        </div>
        </div>
        <?php
    }
}
else{
    echo "<div class='col-lg-12 col-12 d-flex justify-content-center'>"."<div class='col-lg-12 col-12 d-flex justify-content-center'>";
    echo "Rien n'a été commander à cette table";
    echo "</div>"."</div>";

}