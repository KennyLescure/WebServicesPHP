<?php
    require_once 'api/_webService.php';
    session_start(); // début de session
    include("pages/_header.php");

    $email;
    $password;
    
    if(empty($_POST)) {
        include("pages/_connexion.php");
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Test si l'utilisateur est existant
        // Utiliser email : lucas et mdp : lucas
        $api = new api;
        if(!$api->connexion($email,$password)) {
            ?><script>alert("Utilisateur inconnue")</script><?php
            include("pages/_connexion.php");
        }

        var_dump($api->getProductById(3));
        include("pages/_fiche_produit.php");

        // include la page boutique //////////// POUR KENNY

        

        // Pour kenny
        $test = $api->getAllProduit();
        var_dump($test);
    }

?>