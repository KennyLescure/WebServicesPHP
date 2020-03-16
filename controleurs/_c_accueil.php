<?php 
if(empty($_SESSION['email'])) {
    include 'controleurs/_c_connexion.php';
} else {
    //include DIR .'/../pages/_menu.php';
    if (isset($_SESSION['product'])){
        $array = $_SESSION['product'];
    } else {
        $array = array();
    }
    if(!empty($_GET['id'])) {
        array_push($array,['product_id' => $_GET['id'], 'quantity' => 1]);
        $_SESSION['product'] = $array;
    }
    include 'boutique/index.php';
}
