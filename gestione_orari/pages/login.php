<?php
    $email= $_REQUEST["email"];
    $password= $_REQUEST["password"];
    $hint="";
    try{
        $pdo = new PDO("mysql:host=localhost; dbname=blogdb", "root", "");
        $query = $pdo->prepare("SELECT * FROM utente WHERE email=?");
        $query -> execute([$email]);
        
        while($row = $query->fetch()){
            if($row[1]==$password){
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