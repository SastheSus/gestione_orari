<?php 
$id= $_REQUEST["idAssenza"];   //idAssenza
$hint='';
$idAss=0;
try{
$pdo = new PDO("mysql:host=localhost; dbname=gestione_orario", "root", "");

$text = "SELECT idProf, giorno, ora
         FROM assenza, ora
         WHERE id = ?
         AND idOra=ora.id";

$query= $pdo->prepare($text);
$query->execute([$id]);
$row = $query->fetchAll();

$text = "SELECT profhaora.idProf, prof.nome, prof.cognome, prof.oreSup
         FROM ora, prof, profhaora
         WHERE idProf != ?
         AND idProf=prof.id
         AND idOra=ora.id
         AND ora.idMateria LIKE ?
         AND giorno = ?
         AND ora = ?
         ORDER BY oreSup ASC";

$query= $pdo->prepare($text);
$query->execute([$row[0]['idProf'],'DISPOSIZIONE',$row[0]['giorno'],$row[0]['ora']]);
$row = $query->fetchAll();

}
catch (PDOException $e){
    echo "Impossibile connettersi al server di database. ".$e;
    exit();
}
//se più di un prof a disposizione
//cercare l'idProf del select in profhaclasse
//cercare l'idProf del select in profhamateria

?>
