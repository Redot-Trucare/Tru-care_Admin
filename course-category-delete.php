<?php
require_once('dbConfig.php');

$itemsql = $db->query("SELECT * FROM product_category WHERE id = ". $_GET['id'] .";");

$numrows = $itemsql->num_rows;
if($numrows == 0) {
//header('Location: main_category_upload.php');
echo "<script>window.location.href='product_category.php';</script>";
}

$sql = $db->query("DELETE FROM product_category WHERE id = ". $_GET['id']);
if($sql){
	//header('Location: main_category_upload.php');
	echo "<script>window.location.href='product_category.php';</script>";
}
?>
