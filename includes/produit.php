<?php 
    include_once('sqlfunctions.php');
    $result = getSqlProduct($_GET["id"])[0];
    if ($result) {
?>
<div class="produit">
    <img src="<?php echo $result["photo"] ?>" class='img-rounded'>";
    <div>
        <h3><strong>Titre :</strong>
            <?php
                echo $result["titre"];
            ?>
        </h3>
        <h4><strong>Description :</strong>
            <?php
                echo $result["description"];
            ?>
        </h4>
        <h5><strong>Prix :</strong>
            <?php
                echo $result["prix"]."€";
            ?>
        </h5>
        <a class="btn btn-primary">Ajouter au panier</a>
    </div>
</div>
<?php } else { ?>
<h2>Produit inexistant</h2>
<?php } ?>