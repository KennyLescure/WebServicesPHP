 <?php
    $api = new api;
    $api->setToken($_SESSION['token']);
    $api->createUserCart($_SESSION['product']);
    //recup panier
    $prod = $api->getCurrentUserCart();
    $prixtt = 0;
 ?>
    <div class="container">
        <a class="btn btn-primary" href="index.php?uc=accueil">Boutique</a>
    </div>
    <div class="alert alert-primary container text-center" role="alert">
        <h1>Panier :</h1>
    </div>
    <div class="container">
        <table id="tablevelos" class="table table-striped">
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
                $sommetotaleprod = $prod['orders'][$i]['quantity'] * $infoprod['product']['price'];
                $prixtt += $sommetotaleprod;
                echo "<td>".$infoprod['product']['name']."</td>"; 
                echo "<td>".$infoprod['product']['description']."</td>"; 
                echo "<td>".$infoprod['product']['price']."</td>"; 
                echo "<td>".$prod['orders'][$i]['quantity']."</td>"; 
                echo "<td>".$sommetotaleprod."</td></tr>"; 
            }
            ?>
            </tbody>
        </table>
    </div>
<?php
    echo"<center><b><p>Prix total du panier : ".$prixtt." €</p></b></center>";
?>
<center><a href="index.php?uc=facture"><button type="button" class="btn btn-primary">Valider la commande</button></a></center>
