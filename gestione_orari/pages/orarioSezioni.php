<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orario Sezioni</title>
    <link rel="stylesheet" href="../style/index.css">
    <!-- MODIFICAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Open+Sans:wght@500&display=swap" rel="stylesheet">
    <script src="../script/script.js"></script>
    <script>
        function Apri(){
            document.getElementById("sidebar").style.display="block";
            document.getElementById("Apri").style.display="none";
        }
        function chiudi(){
            document.getElementById("sidebar").style.display="none";
            document.getElementById("Apri").style.display="";            
        }
    </script>
</head>
<body>
<button onclick="Apri()" id="Apri"><img src="../images/hamMenu.png" alt=""></button>
    <header>
        <h1><b>I.I.S ITALO CALVINO</b></h1>
    </header>
    <div id="sidebar">
        <button onclick="chiudi()" id="butClose"><img src="../images/chiudi.png" alt=""></button>
        <a href="listaProf.php"><p>PROFESSORI</p></a>
        <a class="active" href="listaSezioni.php"><p>SEZIONI</p></a>
        <a href="gestione.php"><p>GESTIONE ORARIO</p></a>
        <a href="aggiungi.php"><p>AGGIUNGI FILE</p></a>
        <a href="accesso.php" id="logout"><p>LOG OUT</p></a>
        <button onclick="refresh()" id="butRefresh"><p>REFRESH DB</p></button>
    </div>

    <a href="listaSezioni.php" id="indietro"><object data="../images/tornaIndietro.svg" id="back"></object><p><b>Torna indietro</p></b></a>
    <div id="opzioni">
        <button id="stampa">Stampa PDF</button>
    </div>

    <div id="menuV">
        <div id="child2">
            <h2>ORARIO</h2>
            <div id="orarioProf">
                <h3 class="primo" id="int_ora">Ora</h3>
                <h3 class="giorno">Lunedì</h3>
                <h3 class="giorno">Martedì</h3>
                <h3 class="giorno">Mercoledì</h3>
                <h3 class="giorno">Giovedì</h3>
                <h3 class="giorno" id="g_ultimo">Venerdì</h3>
                <h3 class="rows-1 primo">8:00</h3>
                <h3 class="rows-2 primo" >9:00</h3>
                <h3 class="rows-3 primo">10:00</h3>
                <h3 class="rows-4 primo">11:00</h3>
                <h3 class="rows-5 primo">12:00</h3>
                <h3 class="rows-6 primo">13:00</h3>
                <h3 class="rows-7 primo">14:00</h3>
                <h3 class="rows-8 primo">15:00</h3>
                <h3 class="rows-9 primo">16:00</h3>
                <?php
                    $classe = $_POST["id"];
                    
                    try {
                        $pdo = new PDO("mysql:host=localhost; dbname=gestione_orario", "root", "");
                        $query = $pdo->prepare("SELECT * FROM ora WHERE idClasse=?");
                        $query->execute([$classe]);

                        
                        //$query2 = $pdo->prepare("SELECT * FROM assenza WHERE idProf=? AND assData=?");
                        //$query2->execute([$classe]);


                        $precedente=$query->fetch();
                        $durata=0;

                        while ($riga = $query->fetch()) {

                            $d="'".$precedente[3]."'";
                            $h="'".$precedente[4]."'";
                            $p="'".$classe."'";
                            $m="'salute'";
                            $idH="'".$precedente[0]."'";
                            $idDiv="";
                            $idDiv= "'".strval(getDay($precedente[3]))."-".strval(getHour($precedente[4]))."'";
                            $func='"assente('.$d.','.$h.','.$p.','.$m.','.$idH.','.$idDiv.')"';

                            
                            if($precedente[4]==$riga[4]-1 && $precedente[6]==$precedente[6]){
                                $durata=2;
                                //$riga=$query->fetch();
                            }
                            else{
                                $durata=$precedente[2];
                            }
                            if($precedente[4]!=0){
                                echo "<div id='".getDay($precedente[3])."-".getHour($precedente[4])."' class='ora' style='grid-row-start:".getHour($precedente[4]).";  grid-column-start:".getDay($precedente[3])."'>".$precedente[5]."</div>";
                            }
                            $precedente=$riga;
                        }
                        echo "<div id='".getDay($precedente[3])."-".getHour($precedente[4])."' class='ora' style='grid-row-start:".getHour($precedente[4]).";  grid-column-start:".getDay($precedente[3])."'>".$precedente[5]."</div>";
                        $pdo = null; // chiudo la connessione
                    } catch (PDOException $e){
                        echo "Impossibile connettersi al server di database. ".$e;
                        exit();
                    }
                    
                    function getHour($hour){
                        switch ($hour){
                            case 8:
                                return 2;
                                break;
                            case 9:
                                return 3;
                                break;
                            case 10:
                                return 4;
                                break;
                            case 11:
                                return 5;
                                break;
                            case 12:
                                return 6;
                                break;
                            case 13:
                                return 7;
                                break;
                            case 14:
                                return 8;
                                break;
                            case 15:
                                return 9;
                                break;
                            case 16:
                                return 10;
                                break;
                        }
                    }

                    function getDay($day){
                        switch ($day){
                            case "lunedi":
                                return 2;
                                break;
                            case "martedi":
                                return 3;
                                break;
                            case "mercoledi":
                                return 4;
                                break;
                            case "giovedi":
                                return 5;
                                break;
                            case "venerdi":
                                return 6;
                                break;
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>