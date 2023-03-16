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
        }
        function chiudi(){
            document.getElementById("sidebar").style.display="none";         
        }
    </script>
    <script src="../script/login.js"></script>
    <script src="../script/script.js"></script>
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
        <a href="gestione.php"><p>GESTIONE ORARIO</p></a>
        <a class="active" href="aggiungi.php"><p>AGGIUNGI FILE</p></a>
        <a href="accesso.php" onclick="logOut()" id="logout"><p>LOG OUT</p></a>
        <button onclick="refresh()" id="butRefresh">REFRESH DB</button>
    </div>
    <div id="menu">
            <div id="child1">
                <form action="aggiungi.php?i=1" method="post" enctype="multipart/form-data">
                    <label><b>Elenco professori:</b></label>
                    <input type="file" name="file" id="file1">
                    <input type="submit" value="Carica"  class="caricaFile">
                </form>
            </div>
            <div id="child2">
                <form action="aggiungi.php?i=2" method="post" enctype="multipart/form-data">
                    <label><b>Elenco sezioni:</b></label>
                    <input type="file" name="file" id="file2">
                    <input type="submit" value="Carica" class="caricaFile">
                </form>
            </div>
            <div id="child3">
                <form action="aggiungi.php?i=3" method="post" enctype="multipart/form-data">
                    <label><b>Ore:</b></label>
                    <input type="file" name="file" id="file3">
                    <input type="submit" value="Carica"  class="caricaFile">
                </form>
            </div>
            <div id="child4">
                <form action="aggiungi.php?i=4" method="post" enctype="multipart/form-data">
                    <label><b>Materie:</b></label>
                    <input type="file" name="file" id="file4">
                    <input type="submit" value="Carica"  class="caricaFile">
                </form>
            </div>
            <?php
            if($_REQUEST!=null){
                $target_dir = "../file/";
                $target_file="";
                if($_REQUEST['i']==1){
                    $target_file = $target_dir . basename("EXP_PROFESSEUR.txt");
                }else if($_REQUEST['i']==2){
                    $target_file = $target_dir . basename("EXP_CLASSE.txt");
                }else if($_REQUEST['i']==3){
                    $target_file = $target_dir . basename("EXP_COURS.txt");
                }else if($_REQUEST['i']==4){
                    $target_file = $target_dir . basename("EXP_MATIERE.txt");
                }
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


                if($imageFileType != "txt") {
                    echo "Sono ammessi solo file .txt. ";
                    $uploadOk = 0;
                }

                if ($uploadOk == 0) {
                    echo "Il file non è stato caricato. ";
                } else {
                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                        echo "Il file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " è stato caricato.";
                        echo '<script type="text/javascript">refreshLoad();</script>';
                        header("index.php");
                    } else {
                        echo "C'è stato un errore caricando il tuo file.";
                    }
                }
            }

            ?>
    </div>
    <div id=loadingArea>
        <img id="gif" src="../images/loading.gif" alt="">
        <p>Loading DB</p>
    </div>
</body>
</html>