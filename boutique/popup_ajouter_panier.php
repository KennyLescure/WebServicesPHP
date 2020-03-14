<html>
 <head>
 <?php  
    require_once '../api/_webService.php'; 
    ?>
  <title>Boutique</title>
  <link href="../boutique.css" rel="stylesheet">
 </head>
 <body>
 <?php
$curl = curl_init("http://webservice-rest-velo-back.herokuapp.com/cart/user");
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$json_response = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$response = json_decode($json_response, true);
 var_dump($response);   
 if(isset($_GET["id"]))
    {
        $id=$_GET["id"];
        //recup info produit par id
        $api = new api;
        $prod = $api->getProductById($id);
        var_dump ($prod);

        if(isset($_POST["quantite"]))
        {
            $quantite=$_POST["quantite"]; // qtt voulu par l'user

            for ($i = 0; $i<$nbproduit ; $i++) {
                if ($obj[$i]->id == $id)
                {
                    $description=$obj[$i]->description;
                    $name=$obj[$i]->name;
                    $price=$obj[$i]->price;
                }
            }
            
            echo("quantite :".$quantite);
            
            echo("description :".$description);
            
            echo("name :".$name);
            
            echo("price :".$price);
            
?>
        <script type="text/javascript">
            window.opener.location.reload();
            window.close();
        </script>
<?php
        }
    }

    echo "<center><p>Ajouter l'article au panier</p></center>";
    echo "<form method=\"post\" action=\"popup_ajouter_panier.php?id=".$id."\">";
?>
        <table width="150" border="1" cellspacing="0" cellpadding="0" bordercolor="#979797" align="center">
            <tr>
                <td align="center">Quantite souhaitée</td>
            </tr>
            <tr>
                <td>
                    <input type="number" min="0" name="quantite" required>
                </td>
            </tr>
            <tr height="30">
                <td colspan="2">
                    <p align="center">
                        <input type="submit" value="Valider"><br>
                    </p>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>