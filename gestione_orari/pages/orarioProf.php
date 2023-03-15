<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orario Docente</title>
    <link rel="stylesheet" href="../style/index.css">
    <!-- MODIFICAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Open+Sans:wght@500&display=swap" rel="stylesheet">
    <script src="../script/script.js"></script>
    <script src="../script/login.js"></script>
    <script>
        function Apri(){
            document.getElementById("sidebar").style.display="block";
        }
        function chiudi(){
            document.getElementById("sidebar").style.display="none";       
        }
    </script>
</head>
<body onload="controlloAss(<?php echo $_POST['id']; ?>)">
    <header>
        <button id="Apri"><img src="../images/hamMenu.png" onclick="Apri()" alt=""></button>
        <h1><b>I.I.S. ITALO CALVINO</b></h1>
        <?php
            session_start();
            if(isset($_SESSION['nome'])){
                echo "<h3 id='nomeText'>".$_SESSION['cognome']." ".$_SESSION['nome']."</h3>";
            }
        ?>
    </header>
    <div id="sidebar">
        <button onclick="chiudi()" id="butClose"><img src="../images/chiudi.png" alt=""></button>
        <a class="active" href="listaProf.php"><p>PROFESSORI</p></a>
        <a href="listaSezioni.php"><p>SEZIONI</p></a>
        <a href="gestione.php"><p>GESTIONE ORARIO</p></a>
        <a href="aggiungi.php"><p>AGGIUNGI FILE</p></a>
        <a href="accesso.php" onclick="logOut()" id="logout"><p>LOG OUT</p></a>
        <button onclick="refresh()" id="butRefresh"><p>REFRESH DB</p></button>
    </div>
    
    <a href="listaProf.php" id="indietro"><object data="../images/tornaIndietro.svg" id="back"></object><p><b>Torna indietro</p></b></a>
    <div id="opzioni">
        <button id="stampa">Stampa PDF</button>
        <div id="sett">
            <object data="../images/tornaIndietro.svg" id="sPrima"></object>
            <input type="week" name="" id="a" onchange="controlloAss(<?php echo $prof?>)"value="<?php echo date('Y').'-W'.date('W');?>"></input>
            <object data="../images/avanti.svg" id="sDopo"></object>
        </div>
    </div>
    <div id="menuV">
        <div id="child2">
            <?php
                $prof = $_POST["id"];
                $pdo = new PDO("mysql:host=localhost; dbname=gestione_orario", "root", "");
                $query = $pdo->prepare("SELECT nome, cognome FROM prof WHERE id=?");
                $query->execute([$prof]);
                $riga=$query->fetch();
                echo "<h2>".$riga[0]."&nbsp 	&nbsp".$riga[1]."</h2>";
                $pdo = null;
            ?>
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
                    
                    
                    try {
                        $pdo = new PDO("mysql:host=localhost; dbname=gestione_orario", "root", "");
                        $query = $pdo->prepare("SELECT * FROM ora, profhaora WHERE idProf=? AND idOra=id");
                        $query->execute([$prof]);

                        $durata=0;

                        while ($riga = $query->fetch()) {

                            $d="'".$riga[3]."'";
                            $h="'".$riga[4]."'";
                            $p="'".$prof."'";
                            $m="'salute'";
                            $idH="'".$riga[0]."'";
                            $idDiv="";
                            $idDiv= "'".strval($riga[0])."'";
                            $func='"assente('.$d.','.$h.','.$p.','.$m.','.$idH.','.$idDiv.')"';
                            if($riga[4]!=0){
                                echo "<div id='".$riga[0]."' class='ora' style='grid-row-start:".getHour($riga[4]).";  grid-column-start:".getDay($riga[3])."' onclick=".$func.">".$riga[6]."<br>(".$riga[5].")</div>";
                            }
                            $riga=$riga;
                        }
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