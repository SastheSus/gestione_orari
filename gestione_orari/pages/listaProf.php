<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Docenti</title>
    <link rel="stylesheet" href="../style/index.css">
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
        <a class="active" href="listaProf.php"><p>PROFESSORI</p></a>
        <a href="listaSezioni.php"><p>SEZIONI</p></a>
        <a href="gestione.php"><p>GESTIONE ORARIO</p></a>
        <a href="aggiungi.php"><p>AGGIUNGI FILE</p></a>
        <a href="accesso.php" id="logout"><p>LOG OUT</p></a>
        <button onclick="refresh()" id="butRefresh"><p>REFRESH DB</p></button>
    </div>
    <div id="menu">
        <div id="child1">
            <h2>PROFESSORI</h2>
            <div id="centro">
            <div id="barraRicerca">
                <img id="lente" src="../images/lente.svg">
                <input type="text" placeholder="Cerca Professore" id="ricerca">
                <button id="invia">Invia</button>
            </div>
            <form id="listaProf" method="post" action="orarioProf.php" >
                <!-- PHP --->
                <?php

                try{
                    $pdo = new PDO("mysql:host=localhost; dbname=gestione_orario", "root", "");
                    $query = $pdo->prepare("SELECT id, nome, cognome FROM prof");
                    $query->execute();

                    $i=0;
                    while($riga = $query->fetch()){
                        if($i!=0){
                            $n="'".$riga[1]." ".$riga[2]."'";
                            echo "<button id=".$riga[0]." type='submit'  name='id' data-value=".$n."value=".$riga[0]." class='prof'>".$riga[1]."  ".$riga[2]."</button>";
                        }
                        $i++;
                    }

                    $pdo=null;
                }
                catch (PDOException $e){
                    echo "Impossibile connettersi al server di database. ".$e;
                    exit();
                }
                ?> 
            </form>
            </div>
        </div>
    </div>
</body>
</html>