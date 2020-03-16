 <body>
<?php

    //recup produits
    $api = new api;
    if(isset($_GET["tokenuser"]))
    {
        $tokenuser = $_GET["tokenuser"];
    } else {
        $tokenuser = $_SESSION['token'];
    }
    $api->setToken($tokenuser);
    $prod = $api->getAllProduit();

    //Initiation filtre vide
    $filtre = ",";

    if(isset($_GET["action"]))
    {
        if(isset($_POST["Homme"]))
        {
            $filtre = $filtre."homme";
        }
        if(isset($_POST["Femme"]))
        {
            $filtre = $filtre."femme";
        }
        if(isset($_POST["Enfant"]))
        {
            $filtre = $filtre."enfant";
        }
        if(isset($_POST["Pneumatique"]))
        {
            $filtre = $filtre."pneumatique,";
        }
    }
    if ($filtre==",")
    {
        $filtre = ",vélo,homme,femme,enfant,pneumatique"; // si aucun filtre appliqué, tous coché et tous actif
    }
?>
<div id="entete">
<?php
    echo"<form action=\"index.php?uc=accueil&action=filtre&tokenuser=".$tokenuser."\" method=\"post\">"
?>
    
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

                if(strpos($filtre,"pneumatique"))
                {
                    echo("Pneumatiques<input type=\"checkbox\" name=\"Pneumatique\" checked/>");
                }else
                {
                    echo("Pneumatiques<input type=\"checkbox\" name=\"Pneumatique\" />");
                }
            ?>
                <input type="submit" value="Filtrer">
            </span>
            <?php
                echo'<a href="index.php?uc=panier"><img src="boutique/panier.jpg" id=panier /></a>';
            ?>
        </fieldset>
    </form>
    </div>
    <table id="tablevelos" class="table"  border="1">
        <thead>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Categorie</th>
            <th>Ajouter au panier</th>
        </thead>
        <tbody>
<?php
for($i=0;$i<count($prod['products']);$i++){ //pr chaque produit de la base

    for($z=0;$z<count($prod['products'][$i]['categories']);$z++){ // pr chaque index de sa table categorie
        
        if(strpos($filtre,$prod['products'][$i]['categories'][$z])){ // si l'index contient est contenu dans les filtres a affiché
            
            if ($i%2 == 1)
            {
                echo "<tr class=\"pair\">";
            }else{
                echo "<tr class=\"impair\">";
            }
        echo "<td><a href=index.php?uc=ficheProduit&id=".$prod['products'][$i]['id'].">".$prod['products'][$i]['name']."</a></td>"; 
        echo "<td>".$prod['products'][$i]['description']."</td>"; 
        echo "<td>".$prod['products'][$i]['price']."</td>"; 
        if (isset($prod['products'][$i]['categories'][1]))
        {
            echo "<td>".$prod['products'][$i]['categories'][1]."</td>"; 
        }else
        {
            echo "<td>".$prod['products'][$i]['categories'][0]."</td>"; 
        }
        echo "<td><a href=\"popup_ajouter_panier.php?id=".$prod['products'][$i]['id']."\" onclick=\"window.open(this.href, 'Popup', 'scrollbars=1,resizable=1,height=170,width=200'); return false;\">";
        echo"<input type=\"button\" value=\"Ajouter au panier\"/></a></td>";
        echo "</tr>";          
        $z++;

        }
    }    
}?>
        </tbody>
    </table>
 </body>