<?php
    session_start();
    $email= $_REQUEST["email"];
    $password= $_REQUEST["password"];
    $newPassword= $_REQUEST["newPassword"];
    $confPassword= $_REQUEST["confPassword"];
    $hint="";
    try{
        $pdo = new PDO("mysql:host=localhost; dbname=gestione_orario", "root", "");
        $query = $pdo->prepare("SELECT * FROM prof WHERE email=?");
        $query -> execute([$email]);
        
        while($row = $query->fetch()){
            if($row[2]=="PASSWORD"){
                if(newPassword==null){
                    $hint= "OP";
                }
                else{
                    
                }
                
            }
            else if($row[2]==$password){
                $_SESSION["id"]=$row[0];
                $_SESSION["nome"]=$row[5];
                $_SESSION["cognome"]=$row[4];
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