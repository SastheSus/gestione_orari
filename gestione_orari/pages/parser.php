<?php
$materie= $_REQUEST["materie"];
$prof= $_REQUEST["prof"];
$classi= $_REQUEST["classi"];
$ore= $_REQUEST["ore"];
    try{
      $i=0;
      $pdo = new PDO("mysql:host=localhost; dbname=gestione_orario", "root", "");
      $query= $pdo->prepare("DELETE FROM profhaora ");
      $query->execute();
      $query= $pdo->prepare("DELETE FROM profhamateria ");
      $query->execute();
      $query= $pdo->prepare("DELETE FROM profinsegnaclasse ");
      $query->execute();
      $query= $pdo->prepare("DELETE FROM supplenza");
      $query->execute();
      $query= $pdo->prepare("DELETE FROM assenza");
      $query->execute();
      $query= $pdo->prepare("DELETE FROM assenzaclasse");
      $query->execute();
      $query= $pdo->prepare("DELETE FROM prof ");
      $query->execute();
      $query= $pdo->prepare("DELETE FROM ora ");
      $query->execute();
      $query= $pdo->prepare("DELETE FROM classe ");
      $query->execute();
      $query= $pdo->prepare("DELETE FROM materia ");
      $query->execute();

      $professoriA = array();
      $materieA = array();
      $classiA = array();

      $materieFile = fopen($materie, "r") or die("Unable to open file!");//Parser Materie
      $i=0;
      while(!feof($materieFile)) {
        $riga= fgets($materieFile);
        $riga = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $riga);
        $riga = preg_replace('/\./', '', $riga);
        $dati= explode(",", $riga);// STAMPA DI TEST
        if($i>0){
          array_push($materieA,$dati[2]);
          $sql = "INSERT INTO materia (nome) VALUES (?)";
          $stmt= $pdo->prepare($sql);
          $stmt->execute([$dati[2]]);
        }
        $i++;
      }
      fclose($materieFile);

      $professoriFile = fopen($prof, "r") or die("Unable to open file!");//Parser Professore
      $i=0;
      while(!feof($professoriFile)) {
        $riga= fgets($professoriFile);
        $riga = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $riga);
        $dati= explode(",", $riga);
        $virgolette=explode("\"",$riga);

        if($i>0){
          array_push($professoriA,$dati[2]);
          $sql = "INSERT INTO prof (id, email, pass, ruolo, nome, cognome, oreSup) VALUES (?,?,?,?,?,?,?)";
          $stmt= $pdo->prepare($sql);
          $stmt->execute([$i, $dati[26], 'PASSWORD', false, $dati[2],$dati[3], 0]); //TAPPULLO USANDO LA I COME ID
          $box= explode(",", $virgolette[0]);
          $piuClassi=false;
          if(sizeof($box)==39){//TAPPULLO MEGA GALATTICO
            $piuClassi=true;
          }
          if(sizeof($virgolette)>2){ 
            if($piuClassi && sizeof($virgolette)==5){
              $materie=explode(",", $virgolette[3]);
              $materie = preg_replace('/\./', '', $materie);
              for($j=0;$j<sizeof($materie);$j++){
                $materie[$j] = trim($materie[$j]);
                $sql = "INSERT INTO profhamateria (idProf, idMateria) VALUES (?,?)";
                $stmt= $pdo->prepare($sql);
                $stmt->execute([$i,$materie[$j]]);
              }
            }
            else if(!$piuClassi){
              $materie=explode(",", $virgolette[1]);
              $materie = preg_replace('/\./', '', $materie);
              for($j=0;$j<sizeof($materie);$j++){
                $materie[$j] = trim($materie[$j]);
                $sql = "INSERT INTO profhamateria (idProf, idMateria) VALUES (?,?)";
                $stmt= $pdo->prepare($sql);
                $stmt->execute([$i,$materie[$j]]);
              }
            }
            
          }
          else{
            if(!empty($dati[40])){
              $bardotti= preg_replace('/\./', '', $dati[40]);
              $sql = "INSERT INTO profhamateria (idProf, idMateria) VALUES (?,?)";
              $stmt= $pdo->prepare($sql);
              $stmt->execute([$i,$bardotti]);
            }
            else{
            }
          }
        }else{
          array_push($professoriA,"NONE");
          $sql = "INSERT INTO prof (id) VALUES (?)";
          $stmt= $pdo->prepare($sql);
          $stmt->execute([0]);
        }
        $i++;  
      }
      fclose($professoriFile);
      for($i = 0;$i<sizeof($professoriA);$i++ ){
      }

      $classeFile = fopen($classi, "r") or die("Unable to open file!");//Parser Classe
      $i=0;
      while(!feof($classeFile)) {
        $riga= fgets($classeFile);
        $riga = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $riga);
        $dati= explode(",", $riga);
        if($i>0){
          array_push($classiA,$dati[1]);
          $sql = "INSERT INTO classe (nome) VALUES (?)";
          $stmt= $pdo->prepare($sql);
          $stmt->execute([$dati[1]]);
        }
        else{
          array_push($classiA,"NONE");
          $sql = "INSERT INTO classe (nome) VALUES (?)";
          $stmt= $pdo->prepare($sql);
          $stmt->execute(["NONE"]);
        }
        $i++;
      }
      fclose($classeFile);


      $oreFile = fopen($ore, "r") or die("Unable to open file!");//Parser Materie
      $i=0;
      $z=1;
      $controllo=false;
      while(!feof($oreFile)) {
        $riga= fgets($oreFile);
        $riga = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $riga);
        $riga = preg_replace('/\./', '', $riga);
        if($i>0){
          $dati= explode(",", $riga);// STAMPA DI TEST
          $virgolette=explode("\"",$riga);
          
          $controllo=false;
          $listanomi= array();

          if(sizeof($virgolette)>2 && !str_contains($virgolette[1],"<")){//Pezzone tattico
            $listanomi=explode(",",$virgolette[1]);
            $pino = explode(",", $virgolette[4]);
            $controllo=true;
            $class="";

            
            
          
            if(strlen($pino[1]) <= 1){
              $class="NONE";
            }
            else{
              $class=$pino[1];
            }
            $place=$pino[2];
            if(strlen($place)<=1){
              $place="SEDE";
            } else {
              $place=preg_replace('/[<->-"]/', '', $pino[2]);
            }
            $giorno="";
            $ora= "";
            for($aus=0;$aus<sizeof($dati);$aus++){
              if(strpos($dati[$aus],"edi")){
                $giorno=$dati[$aus];
                $ora=explode("h", $dati[$aus+1])[0];
                echo "|".$giorno."|";
              } else if(strpos($dati[$aus],"erdi")){
                $giorno=$dati[$aus];
                $ora=explode("h", $dati[$aus+1])[0];
                echo "|".$giorno."|";
              }
            }
            $durata=explode("h", $dati[1])[0];
            do{
              $sql = "INSERT INTO ora (id, luogo, durata, giorno, ora, idMateria, idClasse) VALUES (?,?,?,?,?,?,?)";
              $stmt= $pdo->prepare($sql); 
              $stmt->execute([$z, $place,1, dayWeek($giorno), $ora, $dati[4] , $class]);

              for($y=0;$y<sizeof($listanomi);$y++){
                $variabile= trim($listanomi[$y]);
                for($k=0;$k<sizeof($professoriA);$k++){
                  if($professoriA[$k]==$variabile){
                    $sql = "INSERT INTO profhaora (idProf, idOra) VALUES (?,?)";
                    $stmt= $pdo->prepare($sql); 
                    $stmt->execute([$k,$z]);
                    if($k!=0  && $class!="NONE"){
                      $sql = "INSERT IGNORE INTO profinsegnaclasse(idProf, idClasse) VALUES (?,?)";
                      $stmt= $pdo->prepare($sql); 
                      $stmt->execute([$k,$class]);
                    }
                  }
                }
              }
              $z++;
              $durata=$durata-1;
              $ora=$ora+1;
            }while($durata>0);
            
          }
          else{
            $listanomi=$dati[6];
            $class="";
            if(strlen($dati[7]) <= 1){
              $class="NONE";
            }
            else{
              $class=$dati[7];
            }

            $place=$dati[8];
            if(strlen($place)<=1){
              $place="SEDE";
            } else {
              $place=preg_replace('/[<->-"]/', '', $dati[8]);
            }
            $giorno="";
            $ora= "";
            for($aus=0;$aus<sizeof($dati);$aus++){
              if(strpos($dati[$aus],"edi")){
                $giorno=$dati[$aus];
                $ora=explode("h", $dati[$aus+1])[0];
                echo "|".$giorno."|";
              } else if(strpos($dati[$aus],"erdi")){
                $giorno=$dati[$aus];
                $ora=explode("h", $dati[$aus+1])[0];
                echo "|".$giorno."|";
              }
            }
            echo "finito";
            $durata=explode("h", $dati[1])[0];
            do{
              $sql = "INSERT INTO ora (id, luogo, durata, giorno, ora, idMateria, idClasse) VALUES (?,?,?,?,?,?,?)";
              $stmt= $pdo->prepare($sql); 
              $stmt->execute([$z, $place, 1, dayWeek($giorno), $ora, $dati[4] , $class]);

              
              $sql = "INSERT INTO profhaora (idProf, idOra) VALUES (?,?)";
              $stmt= $pdo->prepare($sql); 
              $stmt->execute([array_search($dati[5],$professoriA,false),$z]);
              
              
              if($dati[5]!=""  && $class!="NONE"){
                $sql = "INSERT IGNORE INTO profinsegnaclasse(idProf, idClasse) VALUES (?,?)";
                $stmt= $pdo->prepare($sql); 
                $stmt->execute([array_search($dati[5],$professoriA,false),$class]);
              }
              $z++;
              $durata=$durata-1;
              $ora=intval($ora)+1;
            }while($durata>0);
          }
        }
        $i++;
      }
      fclose($oreFile);

    }
    catch (PDOException $e){
        echo "Impossibile connettersi al server di database. ".$e;
        exit();
    }

    function dayWeek($day){
      switch ($day) {
        case "lunedi":
          return 1;
          break;
        case "martedi":
          return 2;
          break;
        case "mercoledi":
          return 3;
          break;
        case "giovedi":
          return 4;
          break;
        case "venerdi":
          return 5;
          break;
      }
    }

    $pdo=null;
    ?>