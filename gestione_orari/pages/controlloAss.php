<?php

$id= $_REQUEST["id"];   //idProf
$week= $_REQUEST["week"]; //anno e settimana
$week = explode("-W",$week);

$pdo = new PDO("mysql:host=localhost; dbname=gestione_orario", "root", "");
$query = $pdo->prepare("SELECT * FROM assenza WHERE idProf=? AND anno=? AND settimana=?");
$query->execute([$id,$week[0],$week[1]]);

while($riga = $query->fetch()){
    echo $riga[3].",";
}

?>