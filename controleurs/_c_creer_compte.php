<?php 

if(empty($_POST)) {
    include 'pages/_creer_compte.php';
} else {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $mdp = $_POST['password'];
    
    $api = new Api();
    if($api->createUser($name, $mdp, $email)) {
        ?><script>alert("Le compte est bien créé");</script><?php
        include 'pages/_connexion.php';
    } 
}
