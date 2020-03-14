<div>
    <div>
        <h1>Fiche produit</h1>
    </div>    
    <div>
        <table>
            <td>
                <?php
                echo(
                    '<img src="data:image/;base64,'.$imageProduit.'"></img><br/>'
                );
                ?>
            </td>
            <td>
                <tr>
                    <h3><?php echo($titre) ?></h3>
                    <label><?php echo($prix) ?> €</label>
                </tr>
                <tr>
                    <label>Description :</label>
                    <p><?php echo($description) ?></p>
                </tr>
            </td>
        </table>
    </div>
</div>
