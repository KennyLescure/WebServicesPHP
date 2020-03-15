<?php 

if(empty($_SESSION['email'])) {
    include 'controleurs/_c_connexion.php';
} else {
    include __DIR__ .'/../pages/_menu.php';

}

