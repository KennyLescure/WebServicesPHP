<div class="container">
    <div>
        <h1>Facture</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <!-- <table class="table">
                    <tr>
                        <td>Nom :</td>
                        <td><input class="form-control" name="nom" type="text" /></td>
                    <tr>
                    <tr>
                        <td>Prénom :</td>
                        <td><input class="form-control" name="prenom" type="text" /></td>
                    <tr>
                    <tr>
                        <td>Adresse :</td>
                        <td><input class="form-control" name="adresse" type="text" /></td>
                    <tr>
                    <tr>
                        <td>Email :</td>
                        <td><input class="form-control" name="email" type="email" /></td>
                    <tr>
                </table> -->
            </div>
            <div class="col-6">
                <div class="row">
                    <span class="col">Date :</span>
                    <span class="col"><?php echo (date("d-m-Y")); ?></span>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="container">
        <table class="table table-striped">
            <thead class="thead-dark">
                <th>Nom</th>
                <th>Description</th>
                <th>Prix Unitaire </th>
                <th>Quantite</th>
                <th>Prix total</th>
            </thead>
            <?php
            for($i=0;$i<count($prod['orders']);$i++){
                echo "<tr>";
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
                echo "<td>".$sommetotaleprod."</td>"; 
                echo "</tr>";
            }
            echo (
                "<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><h4>Total :</h4></td>
                    <td><h4>".$prixtt."</h4></td>
                </tr>"
            );
            ?>
        </table>
    </div>
    <div class="row">
        <div class="col-8"></div>
        <div class="col-4">
            <a href="index.php?uc=accueil"><button class="btn btn-danger">Fermer</button></a>
        </div>
    </div>
</div>
