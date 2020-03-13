<?php
    require_once 'api/_webService.php';
    session_start(); // début de session
    include("pages/_header.php");

    // Connexion
    $email;
    $password;
    
    // Fiche produit
    $id = 0;
    $titre = '';
    $description = '';
    $prix = 0;
    $imageProduit;
    
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
        } else {
            // Fiche produit
            $produit = $api->getProductById(4);
            $description = $produit['product']['description'];
            $titre = $produit['product']['name'];
            $prix = $produit['product']['price'];
            
            $imageProduit = $api->getImageOfProduct(4);
            var_dump($imageProduit);
            
            include("pages/_fiche_produit.php");
        }

        

        // include la page boutique //////////// POUR KENNY

        

        // Pour kenny
        // $test = $api->getAllProduit();
        // var_dump($test);
    }

?>