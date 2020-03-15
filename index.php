<?php
    require_once 'api/_webService.php';
    session_start(); // début de session
    include("pages/_header.php");

    if(isset($_REQUEST['uc'])) {
        $uc = $_REQUEST['uc'];
    } else {
        $uc = 'connexion';
    }

    switch($uc) {
        case 'connexion' : include 'controleurs/_c_connexion.php'; break;
        case 'accueil' : include 'controleurs/_c_accueil.php'; break;
        case 'panier' : include 'controleurs/_c_panier.php';break;
    }

            // // Récup toutes les catégories
            // $category = $api->getAllCategories();

            // // Récup le panier de l'utilisateur courant 
            // $userCart = $api->getCurrentUserCart();
            
            // // Ajout d'un panier
            // $cart = array(["product_id" => 3,"quantity" => 10],["product_id" => 4,"quantity" => 10]);
            // $response = $api->createUserCart($cart);
            // if(!$response) {
            //     Erreur lors de l'ajout du panier
            // }

            // // Fiche produit
            // $produit = $api->getProductById(4);
            // $description = $produit['product']['description'];
            // $titre = $produit['product']['name'];
            // $prix = $produit['product']['price'];
            
            // $imageProduit = $api->getImageOfProduct(4);
            // var_dump($imageProduit);
            
            // include("pages/_fiche_produit.php");

?>