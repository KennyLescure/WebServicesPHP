<?php 

if(empty($_SESSION['email'])) {
    include 'controleurs/_c_connexion.php';
} else {
    include __DIR__ .'/../pages/_menu.php';
    
    // Recup les produits
    $prod = $api->getAllProduit();
    var_dump($api);
    include 'pages/_listerProduit.php';
}

