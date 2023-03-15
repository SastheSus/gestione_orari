<?php 
$id= $_REQUEST["id"];   //idAssenza
$idProf= $_REQUEST["idProf"];   //idProf
try{
$pdo = new PDO("mysql:host=localhost; dbname=gestione_orario", "root", "");

$text = "INSERT INTO supplenza(idProf, idAssenza) VALUES (?, ?)";

$query= $pdo->prepare($text);
$query->execute([$idProf,$id]);
}
catch (PDOException $e){
    echo "Impossibile connettersi al server di database. ".$e;
    exit();
}
?>