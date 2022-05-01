<?php
$list = ProduitController::getListProduit();
$tabType = $list[0];
$tabProduit = $list[1];

echo "<div class='container-fluid'>";
echo "<div class='row '  class='container-css'>";
foreach ($tabType as $typ){
    echo "<div class='col-12 col-lg-4 '>";
    echo "<div class='col-lg-11 '>";
    echo "<label>".$typ->getNomType()." :</label>";?>
    </div>


    <form action="index.php?" method="GET" style="background-color: #FEC238; margin-top:10px;">
        <input type="hidden"  name="page" value="insert"/>
        <input type="hidden" name="idTable" value="<?php echo $_GET['table']; ?>"/>
        <div class='col-lg-11 ' >
            <select name='idProduit'>
                <?php
                foreach ($tabProduit as $prod){
                    if($typ->getIdType() == $prod->getIdType()){
                        echo "<option value=".$prod->getIdProduit().">".$prod->getNom()."</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class='col-lg-11 ' style="background-color: #FEC238; margin-top:10px;">
            <label> Nombre commandé(s) :</label>
        </div>

        <div class='col-lg-11 ' style="background-color: #FEC238; margin-top:10px;">
            <input type="number" id="quantity" name="nb">
        </div>

        <div class='col-lg-11 ' style="background-color: #FEC238; margin-top:10px;">
            <button type="submit">Choisir</button>
        </div>
    </form>
    </div>
<?php
}
echo "</div>";
echo "</div>";
