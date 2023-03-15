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
    $query= $pdo->prepare($text);
    $query->execute([$row[0]['idProf'],'DISPOSIZIONE',$row[0]['giorno'],$row[0]['ora']]);
    while($row2=$query->fetch()){
        $text = "SELECT supplenza.idProf
        FROM assenza, supplenza
        WHERE assenza.id = ?
        AND assenza.id = supplenza.idAssenza";
        $query2= $pdo->prepare($text);
        $query2->execute([$id]);
        $row3 = $query2->fetchAll();
        if($row2['idProf']!="")
        $result .= $row2['idProf'].",";
    }

    echo $result === "" ? "NONE" : rtrim($result, ",");
}


}
catch (PDOException $e){
    echo "Impossibile connettersi al server di database. ".$e;
    exit();
}
?>