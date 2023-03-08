<?php

$id= $_REQUEST["id"];   //idProf
$week= $_REQUEST["week"]; //settimana

$pdo = new PDO("mysql:host=localhost; dbname=gestione_orario", "root", "");
$query = $pdo->prepare("SELECT * FROM assenza WHERE idProf=? AND assData=?");
$query->execute([$id,$week]);

while($riga = $query->fetch()){
    //$query = $pdo->prepare("SELECT * FROM ora WHERE idProf=? AND assData=?");
    //$query->execute([$id,$week]);
    echo $riga[3].",";
}

?>