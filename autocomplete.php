<style>
#auto-complete img {
    width: 48px;
    height: 48px;
}
</style>
<?php
    include_once('sqlfunctions.php');
    $search = isset($_GET["search"]) ? $_GET["search"] : null;
    $id = isset($_GET["id"]) ? $_GET["id"] : null;
    $results = getSqlProduct($id, $search);
    if ($results) {
?>
<table id="auto-complete">
    <?php
        foreach ($results as $result) {
    ?>
    <tr>
        <td><img src="<?php echo $result["photo"]; ?>" alt=""></td>
        <td><?php echo $result["titre"]; ?></td>
    </tr>
    <?php } ?>
</table>
<?php } ?>