<?php 

if($_SESSION <> null) {

    $api = new Api();
    $api->setToken($_SESSION['token']);
    $prod = $api->getCurrentUserCart();
    if(!isset($prod)) {
        ?><script>alert("Panier vide veuillez ajouter des produits")</script><?php
        include 'controleurs/_c_accueil.php';
    } else {
        if($api->createBill($prod)) {
            $_SESSION['product'] = [];
            ?><script>alert("Commande bien envoyé !")</script><?php
            include 'pages/_facture.php';
        }
    }

} else {
    ?><script>alert("Non connecté")</script><?php
    include 'index.php';
}


