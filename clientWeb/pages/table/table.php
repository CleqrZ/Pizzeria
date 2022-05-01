


<?php
$tabTables =TableController::getTable();
$listeTableVide = $tabTables[0];
$listeTableOccupe = $tabTables[1];
?>



<div class="container-fluid" style="background-color: #EED436">
    <div class="row">
        <div class="col-lg-6 col-12 ">
            <div class="col-lg-12 col-12 d-flex justify-content-center" style="background-color: #D50000; color: white; box-shadow: 10px 5px 5px 	#FF4D00;">
                <label style="font-size: 30px;"> Table(s) vide(s) :</label>
            </div>
            <form action="index.php?" method="GET" style="background-color: #F9E569; margin-top: 10px;">
                <div class="col-lg-12 col-12 d-flex justify-content-center">
                    <label> Table :</label>
                </div>
                <input type="hidden" name="page" value="produit"/>

                <div class="col-lg-12 col-12 d-flex justify-content-center">
                    <select name='table'>
                        <?php
                        foreach ($listeTableVide as $table){
                            echo "<option value=".$table->getIdTable().">".$table->getNumeroTable()."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-lg-12 col-12 d-flex justify-content-center" style="margin-top: 10px;">
                    <label> Nombre de personne :</label>
                </div>
                <div class="col-lg-12 col-12 d-flex justify-content-center" >
                    <input type="number" id="quantity" name="nbPersonne">
                </div>

                <div class="col-lg-12 col-12 d-flex justify-content-center" style="margin-top: 10px;">
                    <div class="mx-auto">
                        <button type="submit">Choisir</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-6 col-12">
            <div class="col-lg-12 col-12 d-flex justify-content-center" style="background-color: #D50000; color: white; box-shadow: 10px 5px 5px 	#FF4D00;">
                <label  style="font-size: 30px;"> Table(s) occupée(s) :</label>
            </div>
            <form action="index.php?" method="GET" style="background-color: #F9E569; margin-top: 10px;">
                <div class="col-lg-12 col-12 d-flex justify-content-center">
                    <label> Table :</label>
                </div>
                <input type="hidden" name="page" value="produit"/>
                <div class="col-lg-12 col-12 d-flex justify-content-center">
                    <select name='table'>
                        <?php
                        foreach ($listeTableOccupe as $table){
                            echo "<option value=".$table->getIdTable().">".$table->getNumeroTable()."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-lg-12 col-12 d-flex justify-content-center" style="margin-top: 10px;">
                    <button type="submit">Choisir</button>
                </div>
            </form>
        </div>
</div>

