<?php 

if($_SESSION <> null) {

    $api = new Api();
    $api->setToken($_SESSION['token']);
    $prod = $api->getCurrentUserCart();
    var_dump($prod);
    if(empty($prod)) {
        ?><script>alert("Panier vide veuillez ajouté des produits")</script><?php
        include 'index.php?uc=accueil';
    } else {
        if($api->createBill($prod)) {
            ?><script>alert("Commande bien envoyé !")</script><?php
            include 'pages/_facture.php';
        }
    }

} else {
    ?><script>alert("Non connecté")</script><?php
    include 'index.php';
}


