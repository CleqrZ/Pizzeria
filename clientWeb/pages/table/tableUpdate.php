<?php
$table =TableController::getTableById($_GET['table']);
if($table->getNbPersonne() !=0){
    $string = "Table n° <b>".$table->getNumeroTable()."</b> avec <b>".$table->getNbPersonne()."</b> personne(s) <br>";
    echo "<div class='container-fluid'>";
    echo "<div class='row d-flex justify-content-center'>";
    echo "<div class='col-lg-2 d-flex justify-content-around align-items-center'>";
    echo $string;
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
else{
    if(isset($_GET['table']) and isset($_GET['nbPersonne'])){
        TableController::updateTable($_GET['table'],$_GET['nbPersonne']);
        echo "Table n°".$table->getNumeroTable()." avec ".$table->getNbPersonne()." personne(s) <br>";
    }
}