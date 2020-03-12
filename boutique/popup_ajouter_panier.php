<html>
 <head>
  <title>Boutique</title>
  <link href="boutique.css" rel="stylesheet">
 </head>
 <body>
 <?php
    //ouverture json file, contenu sur $obj, nombre de produit sur $nbproduit
    $file = 'produit.json'; 
    $data = file_get_contents($file); 
    $obj = json_decode($data); 
    $nbproduit = count($obj); 

    if(isset($_GET["id"]))
    {
        $id=$_GET["id"];
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
            
            $articlepanier = $quantite."/".$description."/".$name."/".$price;
            
            echo("</br>articlepanier :".$articlepanier);

            $monfichier = fopen('panier.txt', 'r+');

            fclose($monfichier);
            

?>
        <script type="text/javascript">
            window.opener.location.reload();
            //window.close();
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