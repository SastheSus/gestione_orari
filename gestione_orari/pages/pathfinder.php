<?php 
$id= $_REQUEST["id"];   //idAssenza
$hint='';
$idAss=0;
try{
$pdo = new PDO("mysql:host=localhost; dbname=gestione_orario", "root", "");

$text = "SELECT idProf, giorno, ora
         FROM assenza, ora
         WHERE Assenza.id = ?
         AND Assenza.id NOT IN (SELECT idAssenza FROM supplenza)
         AND idOra=ora.id";

$query= $pdo->prepare($text);
$query->execute([$id]);
$row = $query->fetchAll();

if($row != null){
    $result = "";
    $row2 = "";
    $text = "SELECT profhaora.idProf, prof.nome, prof.cognome, prof.oreSup
            FROM ora, prof, profhaora
            WHERE idProf != ?
            AND profhaora.idProf=prof.id
            AND profhaora.idOra=ora.id
            AND ora.idMateria LIKE ?
            AND ora.giorno = ?
            AND ora.ora = ?
            ORDER BY oreSup ASC";
    $query2= $pdo->prepare($text);
    $query2->execute([$row[0]['idProf'],'DISPOSIZIONE',$row[0]['giorno'],$row[0]['ora']]);
    while($row2=$query2->fetch()){
        $result .= $row2['idProf'].",";
    }

    echo $result === "" ? "NONE" : $result;
}


}
catch (PDOException $e){
    echo "Impossibile connettersi al server di database. ".$e;
    exit();
}
//se più di un prof a disposizione
//cercare l'idProf del select in profhaclasse
//cercare l'idProf del select in profhamateria
?>