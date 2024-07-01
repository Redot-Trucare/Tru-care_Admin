<?php
   include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Table datatable css -->
    <link href="assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables/fixedHeader.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables/scroller.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables/fixedColumns.bootstrap4.min.html" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        
        <!-- Topbar Start -->
        <?php include 'top-bar.php'; ?>
        <!-- end Topbar -->
        
        <!-- ========== Left Sidebar Start ========== -->
        <?php include 'side-bar.php'; ?>
            <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
								
								<div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item active"><a href="product-add.php">Add Product</a></li>
                                    </ol>
                                </div>
                               
                                <h4 class="page-title">Orders</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <!--<h4 class="header-title"><b>Buttons example</b></h4>
                                <p class="sub-header">
                                    The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
                                </p>-->

                                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
											<th>Bill No</th>
						  <!--<th>Region</th>-->
                          <th>Order Details</th>
                          <th>Order Date</th>
                          <th>Customer Details</th>
                          <th>Amount</th>
                          <th>Payment Mode</th>                          
                          <th>Confirm the Order</th>
                          <th>Cancel the Order</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                       <?php
                                       include_once 'dbConfig.php';
						  if(isset($_GET['func']) == TRUE) {

$funcsql = "UPDATE orders SET status = 10, cancel_status = 'Confirm the order' WHERE id = " . $_GET['id'];
//mysql_query($funcsql);
mysqli_query($db, $funcsql);
//echo $funcsql;
//header("Location: product-order.php");
echo '<script type="text/javascript">
           window.location = "s1-orders.php"
      </script>';

$ordsql = $db->query("SELECT * from orders WHERE id = " . $_GET['id']);
//$ordres = mysql_query($ordsql);
$ordrow = $ordsql->fetch_assoc();
$loginsql = $db->query("SELECT * FROM logins WHERE id = " . $ordrow['customer_id']);
//mysqli_query($db,$loginsql);

$loginrow = $loginsql->fetch_assoc();
$emsql = $db->query("SELECT * FROM customers WHERE customer_id = " . $loginrow['customer_id']);
$emrow = $emsql->fetch_assoc();
/*
ini_set("SMTP","mail.gmail.com");
    ini_set("smtp_port","25");
    ini_set('sendmail_from', 'esales@vanaaboutique.com');
    
 $to = $emrow['email'];
 $subject = "Order Notification From Site";

$message  = '<html><body>';
//$message .= '<img src="images/mail.png" alt="Vanaa Boutique" />';
$message .= '<span style="font-family:Arial;font-size:10pt">';
$message .= '<br><br><div style="border-top:3px solid #264796;"></div>';	
$message .= '<h4>Dear <b>' . $emrow['forename'] .'.,</b></h4>';
$message .= '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your order in Vanaa Boutique website. Order status update to '. $ordrow['cancel_status'] .' . Thank You</p>';

$message .= '<div style="border-top:3px solid #264796"></div>';
$message .= '</span>';

$message .= '</body></html>';
 $email = "esales@vanaaboutique.com";   
 //$email = $emrow['email'];
 //$header = "From:$email";

 $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$email."\r\n".
    'Reply-To: '.$email."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
 $send = mail($to,$subject,$message,$headers);	
 */
}
else if(isset($_GET['cancel']) == TRUE){
	$cancelcsql = "UPDATE orders SET status = 3,cancel_status = 'Cancel the order' WHERE id = " . $_GET['id'];
//mysql_query($funcsql);
mysqli_query($db, $cancelcsql);

//header("Location: " . $config_basedir . "product-order.php");
echo '<script type="text/javascript">
           window.location = "product-order.php"
      </script>';

$ordsql = $db->query("SELECT * from orders WHERE id = " . $_GET['id']);
//$ordres = mysql_query($ordsql);
$ordrow = $ordsql->fetch_assoc();
$date = date("Y-m-d H:i:s");  
$itemsql2 = "INSERT INTO order_action(order_id, order_date, order_sign, order_status, login_id, update_on) VALUES ('" . $ordrow['id'] . "','" . $ordrow['date'] . "','S1','Cancel the Order','" . $_SESSION['SESS_USERNAME'] . "','$date')";
//mysql_query($funcsql);
mysqli_query($db, $itemsql2);
$loginsql = $db->query("SELECT * FROM logins WHERE id = " . $ordrow['customer_id']);
//mysqli_query($db,$loginsql);

$loginrow = $loginsql->fetch_assoc();
$emsql = $db->query("SELECT * FROM customers WHERE customer_id = " . $loginsql['customer_id']);
$emrow = $emsql->fetch_assoc();
/*
ini_set("SMTP","mail.gmail.com");
    ini_set("smtp_port","25");
    ini_set('sendmail_from', 'esales@vanaaboutique.com');
    
 $to = $emrow['email'];
 $subject = "Order Notification From Site";
 

$message  = '<html><body>';
//$message .= '<img src="images/mail.png" alt="Vanaa Boutique" />';
$message .= '<span style="font-family:Arial;font-size:10pt">';
$message .= '<br><br><div style="border-top:3px solid #264796;"></div>';	
$message .= '<h4>Dear <b>' . $emrow['forename'] .'.,</b></h4>';
$message .= '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your order in Vanaa Boutique. Order status update to '. $ordrow['cancel_status'] .' . Thank You</p>';

$message .= '<div style="border-top:3px solid #264796"></div>';
$message .= '</span>';

$message .= '</body></html>';   
 //$email = $emrow['email'];
 $email = "esales@vanaaboutique.com";
 //$header = "From:$email";

 $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$email."\r\n".
    'Reply-To: '.$email."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
 $send = mail($to,$subject,$message,$headers);	
 */
	}
else {
//require("header.php");
//echo "<h2><a href='product-order.php'>Outstanding orders</a></h2>";
//echo"<br>";
/*echo "<div class='buttons'><ul class='buttons-lst'><li><a class='btn-st rd-30'href='product-confirm-orders.php'><span class='ti-arrow-right'></span> Confirm orders</a></li>
     <li><a class='btn-st rd-30 'href='product-cancel-orders.php'><span class='ti-arrow-right'></span> Cancel orders</a></li></ul></div>";
echo "<br><br><br><br>";*/
$orderssql = $db->query("SELECT * FROM orders WHERE status = 1 and cancel_status= 'S1' ORDER BY id Asc");
//$ordersres = mysql_query($orderssql);
$numrows = $orderssql->num_rows;
if($numrows > 0)
{
//echo "<table cellspacing=10>";
while($row = $orderssql->fetch_assoc())
{
echo "<tr>";
//echo "<td>#".$row['id']."</td>";
$ordidsql = $db->query("SELECT * FROM order_billing WHERE order_id = '". $row['id'] ."'");
$ordidrows = $ordidsql->fetch_assoc();
echo "<td>".$ordidrows['bill_no']."</td>";
$regsql = $db->query("SELECT * FROM orderitems WHERE order_id = '" .$row['id']. "' AND customer_id = '" .$row['customer_id']. "' AND payment_type= '1'");
$regrow = $regsql->fetch_assoc();

	if($regrow['currency'] == 'INR'){
	echo "<td>India</td>";
	}
	if($regrow['currency'] == 'USD'){
	echo "<td>International</td>";
	}

//echo "<td>".$row['Region']."</td>";
echo "<td><a href='s1-order-details.php?id=" . $row['id']. "'>View</a></td>";
echo "<td>". date("D jS F Y g.iA", strtotime($row['date'])). "</td>";
   $loginsql = $db->query("SELECT * FROM logins WHERE id = " . $row['customer_id']);
//mysqli_query($db,$loginsql);

$loginrow = $loginsql->fetch_assoc();
   $emsql = $db->query("SELECT * FROM customers WHERE customer_id = " . $loginrow['customer_id']);
$emrow = $emsql->fetch_assoc(); 
echo "<td>".$emrow['forename'] ." ".$emrow['surname'] ."";
echo "<br>".$emrow['phone'] ."";
echo "<br>".$emrow['email'] ."</td>";
echo "<td>" . sprintf($row['total']) . "</td>";
echo "<td>";
if($row['payment_type'] == 2)
{
echo "Stripe Payment";
}
else
{
echo "Payment";
}
echo "</td>";
//echo "<td><a href='product-order.php?func=conf&id=" . $row['id']. "'><i class='fa fa-pencil'></i> Confirm</a></td>";
echo "<td><form action='s1-confirm-order.php' method='POST'>";
echo "<input type='hidden' name='order_id' value='".$row['id']."'>&nbsp;";
echo "<input type='hidden' name='customer_id' value='".$row['customer_id']."'>&nbsp;";
echo "<input type='text' name='payment_id' placeholder='Payment ID'  class='form-control'>&nbsp;";
echo "<button type='submit' name='submit' style='background: rgba(0, 0, 0, 0) linear-gradient(-135deg, #272c33 0%, #00abe1 100%) repeat scroll 0 0;
border: medium none;
border-radius: 4px;
color: #ffffff;
float: left;
font-size: 13px;
padding: 10px 25px; margin-top:2px;'>Confirm</button>";
echo "</form></td>";
echo "<td><a href='s1-orders.php?cancel=conf&id=" . $row['id']. "'><i class='fa fa-trash'></i> Cancel</a></td>";

echo "</tr>";
}

}

}
?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    
                   

                       

                    

                </div>
                <!-- end container-fluid -->

            </div>
            <!-- end content -->

            

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            2024 &copy; <a href="#">Skin Care</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    
    <!-- /Right-bar -->

   

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- Datatable plugin js -->
    <script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>

    <script src="assets/libs/datatables/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables/buttons.bootstrap4.min.js"></script>

    <script src="assets/libs/datatables/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables/buttons.print.min.js"></script>

    <script src="assets/libs/datatables/dataTables.keyTable.min.js"></script>
    <script src="assets/libs/datatables/dataTables.fixedHeader.min.js"></script>
    <script src="assets/libs/datatables/dataTables.scroller.min.js"></script>
    <script src="assets/libs/datatables/dataTables.fixedColumns.min.html"></script>

    <script src="assets/libs/jszip/jszip.min.js"></script>
    <script src="assets/libs/pdfmake/pdfmake.min.js"></script>
    <script src="assets/libs/pdfmake/vfs_fonts.js"></script>

    <!-- Datatables init -->
    <script src="assets/js/pages/datatables.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>
</html>
