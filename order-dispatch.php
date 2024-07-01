<?php
session_start();
 if(isset($_POST['submit'])) {
require("dbConfig.php");
$itemsql = "UPDATE orderitems SET courier_name= '" . $_POST['courier_name'] ."', courier_url= '" . $_POST['courier_url'] ."',delivery_id= '" . $_POST['delivery_id'] ."' WHERE payment_type =1 AND order_id = " . $_POST['order_id'];
//mysql_query($funcsql);
mysqli_query($db, $itemsql);
//echo $itemsql;
$itemorder = "UPDATE orders SET status= '12', cancel_status= 'Delivered' WHERE id = " . $_POST['order_id'];
//mysql_query($funcsql);
mysqli_query($db, $itemorder);
//echo $itemorder;
$deliverysql = $db->query("SELECT Distinct delivery_id,courier_name,courier_url from orderitems WHERE payment_type =1 AND order_id = " . $_POST['order_id']);
//$ordres = mysql_query($ordsql);
$ordelirow = $deliverysql->fetch_assoc();

$ordsql = $db->query("SELECT * from orderitems WHERE order_id = " . $_POST['order_id']);
//$ordres = mysql_query($ordsql);
$ordrow = $ordsql->fetch_assoc();
$ordsql1 = $db->query("SELECT * from orders WHERE id = " . $_POST['order_id']);
//$ordres = mysql_query($ordsql);
$ordrow1 = $ordsql1->fetch_assoc();
date_default_timezone_set('Asia/Kolkata'); 
$date = date("Y-m-d H:i:s");
$itemsql3 = "INSERT INTO order_action(order_id, order_date, order_sign, order_status, login_id, update_on) VALUES ('" . $ordrow1['id'] . "','" . $ordrow1['date'] . "','Confirm the Order','Depatch the Order','" . $_SESSION['username'] . "','$date')";
//mysql_query($funcsql);
mysqli_query($db, $itemsql3);
//echo $itemsql3;
$loginsql = $db->query("SELECT * FROM logins WHERE id = " . $ordrow['customer_id']);
//mysqli_query($db,$loginsql);

$loginrow = $loginsql->fetch_assoc();

$emsql = $db->query("SELECT * FROM customers WHERE customer_id = " . $loginrow['customer_id']);
//mysqli_query($db,$emsql);
$emrow = $emsql->fetch_assoc();
//echo $emrow['email'];
/*
ini_set("SMTP","mail.gmail.com");
    ini_set("smtp_port","25");
    ini_set('sendmail_from', 'esales@vanaaboutique.com');
    
 $to = $emrow['email'];
 $subject = "Dispatch Notification From Site";
 $email = "esales@vanaaboutique.com";
 
$message  = '<html><body>';
//$message .= '<img src="images/email.png" alt="Vanaa Boutique" />';
$message .= '<span style="font-family:Arial;font-size:10pt">';
$message .= '<br><br><div style="border-top:3px solid #00abe1;"></div>';	
$message .= '<h4>Dear <b>' . $emrow['forename'] .'.,</b></h4>';
$message .= '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your order in Vanaa Boutique website. Order Delivery ID is <b style="font-weight: bolder;color: #2a4f9d;">'. $ordelirow['delivery_id'] .'</b>.</p>';
$message .= '<h5>Courier Name : '. $ordelirow['courier_name'] .'</h5>';  
$message .= '<p>Track Your Order Here <a href="'. $ordelirow['courier_url'] .'">'. $ordelirow['courier_url'] .'</a>.</p>';
$message .= '<p>Thank You</p>';
$message .= '<div style="border-top:3px solid #00abe1"></div>';
$message .= '</span>';

$message .= '</body></html>';   
 
 //$header = "From:$email";

 $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$email."\r\n".
    'Reply-To: '.$email."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
 $send = mail($to,$subject,$message,$headers);
 */
//Echo $itemsql;
//header("Location: product-confirm-orders.php");
echo "<script>window.location.href='product-confirm-orders.php';</script>";
	}
?>
