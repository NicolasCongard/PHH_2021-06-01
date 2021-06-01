<?php

    $mysqli = null;

    /**
     *
     * @param  mixed $query sql request
     * 
     * @return array|boolean
     */
    function selectTable($query) {
        $GLOBALS["mysqli"] = mysqli_connect("localhost", "root", "", "magasin");
        $res = mysqli_query($GLOBALS["mysqli"], $query);

        if (!$res) {
            return false;
        } else if (gettype($res) == "boolean" && mysqli_affected_rows($GLOBALS["mysqli"]) > 0) {
            return true;
        }

        $array = array();
        while($row = mysqli_fetch_assoc($res)) {
            array_push($array, $row);
        };
        return $array;
    }


    
    /**
     *
     * @param  int         $id
     * @param  string|null $search
     * 
     * @return array|boolean
     */
    function getSqlProduct($id, $search = null) {
        $query = "SELECT p.`id`, p.`titre`, p.`ref`, p.`prix`, p.`photo`, p.`description`, c.`id` AS cat_id, c.`titre` AS cat_titre, c.`description` AS cat_desc 
        FROM `produits` p, `categories` c WHERE c.`id` = p.`id_categorie` ";
        if ($id != null && $id != "all") {
            $query .= "AND p.`id` = $id";
        }
        if ($search != null) {
            $query .= "AND p.`titre` LIKE '%$search%'";
        }
        $result = selectTable($query);
        return $result ? $result : false;
    }
    
    /**
     *
     * @param  string $titre
     * @param  string $ref
     * @param  int    $prix
     * @param  string $photo
     * @param  string $description
     * @param  int    $id
     * 
     * @return int|boolean
     */
    function setSqlProduct($titre, $ref, $prix, $photo, $description, $id) {
        $query = "INSERT INTO `produits`(`titre`, `ref`, `prix`, `photo`, `description`, `id_categorie`) 
                    VALUES ('".$titre."', '".$ref."', $prix, '".$photo."', '".$description."', $id)";
        $result = selectTable($query);
        if ($result) {
            return mysqli_insert_id($GLOBALS["mysqli"]);
        } else {
            return false;
        }
    }
    
    /**
     *
     * @param  mixed $titre
     * @param  mixed $ref
     * @param  mixed $prix
     * @param  mixed $photo
     * @param  mixed $description
     * @param  mixed $idCategorie
     * @param  mixed $idProduit
     * @return void
     */
    function updateSqlProduct($titre, $ref, $prix, $photo, $description, $idCategorie, $idProduit) {
        $query = "UPDATE `produits` SET `titre` = '".$titre."', `ref` = '".$ref."', `prix` = $prix, `photo` = '".$photo."', `description` = '".$description."', `id_categorie` = $idCategorie WHERE `id` = $idProduit";
        return selectTable($query);
    }

?>