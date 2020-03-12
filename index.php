<?php
    
    session_start(); // début de session
    include("pages/_header.php");

    $email;
    $password;
    
    
    if(empty($_POST)) {
        include("pages/_connexion.php");
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
    }

?>