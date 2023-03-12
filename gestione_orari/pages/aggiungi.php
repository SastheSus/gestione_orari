<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GESTIONE</title>
    <link rel="stylesheet" href="../style/stileAggiungi.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Open+Sans:wght@500&display=swap" rel="stylesheet">
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
    <script src="../script/login.js"></script>
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
        <a href="gestione.php"><p>GESTIONE ORARIO</p></a>
        <a class="active" href="aggiungi.php"><p>AGGIUNGI FILE</p></a>
        <a href="accesso.php" onclick="logOut()" id="logout"><p>LOG OUT</p></a>
        <button onclick="refresh()" id="butRefresh">REFRESH DB</button>
    </div>
    <div id="menu">
            <div id="child1">
                <form>
                    <label><b>Elenco professori:</b></label>
                    <input type="file" name="file1" id="file1">
                    <input type="submit" value="Carica"  class="caricaFile">
                </form>
            </div>
            <div id="child2">
                <form>
                    <label><b>Elenco sezioni:</b></label>
                    <input type="file" name="file2" id="file2">
                    <input type="submit" value="Carica" class="caricaFile">
                </form>
            </div>
            <div id="child3">
                <form>
                    <label><b>Orario professori:</b></label>
                    <input type="file" name="file3" id="file3">
                    <input type="submit" value="Carica"  class="caricaFile">
                </form>
            </div>
            <div id="child4">
                <form>
                    <label><b>Orario sezioni:</b></label>
                    <input type="file" name="file4" id="file4">
                    <input type="submit" value="Carica"  class="caricaFile">
                </form>
            </div>
    </div>
</body>
</html>