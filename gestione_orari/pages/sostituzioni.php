<?php 
$d= $_REQUEST["d"];     //giorno
$h= $_REQUEST["h"];     //ora
$id= $_REQUEST["id"];   //idProf
$m= $_REQUEST["m"];     //motivo
$idH= $_REQUEST["idH"]; //idOra
$week= $_REQUEST["week"]; //anno e settimana
$week = explode("-W",$week);
$hint='';
$idAss=0;
try{
$pdo = new PDO("mysql:host=localhost; dbname=gestione_orario", "root", "");

$query = $pdo->prepare("SELECT COUNT(*) FROM assenza");
$query->execute();
$idAss = $query->fetch();

$query = $pdo->prepare("INSERT INTO assenza (id,motivo,idProf,idOra,anno,settimana) VALUES (?,?,?,?,?,?)");
$query -> execute([$idAss[0],$m,$id,$idH,intval($week[0]),intval($week[1])]);
echo $week[0];
}
catch (PDOException $e){
    echo "Impossibile connettersi al server di database. ".$e;
    exit();
}
//se più di un prof a disposizione
//cercare l'idProf del select in profhaclasse
//cercare l'idProf del select in profhamateria

echo $hint === "" ? "no suggestion" : $hint;
?>
