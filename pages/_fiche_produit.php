<?php
    $idProduit = $_GET['id'];
    if(empty($idProduit)) {
        include 'boutique/index.php';
        die();
    } else {
        $api = new Api();
        $produit = $api->getProductById($idProduit);
        if($produit == null) {
            ?><script>alert("Produit inconnu")</script><?php
            include 'boutique/index.php';
        } else {
            $description = $produit['product']['description'];
            $titre = $produit['product']['name'];
            $prix = $produit['product']['price'];
            $imageProduit = $api->getImageOfProduct(4);
            
            echo('
                <style>
                    .img-product { 
                        width : 500px;
                    }
                </style>
                <div class="col-sm-4">
                    <a href="index.php?uc=accueil"><button type="button" class="btn btn-info">Boutique</button></a>
                </div>
                <div>
                    <div class="container">
                        <h1>Fiche produit</h1>
                    </div>    
                    <div class="container">
                        <table class="table table-striped">
                            <tr>
                                <td>
                                    <img class="img-rounded img-product" src="data:image/;base64,'.$imageProduit.'"></img><br/>
                                </td>
                            </tr>
                            <tr>
                                <td><h3>'.$titre.'></h3></td>
                                <tr>
                                    <td><label>Prix : </label></td>
                                    <td><label>'.$prix.'€</label></td>
                                </tr>
                                <tr>
                                    <td><label>Description :</label></td>
                                    <td><p>'.$description.'</p></td>
                                </tr>
                            </tr>
                        </table>
                    </div>
                </div>'
            );
        }
    }
?>

