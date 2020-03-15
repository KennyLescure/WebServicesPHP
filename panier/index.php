<html>
 <head>
 <?php  
    require_once '../api/_webService.php'; 
    ?>
    <title>Boutique</title>
    <link rel="stylesheet" href="../boutique.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <script
            src="http://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".table").DataTable({
 
            });
        });
    </script>
 </head>
 <body>
 <?php
    //recup panier
    $api = new api;

    if(isset($_GET["tokenuser"]))
    {
        $tokenuser = $_GET["tokenuser"];
    }

    $api->setToken($tokenuser);
    $prod = $api->getCurrentUserCart();
 ?>
   <!-- <div id="entete">
        <a href="../boutique/index.php"><input type="button" value="Acceder à la boutique"/></a>
    </div> -->
    <center><h3>Les articles de votre panier s'affichent ici :</h3></center>
    <table id="tablevelos" border="1" class="table">
        <thead>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix Unitaire </th>
            <th>Quantite</th>
            <th>Prix total</th>
        </thead>
        <tbody>
<?php
for($i=0;$i<count($prod['orders']);$i++){
    if ($i%2 == 1)
    {
        echo "<tr class=\"pair\">";
    }else{
        echo "<tr class=\"impair\">";
    }
    $idprod = $prod['orders'][$i]['product_id'];
    $infoprod = $api->getProductById($idprod);
    if (isset($sommetotaleprod))
    {
        $prixtt = $sommetotaleprod + $prod['orders'][$i]['quantity'] * $infoprod['product']['price'];   
    }
    $sommetotaleprod = $prod['orders'][$i]['quantity'] * $infoprod['product']['price'];
     echo "<td>".$infoprod['product']['name']."</td>"; 
    echo "<td>".$infoprod['product']['description']."</td>"; 
    echo "<td>".$infoprod['product']['price']."</td>"; 
    echo "<td>".$prod['orders'][$i]['quantity']."</td>"; 
    echo "<td>".$sommetotaleprod."</td></tr>"; 
}
?>

        </tbody>
    </table>
<?php
    echo"<center><b><p>Prix total du panier : ".$prixtt." €</p></b></center>";
?>
 </body>
</html>