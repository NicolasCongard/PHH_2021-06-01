<?php
    if (isset($_GET["page"])) {
        switch ($_GET["page"]) {
            case 'new':
                include 'includes/formproduit.php';
                break;
            case 'saveproduit':
                include_once('sqlfunctions.php');
                if (!isset($_GET["id"])
                    && isset($_POST["titre-produit"]) 
                    && isset($_POST["ref-produit"]) 
                    && isset($_POST["prix-produit"]) 
                    && isset($_POST["photo-produit"])
                    && isset($_POST["description-produit"])
                    && isset($_POST["cat-produit"])
                ) {
                    $id = setSqlProduct(
                        $_POST["titre-produit"],
                        $_POST["ref-produit"],
                        $_POST["prix-produit"],
                        $_POST["photo-produit"],
                        $_POST["description-produit"],
                        $_POST["cat-produit"]
                    );
                    
                    $_GET["id"] = $id;
                    print_r($_GET["id"]);
                } else {
                    updateSqlProduct(
                        $_POST["titre-produit"],
                        $_POST["ref-produit"],
                        $_POST["prix-produit"],
                        $_POST["photo-produit"],
                        $_POST["description-produit"],
                        $_POST["cat-produit"],
                        $_GET["id"]
                    );
                }
            case 'edit':
                include 'includes/formproduit.php';
                break;
            case 'panier':
                include 'includes/panier.php';
                break;         
            case 'produits':
                include 'includes/listeproduit.php';
                break;  
            case 'produit':
                include 'includes/produit.php';
                break;  
            default:
                include 'includes/home.php';
                break;
        }
    } else {
        include 'includes/home.php';
    }
?>