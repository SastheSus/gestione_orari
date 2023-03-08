<?php 
$id= $_REQUEST["idAssenza"];   //idAssenza
$hint='';
$idAss=0;
try{
$pdo = new PDO("mysql:host=localhost; dbname=gestione_orario", "root", "");

$text = "SELECT idProf
         FROM assenza
         WHERE id = ?
         ORDER BY oreSup ASC";

$query= $pdo->prepare($text);
$query->execute([$id,'DISPOSIZIONE',$d,$h]);

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
$query->execute([$id,'DISPOSIZIONE',$d,$h]);
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
