<?php
session_start();
 if(isset($_POST['submit'])) {
require("dbConfig.php");

$itemsql1 = "UPDATE orders SET payment_type= '2', status= '10', cancel_status = 'Confirm the order', payment_id = '" . $_POST['payment_id'] ."' WHERE customer_id = " . $_POST['customer_id'] ." and id = " . $_POST['order_id'];
//mysql_query($funcsql);
mysqli_query($db, $itemsql1);
$itemsql2 = "UPDATE orderitems SET payment_type= '1' WHERE customer_id = " . $_POST['customer_id'] ." and order_id = " . $_POST['order_id'];
//mysql_query($funcsql);
mysqli_query($db, $itemsql2);

$billsql = $db->query("SELECT Count(id) as bills from order_billing");
$billrow = $billsql->fetch_assoc();
$upsql3 = "INSERT INTO order_billing(bill_no, order_id, customer_id) VALUES ('" .$billrow['bills'] . "' + '1','". $_POST['order_id'] ."','". $_POST['customer_id'] ."')";
mysqli_query($db,$upsql3);

$ordsql = $db->query("SELECT * from orders WHERE id = " . $_POST['order_id']);
//$ordres = mysql_query($ordsql);
$ordrow = $ordsql->fetch_assoc();
$date = date("Y-m-d H:i:s");  
$itemsql3 = "INSERT INTO order_action(order_id, order_date, order_sign, order_status, login_id, update_on) VALUES ('" . $ordrow['id'] . "','" . $ordrow['date'] . "','S1','Confirm the Order','" . $_SESSION['username'] . "','$date')";
//mysql_query($funcsql);
mysqli_query($db, $itemsql3);
//echo $itemsql3;

require("dbConfig.php");
$res1 = "select id,customer_id from logins where id='".$_POST['customer_id']."'";
$res2 = mysqli_query($db,$res1);
//echo $res1;
$ctrow = $res2->fetch_assoc();
$cusm_results = "select * from customers where customer_id=".$ctrow['customer_id'];
$cusmt_results = mysqli_query($db,$cusm_results);
//echo $cusm_results;
$cutrow = $cusmt_results->fetch_assoc();
$cutrows_ema = $cutrow['email'];
$cutrows_name = $cutrow['forename'];
$cutrows_surname = $cutrow['surname'];
$cutrows_phone = $cutrow['phone'];
$cutrows_add1 = $cutrow['add1'];
$cutrows_add2 = $cutrow['add2'];
$cutrows_add3 = $cutrow['add3'];
$cutrows_district = $cutrow['district'];
$cutrows_state = $cutrow['state'];
$cutrows_country = $cutrow['country'];
//echo $cutrows_ema;  
require("dbConfig.php");
$custsql = $db->query("SELECT id, status, registered, total from orders WHERE customer_id = ". $_POST['customer_id'] . " AND id = '". $_POST['order_id'] ."' AND status = 10;");
$custrow = $custsql->fetch_assoc();

$result = $db->query("SET NAMES utf8");//the main trick

$itemssql = $db->query("SELECT products.*, orderitems.*, orderitems.id AS itemid, sum(orderitems.quantity) as pro_count FROM products, orderitems WHERE orderitems.product_id = products.Product_id AND orderitems.order_id = ". $custrow['id'] ." AND orderitems.customer_id = ". $_POST['customer_id']. "  AND orderitems.payment_type = 1 GROUP BY orderitems.product_id");
$itemnumrows = $itemssql->num_rows;

/*
 ini_set("SMTP","mail.gmail.com");
    ini_set("smtp_port","25");
    ini_set('sendmail_from', 'esales@vanaaboutique.com');
    
 $to = "esales@vanaaboutique.com";
 $subject = "Order From Site";
 
$message  = '<html><body>';
$message .= '<img src="logo/logo1.png" />';
$message .= '<span style="font-family:Arial;font-size:10pt">';
$message .= '<br><br><div style="border-top:3px solid #2d8b01;"></div>';	
$message .= '<h4>Dear <b>Executive.,</b></h4>';
$message .= '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;There is an order from Vanaa Boutique website. Order details furnished below for your reference. Thank You</p>';
$message .= '<br>';

date_default_timezone_set("Asia/Kolkata");
$today = date("d/m/Y");

$message .= '<h4><b>Enquiry Date : ' . $today . '</b></h4>';
$message .= '<br>';
$message .= '<h4  style="color: #2d8b01;"><b>Details of Product : </b></h4><br>';
$message .= '<style>
table, th, td {
  border: 1px solid #2d8b01;
}
</style>';
$message .= '<table style="border: 1px solid #2d8b01;">';
$message .= '<tr>';
$message .= '<th style="border: 1px solid #2d8b01;">Product Name</th>';
$message .= '<th style="border: 1px solid #2d8b01;">Product</th>';
$message .= '<th style="border: 1px solid #2d8b01;">Product Quantity X Unit Price</th>';
$message .= '<th style="border: 1px solid #2d8b01;">Total Product Price</th>';
							$quantitytotal1 = 0;
							while($itemsrow = $itemssql->fetch_assoc())
{
$message .= '<tr class="cart_item">'; 
												@$quantitytotal1 += $itemsrow['Price'] * $itemsrow['pro_count'];
												$quantitytotal11 = $itemsrow['Price'] * $itemsrow['pro_count'];
$message .= '<td class="product-name">'. ucwords($itemsrow['Title']) .'</td>';											
$message .= '<td class="product-thumbnail"><img src="Uploads/' .$itemsrow['Image'] . '"  alt="'. $itemsrow['Title'] . '" width="50" /></td>';												
$message .= '<td>'. $itemsrow['pro_count'] .'X '. $itemsrow['Price'] .'</td>';
$message .= '<td class="product-total"><i class="fa fa-inr"></i>'. $quantitytotal11 .'</td>';
$message .= '</tr>';
                                             $pro_total2 = $quantitytotal1;
                                             $curr = $itemsrow['Currency'];
                                            }
                                            
	                           
@$total = $pro_total2;
$message .= '<tr>';
$message .= '<td><br></td>';
$message .= '<td><br></td>';	
$message .= '<td><br></td>';
$message .= '<td><br></td>';
$message .= '<td style="border:1px solid #2d8b01;"><h4><b>Total</b> : '. $total . '.00</h4><br>';
 $customsql = $db->query("SELECT * FROM coupon_status WHERE order_id = '".$custrow['id']."' and customer_id = '".$_POST['customer_id']."'");
										  $coupcheck = $customsql->num_rows;
										  $couprow = $customsql->fetch_assoc();
										  if($coupcheck == 1) {
									$message .= '<h4><b>Coupon Code Applied</b> : '. $couprow['discount'] . '%</h4>';
									$message .= '<h4><b>Total Paid</b> : '. $couprow['sell_price'] . '</h4></td>';
										  } else {
$message .= '<h4><b>Total Paid</b> : '. $total . '</h4></td>';
}
$message .= '</tr>';	
$message .= '</table>';
$message .= '<h4><b>First Name : </b>' . ucwords($cutrows_name);
$message .= '&nbsp;&nbsp;&nbsp;&nbsp;<b>Last Name : </b>' . ucwords($cutrows_surname) . '</h4>';
$message .= '<br>';
$message .= '<h4><b>Email : ' . $cutrows_ema . '</b></h4>';
$message .= '<br>';
$message .= '<h4><b>Phone Number : ' . $cutrows_phone . '</b></h4>';
$message .= '<br>';
$message .= '<h4><b>Add1 : </b>' . $cutrows_add1 . ', ' . $cutrows_add2 . ', ' . $cutrows_add3 . '</h4>';
$message .= '<br>';
$message .= '<h4><b>District : </b>' . ucwords($cutrows_district);
$message .= '&nbsp;&nbsp;&nbsp;&nbsp;<b>State : </b>' . $cutrows_state;
$message .= '&nbsp;&nbsp;&nbsp;&nbsp;<b>Country : </b>'. $cutrows_country .'</h4>';
$message .= '<br>';
$message .= '<div style="border-top:3px solid #2d8b01"></div>';
$message .= '</span>';

$message .= '</body></html>'; 
 $email = "esales@vanaaboutique.com";  
 //$email = $cutrows_ema;
 //$header = "From:$email";

 $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$email."\r\n".
    'Reply-To: '.$email."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
 $send = mail($to,$subject,$message,$headers);	
 */
require("dbConfig.php");
$custsql2 = $db->query("SELECT id, status, registered, total,customer_id,delivery_add_id  from orders WHERE customer_id = ". $_POST['customer_id']. " AND id = '". $_POST['order_id'] ."' AND status = 10;");
$custrow2 = $custsql2->fetch_assoc();

$result = $db->query("SET NAMES utf8");//the main trick

$itemssql3 = $db->query("SELECT products.*, orderitems.*, orderitems.id AS itemid, sum(orderitems.quantity) as pro_count FROM products, orderitems WHERE orderitems.product_id = products.id AND orderitems.order_id = ". $custrow2['id'] ." AND orderitems.customer_id = ". $_POST['customer_id']. " AND orderitems.payment_type = 1 GROUP BY orderitems.product_id");
$itemnumrows3 = $itemssql3->num_rows;

/*
ini_set("SMTP","mail.gmail.com");
    ini_set("smtp_port","25");
    ini_set('sendmail_from', 'esales@vanaaboutique.com');
    
 $to = $cutrows_ema;
  $from = "esales@vanaaboutique.com";
 $subject = "Vanaa Boutique :: Your order Booking";
 
 
$message  = '<html><body>';
$message .= '<img src="logo/logo1.png" alt="Vanaa Boutique" />';
$message .= '<span style="font-family:Arial;font-size:10pt">';
$message .= '<br><br><div style="border-top:3px solid #264796;"></div>';	
$message .= '<h4>Dear <b>'.$cutrows_name.'.,</b></h4>';
$message .= '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Order Booking in Vanaa Boutique  and the order details furnished below for your reference. Thank You</p>';
$message .= '<br>';

date_default_timezone_set("Asia/Kolkata");
$today = date("d/m/Y");

$message .= '<h4 style="color:#008dd2">Order Date : <b>' . $today . '</b> || Heres what you have ordered :</h4>';
$message .= '<br>';
//$message .= '<h4  style="color: #008dd2;"><b>Details of Product Enquiries</b></h4><br>';
$message .= '<style>
table, th, td {
  border: 1px solid #264796;
}
</style>';
$message .= '<table style="border: 1px solid #264796;">';
$message .= '<tr>';
$message .= '<th style="border: 1px solid #264796;">Product Name</th>';
$message .= '<th style="border: 1px solid #264796;">Product</th>';
$message .= '<th style="border: 1px solid #264796;">Product Quantity X Unit Price</th>';
$message .= '<th style="border: 1px solid #264796;">Total Product Price</th>';
							$quantitytotal4 = 0;
							while($itemsrow3 = $itemssql3->fetch_assoc())
{
$message .= '<tr class="cart_item">'; 
												@$quantitytotal4 += $itemsrow3['Price'] * $itemsrow3['pro_count'];
												$quantitytotal44 = $itemsrow3['Price'] * $itemsrow3['pro_count'];
$message .= '<td class="product-name">'. ucwords($itemsrow3['Title']) .'</td>';											
$message .= '<td class="product-thumbnail"><img src="Admin/Uploads/' .$itemsrow3['Image'] . '"  alt="'. $itemsrow3['Title'] . '" width="50"/></td>';												
$message .= '<td>'. $itemsrow3['pro_count'] .'X '. $itemsrow3['Price'] .'</td>';
$message .= '<td class="product-total"><i class="fa fa-inr"></i>'. $quantitytotal44 .'</td>';
$message .= '</tr>';
                                             $pro_total4 = $quantitytotal4;
                                             $curr = $itemsrow3['Currency'];
                                            }
                                            
	                           
@$total2 = $pro_total4;
$message .= '<tr>';
$message .= '<td><br></td>';
$message .= '<td><br></td>';	
$message .= '<td><br></td>';
$message .= '<td><br></td>';
$message .= '<td style="border:1px solid #264796;">Payment Details:<br><h4><b>Total Amount</b> : '. $total2 . '</h4><br>';
 $customsql = $db->query("SELECT * FROM coupon_status WHERE order_id = '".$custrow2['id']."' and customer_id = '".$_POST['customer_id']."''");
										  $coupcheck = $customsql->num_rows;
										  
										  if($coupcheck == 1) {
										      $couprow = $customsql->fetch_assoc();
									$message .= '<h4><b>Coupon Code Applied</b> : '. $couprow['discount'] . '%</h4>';	      
									$message .= '<h4><b>Total Paid</b> : '. $couprow['sell_price'] . '</h4></td>';
										  } else {
$message .= '<h4><b>Total Paid</b> : '. $total2 . '</h4></td>';
}
$message .= '</tr>';	
$message .= '</table>';
$message .= '<h4><b>Delivery Details  : </b>';
$addsql1 = $db->query("SELECT * FROM logins WHERE id = " . $custrow2['customer_id']);
$addrow1 = $addsql1->fetch_assoc();      
if($custrow2['delivery_add_id'] == 0)
{
$addsql = $db->query("SELECT * FROM customers WHERE id = " . $addrow1['customer_id']);
//$addres = mysql_query($addsql);
}

else
{
$addsql = $db->query("SELECT * FROM delivery_addresses WHERE id = " . $custrow2['delivery_add_id']);
//$addres = mysql_query($addsql);
}
$addrow = $addsql->fetch_assoc();
$message .= "<br>";
//echo "<h4><strong>Address</strong> : </h4>";
$message .= "<p>" . $addrow['forename'] . " ". $addrow['surname'] . "<br>";
$message .= $addrow['add1'];
$message .= $addrow['add2'] . "<br>";
$message .= $addrow['add3'] . "<br>";
$message .= $addrow['district'] . " - ". $addrow['postcode'] . "<br>";
$message .= $addrow['state'] . ",". $addrow['country'] . "<br><br>";
$message .= "<strong>Email : </strong>" .$addrow['email'] . "<br>";
$message .= "<strong>Mobile : </strong>". $addrow['phone'] . "<br></p>";
//$message .= "<span>Track your Order Here : </span><a href=''>Track Order</a><br></p>";
$message .= '<br>';
$message .= '<div style="border-top:3px solid #264796"></div>';
$message .= '</span>';

$message .= '</body></html>'; 
 $email = "esales@vanaaboutique.com";  
 //$email = $cutrows_ema;
 //$header = "From:$email";

 $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
 $send = mail($to,$subject,$message,$headers);	
 */ 
$itemsql2 = $db->query("SELECT sku, quantity FROM orderitems WHERE orderitems.order_id = '". $custrow2['id'] ."' AND orderitems.customer_id = '". $custrow2['customer_id'] ."' GROUP BY product_id");
//mysqli_query($db,$itemssql);
//echo $itemsql2;
while($itrow = $itemsql2->fetch_assoc())
{
	$quan = $itrow['quantity'];
	$sku = $itrow['sku'];
  $upsql3 = "UPDATE stocks SET quantity = quantity - '$quan'  WHERE sku = '$sku'";
	mysqli_query($db,$upsql3);
    //echo $upsql3;
												 
}

$itemsql3 = $db->query("SELECT Distinct product_id FROM orderitems WHERE orderitems.order_id = '". $custrow2['id'] ."' AND orderitems.customer_id = '". $custrow2['customer_id'] ."' GROUP BY product_id");
while($itsrow = $itemsql3->fetch_assoc())
{
	$pro_id = $itsrow['product_id'];
$prodcountcheck = $db->query("SELECT sell_count FROM products Where id='$pro_id'");
$countrow = $prodcountcheck->fetch_assoc();
if($countrow['sell_count'] == ''){
	$prodcountsql = "update products set sell_count='1' where id=$pro_id";
        mysqli_query($db,$prodcountsql);
	} else {
       //$count = $countrow['view_count'];
        $prodcountsql = "update products set sell_count='" .$countrow['sell_count'] . "' + '1' where id=$pro_id";
        mysqli_query($db,$prodcountsql);
        //echo $prodcountsql;
	}
}
header("Location: s1-orders.php");
	}
?>
