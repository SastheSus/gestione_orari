<?php 
$id= $_REQUEST["id"];   //idAssenza
$hint='';
$idAss=0;
try{
$pdo = new PDO("mysql:host=localhost; dbname=gestione_orario", "root", "");

$text = "SELECT idProf, giorno, ora
         FROM assenza, ora
         WHERE Assenza.id = ?
         AND idOra=ora.id";

$query= $pdo->prepare($text);
$query->execute([$id]);
$ass = $query->fetchAll();

$text = "SELECT idProf
         FROM supplenza
         WHERE supplenza.idAssenza = ?";

$query= $pdo->prepare($text);
$query->execute([$id]);
$sup = $query->fetchAll();

if($ass != null){
    $result = "";
    $prof = "";
    $text = "SELECT profhaora.idProf, prof.nome, prof.cognome, prof.oreSup
            FROM ora, prof, profhaora
            WHERE idProf != ?
            AND profhaora.idProf=prof.id
            AND profhaora.idOra=ora.id
            AND ora.idMateria LIKE ?
            AND ora.giorno = ?
            AND ora.ora = ?
            ORDER BY oreSup ASC";
    $query= $pdo->prepare($text);
    $query->execute([$ass[0]['idProf'],'DISPOSIZIONE',$ass[0]['giorno'],$ass[0]['ora']]);
    while($prof=$query->fetch()){
        if($prof['idProf']!=""){
            if($sup!=null && $sup[0]['idProf']==$prof['idProf']){
                $result .= $prof['idProf']."*,";
            }
            else{
                $result .= $prof['idProf'].",";
            }
        }
    }

    echo $result === "" ? "NONE" : rtrim($result, ",");
}


}
catch (PDOException $e){
    echo "Impossibile connettersi al server di database. ".$e;
    exit();
}
?>