<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Orario</title>
    <link rel="stylesheet" href="../style/stileGestione.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Open+Sans:wght@500&display=swap" rel="stylesheet">
    <script src="../script/script.js"></script>
    <script src="../script/login.js"></script>
    <script>
        function Apri(){
            document.getElementById("sidebar").style.display="block";
            document.getElementById("contenitore").style.left="200px";
        }
        function chiudi(){
            document.getElementById("sidebar").style.display="none";
            document.getElementById("contenitore").style.left="0";           
        }
    </script>
</head>
<body>
    <header>
        <button id="Apri"><img src="../images/hamMenu.png" alt="" onclick="Apri()"></button>
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
        <a href="listaProf.php"><p>PROFESSORI</p></a>
        <a href="listaSezioni.php"><p>SEZIONI</p></a>
        <a class="active" href="gestione.php"><p>GESTIONE ORARIO</p></a>
        <a href="aggiungi.php"><p>AGGIUNGI FILE</p></a>
        <a href="accesso.php" onclick="logOut()" id="logout"><p>LOG OUT</p></a>
        <button onclick="refresh()" id="butRefresh">REFRESH DB</button>
    </div>
    <div id="contenitore">
        <div id="classi" class="figlio">
            <h3>PROBLEMI</h3>
            <div id="btn">
                <?php 
                    $classe = "";
                    $pdo = new PDO("mysql:host=localhost; dbname=gestione_orario", "root", "");
                    //trova assenza
                    $text = "SELECT assenza.id, assenza.idProf, giorno, ora, nome, cognome
                             FROM assenza, ora, prof
                             WHERE idOra=ora.id
                             AND assenza.idProf = prof.id
                             AND giorno >= ?
                             AND anno >= ?
                             AND settimana >= ?";
                    
                    $query= $pdo->prepare($text);
                    $query->execute([intval(date('N')),intval(date('Y')),intval(date('W'))]);

                    while($row=$query->fetch()){
                        $t = 'onclick="pathfinder('.$row[0].')"';
                        $classe = classe($row[0],$pdo);
                        $giorno="";
                        switch($row['giorno']){
                            case 1:
                                $giorno="lunedì";
                                break;
                            case 2:
                                $giorno="martedì";
                                break;
                            case 3:
                                $giorno="mercoledì";
                                break;
                            case 4:
                                $giorno="giovedì";
                                break;
                            case 5:
                                $giorno="venerdì";
                                break;
                        }
                        echo "<button class='cardProf' ".$classe."".$t.">".$row['nome']." ".$row['cognome']."<br>(".$giorno." ".$row['ora'].")</button>";
                    }

                    function classe($idAssenza,$pdo){
                        $stile = "id='profBtn'";
                        $text = "SELECT supplenza.id, supplenza.idProf, idAssenza
                             FROM assenza, supplenza
                             WHERE idAssenza = ?
                             AND assenza.id = idAssenza";

                        $query2= $pdo->prepare($text);
                        $query2->execute([$idAssenza]);

                        if($row=$query2->fetch()){
                            $stile = "id='ok'";
                        }
                        return $stile;
                    }
                    

                ?>
            </div>
            
        </div>
        <div id="lista" class="figlio">
            <h3>PROFESSORI</h3>
            <ul id="listaContainer"></ul>
        </div>
    </div>
    <div id=loadingArea>
        <img id="gif" src="../images/loading.gif" alt="">
        <p>Loading DB</p>
    </div>
</body>
</html>