<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Sezioni</title>
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
        <a class="active" href="listaSezioni.php"><p>SEZIONI</b></p></a>
        <a href="gestione.php"><p>GESTIONE ORARIO</p></a>
        <a href="aggiungi.php"><p>AGGIUNGI FILE</p></a>
        <a href="accesso.php" onclick="logOut()" id="logout"><p>LOG OUT</p></a>
        <button onclick="refresh()" id="butRefresh"><p>REFRESH DB</p></button>
    </div>
    <div id="menu">
        <div id="child1">
            <h2>SEZIONI</h2>
            <div id="centro">
            <div id="barraRicerca">
                <img id="lente" src="../images/lente.svg">
                <input type="text" placeholder="Cerca Professore" id="ricerca">
                <button id="invia">Invia</button>
            </div>
            <form id="listaProf" method="post" action="orarioSezioni.php" >
                <?php
                     try{
                        $pdo = new PDO("mysql:host=localhost; dbname=gestione_orario", "root", "");
                        $query = $pdo->prepare("SELECT * FROM classe");
                        $query->execute();
    
                        $i=0;
                        while($riga = $query->fetch()){
                            if($i!=0){
                                $n="'".$riga[0]."'";
                                if($riga[0]!="NONE"){
                                    echo "<button id=".$riga[0]." type='submit'  name='id' value=".$riga[0]." class='prof'>".$riga[0]."</button>";
                                }
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