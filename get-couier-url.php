<?php
include 'dbConfig.php';
if(isset($_POST['c_n'])) {
	//$sql = "select * from `states` where `country_id`=".mysqli_real_escape_string($con, $_POST['c_id']);
	
	$sql = "SELECT Distinct url FROM couriers WHERE name = '".mysqli_real_escape_string($db, $_POST['c_n'])."' ORDER BY url Asc";
	$res = mysqli_query($db, $sql);
	echo $sql;
	if(($res->num_rows) > 0) {
		//echo "<option value=''>Select URL</option>";
		while($row = mysqli_fetch_object($res)) {
			$url = $row->url;
			echo "<option value='".$url."'>".$url."</option>";
		}
	}
} else {
	echo "No Data";
}
?>
