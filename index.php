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
        case 'panier' : include 'panier/index.php'; break;
        case 'ficheProduit' : include 'pages/_fiche_produit.php';  break;
        case 'facture' : include 'controleurs/_c_facture.php'; break;
        case 'creerCompte' : include 'controleurs/_c_creer_compte.php'; break;
    }
?>