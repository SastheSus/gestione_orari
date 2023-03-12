<?php
    $email= $_REQUEST["email"];
    $password= $_REQUEST["password"];
    $hint="";
    try{
        $pdo = new PDO("mysql:host=localhost; dbname=gestione_orario", "root", "");
        $query = $pdo->prepare("SELECT * FROM prof WHERE email=?");
        $query -> execute([$email]);
        
        while($row = $query->fetch()){
            if($row[2]==$password){
                $hint= "Success";
                $_SESSION["id"]=$email;
                $_SESSION["nome"]=$row[0];
            }
            else{
                $hint= "NP";
            }
        }
        
        if($hint==""){
            $hint= "NE";
        }
    }
    catch(PDOException $e){
        echo $e;
    }

    echo $hint === "" ? "no suggestion" : $hint;

?>