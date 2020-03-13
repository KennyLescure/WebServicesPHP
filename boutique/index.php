<html>
 <head>
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
    //ouverture json file, contenu sur $obj, nombre de produit sur $nbproduit
    $file = 'produit.json'; 
    $data = file_get_contents($file); 
    $obj = json_decode($data); 
    $nbproduit = count($obj); 

    //Initiation filtre vide
    $filtre = ",";

    if(isset($_GET["action"]))
    {
        if(isset($_POST["Homme"]))
        {
            $filtre = $filtre."homme,";
        }
        if(isset($_POST["Femme"]))
        {
            $filtre = $filtre."femme,";
        }
        if(isset($_POST["Enfant"]))
        {
            $filtre = $filtre."enfant,";
        }
        if(isset($_POST["Pneumatiques"]))
        {
            $filtre = $filtre."pneumatiques,";
        }
    }
    if ($filtre==",")
    {
        $filtre = ",homme,femme,enfant,pneumatiques"; // si aucun filtre appliqué, tous coché et tous actif
    }
?>
<div id="entete">
    <form action="index.php?action=filtre" method="post">
        <fieldset id="#periodicite">
            <span>
            <?php
                if(strpos($filtre,"homme"))
                {
                    echo("Homme<input type=\"checkbox\" name=\"Homme\" checked/>");
                }else
                {
                    echo("Homme<input type=\"checkbox\" name=\"Homme\" />");
                }

                if(strpos($filtre,"femme"))
                {
                    echo("Femme<input type=\"checkbox\" name=\"Femme\" checked/>");
                }else
                {
                    echo("Femme<input type=\"checkbox\" name=\"Femme\" />");
                }

                if(strpos($filtre,"enfant"))
                {
                    echo("Enfant<input type=\"checkbox\" name=\"Enfant\" checked/>");
                }else
                {
                    echo("Enfant<input type=\"checkbox\" name=\"Enfant\" />");
                }

                if(strpos($filtre,"pneumatiques"))
                {
                    echo("Pneumatiques<input type=\"checkbox\" name=\"Pneumatiques\" checked/>");
                }else
                {
                    echo("Pneumatiques<input type=\"checkbox\" name=\"Pneumatiques\" />");
                }
            ?>
                <input type="submit" value="Filtrer">
            </span>
            <a href="../panier/index.php"><img src="panier.jpg" id="panier" /></a>
        </fieldset>
    </form>
    </div>
    <table id="tablevelos" class="table"  border="1">
        <thead>
            <th>Liste de produits disponibles</th>
            <th></th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
<?php
for ($i = 0; $i<$nbproduit ; $i++) {
    if(strpos($filtre,$obj[$i]->type)){
        if ($i%2 == 1)
        {
            echo "<tr class=\"pair\">";
        }else{
            echo "<tr class=\"impair\">";
        }
        
        echo "<td><a href=\"_fiche_produit.php?id=".$obj[$i]->id."\">".$obj[$i]->name."</a></td>"; 
        echo "<td>".$obj[$i]->description."</td>"; 
        echo "<td>".$obj[$i]->price."</td>"; 
        echo "<td><a href=\"popup_ajouter_panier.php?id=".$obj[$i]->id."\" onclick=\"window.open(this.href, 'Popup', 'scrollbars=1,resizable=1,height=170,width=200'); return false;\">";
        echo"<input type=\"button\" value=\"Ajouter au panier\"/></a></td>";
        echo "</tr>";
    }
}
?>
        </tbody>
    </table>
 </body>
</html>