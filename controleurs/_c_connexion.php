<?php
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
    include 'pages/_connexion.php';
} else {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Test si l'utilisateur est existant
    // Utiliser email : lucas et mdp : lucas
    $api = new api;
    if(!$api->connexion($email,$password)) {
        ?><script>alert("Utilisateur inconnue")</script><?php
        include 'pages/_connexion.php';
    } else {
        $_SESSION['email'] = $email;
        $_SESSION['token'] = $api->token;
        $tokenuser = ($api->token);
        include 'controleurs/_c_accueil.php';
    }
}