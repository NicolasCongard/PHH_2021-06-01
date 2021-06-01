<h1>Tous les produits de la boutique</h1>
<?php 
    include_once('sqlfunctions.php');
    $search = isset($_GET["search"]) ? $_GET["search"] : null;
    $id = isset($_GET["id"]) ? $_GET["id"] : null;
    if (isset($search) || isset($id)) {
        $results = getSqlProduct($id, $search);
        if ($results) {
            foreach ($results as $result) {
?>
<div class="produit-item">
    <img src="<?php echo $result["photo"] ?>" class="img-rounded">;
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
        <a href="?page=produit&id=<?php echo $result["id"] ?>" class="btn btn-primary">Voir</a>
        <a class="btn btn-primary">Ajouter au panier</a>
    </div>
</div>
<?php } } else { ?>
<h2>Votre recherche n'a retourné aucun résultat</h2>
<?php } } ?>