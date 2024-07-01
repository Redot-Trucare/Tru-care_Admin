<?php

function order_details()
{
$validid = $_GET['id'];
	require("dbConfig.php");


                      //echo "<h1>Order Details</h1>";
                      echo "<br>";
                     echo "<a  class='btn-st bordr rd-30' href='product-orders.php'><span class='ti-arrow-left'></span> go back to the Orders List</a>";
                     echo "<br><br>";
                     $ordsql = $db->query("SELECT * from orders WHERE id = " . $validid);
//$ordres = mysql_query($ordsql);
$ordrow = $ordsql->fetch_assoc();
$ordidsql = $db->query("SELECT * FROM order_billing WHERE order_id = '". $validid ."'");
$ordidrows = $ordidsql->fetch_assoc();
//echo "<td>IM01".$ordidrows['bill_no']."</td>";
echo "<h4><strong>Order Number</strong> : " . $ordidrows['bill_no'] . "</h4>";
//echo "<h4><strong>Order Number</strong> : " . $ordrow['id'] . "</h4>";
echo "<br>";
echo "<h4><strong>Date of order</strong> : " . date('D jS F Y g.iA',strtotime($ordrow['date'])) . "</h4>";
echo "<br>";
echo "<h4><strong>Payment Type</strong> : ";
if($ordrow['payment_type'] == 1)
{
echo "PayPal";
}
else
{
echo "Stripe Payment";
}
echo "</h4>";  
$addsql1 = $db->query("SELECT * FROM logins WHERE id = " . $ordrow['customer_id']);
$addrow1 = $addsql1->fetch_assoc();      
if($ordrow['delivery_add_id'] == 0)
{
$addsql = $db->query("SELECT * FROM customers WHERE customer_id = " . $addrow1['customer_id']);
//$addres = mysql_query($addsql);
}

else
{
$addsql = $db->query("SELECT * FROM delivery_addresses WHERE id = " . $ordrow['delivery_add_id']);
//$addres = mysql_query($addsql);
}
$addrow = $addsql->fetch_assoc();
echo "<br>";
echo "<h4><strong>Address</strong> : </h4>";
echo "<p>" . $addrow['forename'] . " ". $addrow['surname'] . "<br>";
echo $addrow['add1']. ",";
echo $addrow['add2'] . ",<br>";
//echo $addrow['add3'] . "<br>";
echo $addrow['district'] . " - ". $addrow['postcode'] . ",<br>";
echo $addrow['state'] . ",". $addrow['country'] . ".<br>";
echo "<br>";
if($ordrow['delivery_add_id'] == 0)
{
echo "<i>Address from member account</i>";
echo "<br>";
}
else
{
echo "<i>Different delivery address</i>";
echo "<br>";
}
echo "</p>";
echo "<br>";
echo "<h4><strong>Phone : </strong></td><td>". $addrow['phone'] . "</h4>";
echo "<br>";
echo "<h4><strong>Email : </strong></td><td><a href='mailto:" . $addrow['email'] . "'>". $addrow['email'] . "</a></h4>";
$result = $db->query("SET NAMES utf8");//the main trick
$itemssql = $db->query("SELECT products.*, orderitems.*, orderitems.id AS itemid, sum(orderitems.quantity) as pro_count FROM products, orderitems WHERE orderitems.product_id = products.id AND orderitems.order_id = " . $validid ." And orderitems.payment_type = 1 GROUP BY products.id ORDER BY orderitems.id");
//mysqli_query($db,$itemssql);
//echo $itemssql;
//$itemssql = $db->query("SELECT products.*, orderitems.*,orderitems.id AS itemid FROM products, orderitems WHERE orderitems.product_id = products.id AND order_id = " . $validid ." And orderitems.payment_type = 1");
//$itemsres = mysql_query($itemssql);
$itemnumrows = $itemssql->num_rows;

echo "<br>";
echo "<h1>Products Purchased</h1>";

?>
<table class="cart-table table table-responsive">
                      <thead>
                        <tr>
						   <th></th>
                          <th>Product</th>
                          <th>Quantity</th>
                          <th>Price</th>
                          <th>Total</th>
                          
                        </tr>
                      </thead>
                      <?php
                      if($itemnumrows > 0){
                      while($itemsrow = $itemssql->fetch_assoc())
{
$quantitytotal = $itemsrow['price'] * $itemsrow['pro_count'];
echo "<tr>";

echo "<td><img src='products/". $itemsrow['image1'] . "' width='50' alt='". $itemsrow['product_name'] . "'></td>";

echo "<td>" . $itemsrow['product_name'] . "</td>";
echo "<td>" . $itemsrow['pro_count'] . " x </td>";
echo "<td><strong>$ " . sprintf('%.2f',$itemsrow['price']) . "</strong></td>";
echo "<td><strong>$ " . sprintf('%.2f',$quantitytotal) . "</strong></td>";
echo "</tr>";
@$total = $total + $quantitytotal;


}
}
echo "<tr>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td>TOTAL</td>";
echo "<td><strong>" . sprintf('%.2f', $total). "</strong></td>";
echo "</tr>";
     echo "</table>";                 
                      ?>

              </address>
<?php }

function confirm_order_details()
{
$validid = $_GET['id'];
	require("dbConfig.php");


                      //echo "<h1>Order Details</h1>";
                      echo "<br>";
                     echo "<a  class='btn-st bordr rd-30' href='product-confirm-orders.php'><span class='ti-arrow-left'></span> go back to the Confirm Orders</a>";
                     echo "<br><br>";
                     $ordsql = $db->query("SELECT * from orders WHERE id = " . $validid);
//$ordres = mysql_query($ordsql);
$ordrow = $ordsql->fetch_assoc();
$ordidsql = $db->query("SELECT * FROM order_billing WHERE order_id = '". $validid ."'");
$ordidrows = $ordidsql->fetch_assoc();
echo "<h4><strong>Order Number</strong> : " . $ordidrows['bill_no'] . "</h4>";
//echo "<h4><strong>Order Number</strong> : " . $ordrow['id'] . "</h4>";
echo "<br>";
echo "<h4><strong>Date of order</strong> : " . date('D jS F Y g.iA',strtotime($ordrow['date'])) . "</h4>";
echo "<br>";
echo "<h4><strong>Payment Type</strong> : ";
if($ordrow['payment_type'] == 1)
{
echo "PayPal";
}
else
{
echo "COD";
}
echo "</h4>";  
$addsql1 = $db->query("SELECT * FROM logins WHERE id = " . $ordrow['customer_id']);
$addrow1 = $addsql1->fetch_assoc();      
if($ordrow['delivery_add_id'] == 0)
{
$addsql = $db->query("SELECT * FROM customers WHERE customer_id = " . $addrow1['customer_id']);
//$addres = mysql_query($addsql);
}

else
{
$addsql = $db->query("SELECT * FROM delivery_addresses WHERE id = " . $ordrow['delivery_add_id']);
//$addres = mysql_query($addsql);
}
$addrow = $addsql->fetch_assoc();
echo "<br>";
echo "<h4><strong>Address</strong> : </h4>";
echo "<p>" . $addrow['forename'] . " ". $addrow['surname'] . "<br>";
echo $addrow['add1']. ",";
echo $addrow['add2'] . ",<br>";
//echo $addrow['add3'] . "<br>";
echo $addrow['district'] . " - ". $addrow['postcode'] . ",<br>";
echo $addrow['state'] . ",". $addrow['country'] . ".<br>";
echo "<br>";
if($ordrow['delivery_add_id'] == 0)
{
echo "<i>Address from member account</i>";
echo "<br>";
}
else
{
echo "<i>Different delivery address</i>";
echo "<br>";
}
echo "</p>";
echo "<br>";
echo "<h4><strong>Phone : </strong></td><td>". $addrow['phone'] . "</h4>";
echo "<br>";
echo "<h4><strong>Email : </strong></td><td><a href='mailto:" . $addrow['email'] . "'>". $addrow['email'] . "</a></h4>";
$result = $db->query("SET NAMES utf8");//the main trick
$itemssql = $db->query("SELECT products.*, orderitems.*, orderitems.id AS itemid, sum(orderitems.quantity) as pro_count FROM products, orderitems WHERE orderitems.product_id = products.id AND orderitems.order_id = " . $validid ." And orderitems.payment_type = 1");
//mysqli_query($db,$itemssql);
//echo $itemssql;
//$itemssql = $db->query("SELECT products.*, orderitems.*,orderitems.id AS itemid FROM products, orderitems WHERE orderitems.product_id = products.id AND order_id = " . $validid ." And orderitems.payment_type = 1");
//$itemsres = mysql_query($itemssql);
$itemnumrows = $itemssql->num_rows;

echo "<br>";
echo "<h1>Products Purchased</h1>";

?>
<table class="cart-table table table-responsive">
                      <thead>
                        <tr>
						   <th></th>
                          <th>Product</th>
                          <th>Quantity</th>
                          <th>Price</th>
                          <th>Total</th>
                          
                        </tr>
                      </thead>
                      <?php
                      if($itemnumrows > 0){
                      while($itemsrow = $itemssql->fetch_assoc())
{

$quantitytotal = $itemsrow['price'] * $itemsrow['pro_count'];
echo "<tr>";

echo "<td><img src='products/". $itemsrow['image1'] . "' width='50' alt='". $itemsrow['product_name'] . "'></td>";

echo "<td>" . $itemsrow['product_name'] . "</td>";
echo "<td>" . $itemsrow['pro_count'] . " x </td>";
echo "<td><strong>$ " . sprintf('%.2f',$itemsrow['price']) . "</strong></td>";
echo "<td><strong>$ " . sprintf('%.2f',$quantitytotal) . "</strong></td>";
echo "</tr>";
@$total = $total + $quantitytotal;


}
}
echo "<tr>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td>TOTAL</td>";
echo "<td><strong>$" . sprintf('%.2f', $total). "</strong></td>";
echo "</tr>";
     echo "</table>";                 
                      ?>

              </address>
<?php }

function s1_order_details()
{
$validid = $_GET['id'];
	require("dbConfig.php");


                      //echo "<h1>Order Details</h1>";
                      echo "<br>";
                     echo "<a  class='btn-st bordr rd-30' href='s1-orders.php'><span class='ti-arrow-left'></span> go back to the Orders List</a>";
                     echo "<br><br>";
                     $ordsql = $db->query("SELECT * from orders WHERE id = " . $validid);
//$ordres = mysql_query($ordsql);
$ordrow = $ordsql->fetch_assoc();
$ordidsql = $db->query("SELECT * FROM order_billing WHERE order_id = '". $validid ."'");
$ordidrows = $ordidsql->fetch_assoc();
//echo "<td>IM01".$ordidrows['bill_no']."</td>";
echo "<h4><strong>Order Number</strong> : " . $ordidrows['bill_no'] . "</h4>";
//echo "<h4><strong>Order Number</strong> : " . $ordrow['id'] . "</h4>";
echo "<br>";
echo "<h4><strong>Date of order</strong> : " . date('D jS F Y g.iA',strtotime($ordrow['date'])) . "</h4>";
echo "<br>";
echo "<h4><strong>Payment Type</strong> : ";
if($ordrow['payment_type'] == 1)
{
echo "PayPal";
}
else
{
echo "Stripe Payment";
}
echo "</h4>";  
$addsql1 = $db->query("SELECT * FROM logins WHERE id = " . $ordrow['customer_id']);
$addrow1 = $addsql1->fetch_assoc();      
if($ordrow['delivery_add_id'] == 0)
{
$addsql = $db->query("SELECT * FROM customers WHERE customer_id = " . $addrow1['customer_id']);
//$addres = mysql_query($addsql);
}

else
{
$addsql = $db->query("SELECT * FROM delivery_addresses WHERE id = " . $ordrow['delivery_add_id']);
//$addres = mysql_query($addsql);
}
$addrow = $addsql->fetch_assoc();
echo "<br>";
echo "<h4><strong>Address</strong> : </h4>";
echo "<p>" . $addrow['forename'] . " ". $addrow['surname'] . "<br>";
echo $addrow['add1']. ",";
echo $addrow['add2'] . ",<br>";
//echo $addrow['add3'] . "<br>";
echo $addrow['district'] . " - ". $addrow['postcode'] . ",<br>";
echo $addrow['state'] . ",". $addrow['country'] . ".<br>";
echo "<br>";
if($ordrow['delivery_add_id'] == 0)
{
echo "<i>Address from member account</i>";
echo "<br>";
}
else
{
echo "<i>Different delivery address</i>";
echo "<br>";
}
echo "</p>";
echo "<br>";
echo "<h4><strong>Phone : </strong></td><td>". $addrow['phone'] . "</h4>";
echo "<br>";
echo "<h4><strong>Email : </strong></td><td><a href='mailto:" . $addrow['email'] . "'>". $addrow['email'] . "</a></h4>";
$result = $db->query("SET NAMES utf8");//the main trick
$itemssql = $db->query("SELECT products.*, orderitems.*, orderitems.id AS itemid, sum(orderitems.quantity) as pro_count FROM products, orderitems WHERE orderitems.product_id = products.id AND orderitems.order_id = " . $validid ." And orderitems.payment_type = 1 GROUP BY products.id ORDER BY orderitems.id");
//mysqli_query($db,$itemssql);
//echo $itemssql;
//$itemssql = $db->query("SELECT products.*, orderitems.*,orderitems.id AS itemid FROM products, orderitems WHERE orderitems.product_id = products.id AND order_id = " . $validid ." And orderitems.payment_type = 1");
//$itemsres = mysql_query($itemssql);
$itemnumrows = $itemssql->num_rows;

echo "<br>";
echo "<h1>Products Purchased</h1>";

?>
<table class="cart-table table table-responsive">
                      <thead>
                        <tr>
						   <th></th>
                          <th>Product</th>
                          <th>Quantity</th>
                          <th>Price</th>
                          <th>Total</th>
                          
                        </tr>
                      </thead>
                      <?php
                      if($itemnumrows > 0){
                      while($itemsrow = $itemssql->fetch_assoc())
{
$quantitytotal = $itemsrow['price'] * $itemsrow['pro_count'];
echo "<tr>";

echo "<td><img src='products/". $itemsrow['image1'] . "' width='50' alt='". $itemsrow['product_name'] . "'></td>";

echo "<td>" . $itemsrow['product_name'] . "</td>";
echo "<td>" . $itemsrow['pro_count'] . " x </td>";
echo "<td><strong>$ " . sprintf('%.2f',$itemsrow['price']) . "</strong></td>";
echo "<td><strong>$ " . sprintf('%.2f',$quantitytotal) . "</strong></td>";
echo "</tr>";
@$total = $total + $quantitytotal;


}
}
echo "<tr>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td>TOTAL</td>";
echo "<td><strong>" . sprintf('%.2f', $total). "</strong></td>";
echo "</tr>";
     echo "</table>";                 
                      ?>

              </address>
<?php }

function coupon_order_details()
{
    $validid = $_GET['id'];
    	require("dbConfig.php");
                      echo "<h1>Order Details</h1>";
                      echo "<br>";
                     echo "<a  class='btn-st bordr rd-30' href='coupon-list.php'><span class='ti-arrow-left'></span> go back to the Coupon List</a>";
                     echo "<br><br>";
                     $ordsql = $db->query("SELECT * from orders WHERE id = " . $validid);
 //mysqli_query($ordsql);
 //echo $ordsql;
$ordrow = $ordsql->fetch_assoc();
echo "<h4><strong>Order Number</strong> : " . $ordrow['id'] . "</h4>";
echo "<br>";
echo "<h4><strong>Date of order</strong> : " . date('D jS F Y g.iA',strtotime($ordrow['date'])) . "</h4>";
echo "<br>";
echo "<h4><strong>Payment Type</strong> : ";
if($ordrow['payment_type'] == 1)
{
echo "PayPal";
}
else
{
echo "Stripe";
}
echo "</h4>";  
$addsql1 = $db->query("SELECT * FROM logins WHERE id = " . $ordrow['customer_id']);
$addrow1 = $addsql1->fetch_assoc();      
if($ordrow['delivery_add_id'] == 0)
{
$addsql = $db->query("SELECT * FROM customers WHERE customer_id = " . $addrow1['customer_id']);
//$addres = mysql_query($addsql);
}

else
{
$addsql = $db->query("SELECT * FROM delivery_addresses WHERE id = " . $ordrow['delivery_add_id']);
//$addres = mysql_query($addsql);
}
$addrow = $addsql->fetch_assoc();
echo "<br>";
echo "<h4><strong>Address</strong> : </h4>";
echo "<p>" . $addrow['forename'] . " ". $addrow['surname'] . "<br>";
echo $addrow['add1'];
echo $addrow['add2'] . "<br>";
echo $addrow['add3'] . "<br>";
echo $addrow['district'] . " - ". $addrow['postcode'] . "<br>";
echo $addrow['state'] . ",". $addrow['country'] . "<br>";
echo "<br>";
if($ordrow['delivery_add_id'] == 0)
{
echo "<i>Address from member account</i>";
echo "<br>";
}
else
{
echo "<i>Different delivery address</i>";
echo "<br>";
}
echo "</p>";
echo "<br>";
echo "<h4><strong>Phone : </strong></td><td>". $addrow['phone'] . "</h4>";
echo "<br>";
echo "<h4><strong>Email : </strong></td><td><a href='mailto:" . $addrow['email'] . "'>". $addrow['email'] . "</a></h4>";
$result = $db->query("SET NAMES utf8");//the main trick
$itemssql = $db->query("SELECT products.*, orderitems.*, orderitems.id AS itemid, sum(orderitems.quantity) as pro_count FROM products, orderitems WHERE orderitems.product_id = products.PID AND orderitems.order_id = " . $validid ." And orderitems.payment_type = 1 GROUP BY products.PID ORDER BY orderitems.id");
//mysqli_query($db,$itemssql);
//echo $itemssql;
//$itemssql = $db->query("SELECT products.*, orderitems.*,orderitems.id AS itemid FROM products, orderitems WHERE orderitems.product_id = products.id AND order_id = " . $validid ." And orderitems.payment_type = 1");
//$itemsres = mysql_query($itemssql);
$itemnumrows = $itemssql->num_rows;

echo "<br>";
echo "<h1>Products Purchased</h1>";

?>
<table class="cart-table table table-responsive">
                      <thead>
                        <tr>
						   <th></th>
                          <th>Product</th>
                          <th>Quantity</th>
                          <th>Price</th>
                          <th>Total</th>
                          
                        </tr>
                      </thead>
                      <?php
                      if($itemnumrows > 0){
                      while($itemsrow = $itemssql->fetch_assoc())
{
$quantitytotal = $itemsrow['Price'] * $itemsrow['pro_count'];
echo "<tr>";

echo "<td><img src='products/". $itemsrow['Image1'] . "' width='50' alt='". $itemsrow['Product_Title'] . "'></td>";

echo "<td>" . $itemsrow['Product_Title'] . "</td>";
echo "<td>" . $itemsrow['pro_count'] . " x </td>";
echo "<td><strong>TZs " . sprintf('%.2f',$itemsrow['Price']) . "</strong></td>";
echo "<td><strong>TZs " . sprintf('%.2f',$quantitytotal) . "</strong></td>";
echo "</tr>";
@$total = $total + $quantitytotal;

}
}
echo "<tr>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td>TOTAL</td>";
echo "<td><strong>TZs " . sprintf('%.2f', $total). "</strong>";
//echo "<br><strong><i class='fa fa-dollar'></i>" . sprintf('%.2f', $total2). "</strong></td>";
echo "</tr>";
echo "<tr>";
$customsql = $db->query("SELECT * FROM coupon_status WHERE order_id = '" . $validid ."' and customer_id = '".$ordrow['customer_id']."'");
										  $coupcheck = $customsql->num_rows;
										  $couprow = $customsql->fetch_assoc();
										  if($coupcheck == 1) {
										echo "<td></td>";
echo "<td></td>";
echo "<td></td>";	  
										 echo "<td>Coupon Applied : ".$couprow['discount']." %";
										echo "<td>Total Paid : ". $couprow['sell_price']."</td>";
	                                    } 
echo "<tr>";	                                    
     echo "</table>";  
}

?>
