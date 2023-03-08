<?php 
$d= $_REQUEST["d"];     //giorno
$h= $_REQUEST["h"];     //ora
$id= $_REQUEST["id"];   //idProf
$m= $_REQUEST["m"];     //motivo
$idH= $_REQUEST["idH"]; //idOra
$week= $_REQUEST["week"]; //settimana
$hint='';
$idAss=0;
try{
$pdo = new PDO("mysql:host=localhost; dbname=gestione_orario", "root", "");

$query = $pdo->prepare("SELECT COUNT(*) FROM assenza");
$query->execute();
$idAss = $query->fetch();
echo "/".$idAss[0]."/";

$query = $pdo->prepare("INSERT INTO assenza (id,motivo,idProf,idOra,assData) VALUES (?,?,?,?,?)");
$query -> execute([$idAss[0],$m,$id,$idH,$week]);

//echo "/".$d."/".strlen($d)."/".$h."/".strlen($h)."/\n";
$text = "SELECT profhaora.idProf, prof.oreSup
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

while ($row = $query->fetch()) {
    $hint.=$row['idProf']." ora: ".$h;
}
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
