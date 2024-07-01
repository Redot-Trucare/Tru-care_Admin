<?php
require_once('dbConfig.php');

$itemsql = $db->query("SELECT * FROM blog WHERE id = ". $_GET['id'] .";");

$numrows = $itemsql->num_rows;
if($numrows == 0) {
//header('Location: main_category_upload.php');
echo "<script>window.location.href='blogs.php';</script>";
}

$sql = $db->query("DELETE FROM blog WHERE id = ". $_GET['id']);
if($sql){
	//header('Location: main_category_upload.php');
	echo "<script>window.location.href='blogs.php';</script>";
}
?>
