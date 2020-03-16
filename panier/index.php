 <?php
    //recup panier
    $api = new api;
    $api->setToken($_SESSION['token']);
    $prod = $api->getCurrentUserCart();
    $prixtt = 0;
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
<center><a href="index.php?uc=facture"><button type="button" class="btn btn-primary">Valider la commande</button></a></center>
