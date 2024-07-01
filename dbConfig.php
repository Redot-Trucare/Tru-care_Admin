<?php 
$dbhost ="localhost";
$dbusername ="root";
$dbpassword ="";
$dbdatabase ="skin_care";

$db= new mysqli($dbhost,$dbusername,$dbpassword,$dbdatabase);
if($db->connect_error){
	die("connection failed :" .$db->connect_error);
}
?>
