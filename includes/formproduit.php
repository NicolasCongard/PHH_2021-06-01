<?php
    include_once('sqlfunctions.php');
    $produit = null;
    if (isset($_GET["id"])) {
        $produit = getSqlProduct($_GET["id"])[0];
    }
?>

<div id="form-produit">
    <form enctype="multipart/form-data" action="?page=saveproduit<?= isset($_GET["id"]) ? "&id=".$_GET["id"] : "" ?>" method="POST" role="form">
        <legend>Edition produit</legend>

        <div class="form-group">
            <label for="titre-produit">Titre</label>
            <input type="text" class="form-control" id="titre-produit" name="titre-produit" placeholder="Saisir titre"
                value="<?= $produit ? $produit["titre"] : "" ?>">
            <label for="ref-produit">Ref</label>
            <input type="text" class="form-control" id="ref-produit" name="ref-produit" placeholder="Saisir ref"
                pattern="REF-[\d\w]{1,25}" value="<?= $produit ? $produit["ref"] : "" ?>">
            <label for="cat-produit">Catégorie</label>
            <?php 
                    include_once('sqlfunctions.php');
                    $result = selectTable("SELECT id, titre FROM categories");
                ?>
            <select name="cat-produit" id="cat-produit" class="form-control" required="required">
                <?php
                        for($i=0; $i<count($result); $i++){
                            echo "<option value='".$result[$i]["id"]."'";
                            if ($produit && $result[$i]["id"] == $produit["cat_id"]) {
                                echo ' selected=selected" ';
                            }
                            echo ' >'.$result[$i]["titre"]."</option>";
                        }
                    ?>
            </select>
        </div>
        <div class="form-group">
            <label for="photo-produit">Photo</label>
            <input type="file" class="form-control" id="photo-produit" name="photo-produit"
                value="<?= $produit ? $produit["photo"] : "" ?>">
        </div>
        <div class="form-group">
            <label for="prix-produit">Prix</label>
            <input type="number" min="0.01" step="0.01" class="form-control" id="prix-produit" name="prix-produit"
                value="<?= $produit ? $produit["prix"] : "" ?>" placeholder="Saisir prix">
        </div>
        <div class="form-group">
            <label for="description-produit">Description</label>
            <textarea class="form-control" id="description-produit" name="description-produit">
                </textarea>
        </div>

        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
    <?php
        $uploaddir = 'img';
        $uploadfile = $uploaddir . basename($_FILES['photo-produit']['name']);
        move_uploaded_file($_FILES['photo-produit']['tmp_name'], $uploadfile);
    ?>

</div>