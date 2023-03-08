<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Orario</title>
    <link rel="stylesheet" href="../style/stileGestione.css">
    <!-- MODIFICAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Open+Sans:wght@500&display=swap" rel="stylesheet">
    <script>
        function Apri(){
            document.getElementById("sidebar").style.display="block";
            document.getElementById("Apri").style.display="none";
            console.log("SCEMO CHI LEGGE");
            document.getElementById("contenitore").style.left="200px";
        }
        function chiudi(){
            document.getElementById("sidebar").style.display="none";
            document.getElementById("Apri").style.display=""; 
            document.getElementById("contenitore").style.left="0";           
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
        <a href="listaSezioni.php"><p>SEZIONI</p></a>
        <a class="active" href="gestione.php"><p>GESTIONE ORARIO</p></a>
        <a href="aggiungi.php"><p>AGGIUNGI FILE</p></a>
        <a href="accesso.php" id="logout"><p>LOG OUT</p></a>
        <button onclick="refresh()" id="butRefresh">REFRESH DB</button>
    </div>
    <div id="contenitore">
        <div id="classi" class="figlio">
            <h3>PROBLEMI</h3>
            <div id="btn">
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
                <button>BINI</button>
            </div>
            <button id="auto">ASSEGNA</button> <!--AGIUNTAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA-->
            <button id="salva">SALVA</button>
            
        </div>
        <div id="lista" class="figlio">
           <h3>PROFESSORI</h3>
            <li>List item 1</li>
            <li>List item 2</li>
            <li>List item 3</li>
            <li>List item 4</li>
            <li>List item 5</li>
            
        </div>
    </div>
    
</body>
</html>