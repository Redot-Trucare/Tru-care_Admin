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
                               
                                <h4 class="page-title">Confirm Orders</h4>
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
											<th>Bill No </th>
                          <th>Order Details</th>
                          <th>Order Date</th>
                          <th>Customer Details</th>
                          <th>Amount</th>
                          <th>Payment Type</th>
                          <th>Delivery ID</th>
                          <!--<th>Delivery Date</th>-->
                                        </tr>
                                    </thead>

                                    <tbody>
                                       <?php
                                       include_once 'dbConfig.php';
						  //require("header.php");
//echo "<h3><a href='product-order.php'>Outstanding orders</a></h3>";
/*echo "<a class='btn-st bordr rd-30' href='product-order.php'><span class='ti-arrow-left'></span> go back to the Products orders </a>";
echo"<br><br>";
echo "<h2><a href='product-confirm-orders.php'>Confirm orders</a></h2>";
echo"<br>";*/
$orderssql = $db->query("SELECT * FROM orders WHERE status = 10 Or status = 12 ORDER BY id Desc");
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
echo "<td><a href='confirm-order-details.php?id=" . $row['id']. "'>View</a></td>";
echo "<td>". date("D jS F Y g.iA", strtotime($row['date'])). "</td>";
 $loginsql = $db->query("SELECT * FROM logins WHERE id = " . $row['customer_id']);
//mysqli_query($db,$loginsql);

$loginrow = $loginsql->fetch_assoc();
   $emsql = $db->query("SELECT * FROM customers WHERE customer_id = " . $loginrow['customer_id']);
$emrow = $emsql->fetch_assoc(); 
echo "<td>".$emrow['forename'] ." ".$emrow['surname'] ."";
echo "<br>".$emrow['phone'] ."";
echo "<br>".$emrow['email'] ."</td>";
echo "<td>$" . sprintf('%.2f',$row['total']) . "</td>";
echo "<td>";
if($row['payment_type'] == 2)
{
echo "COD";
}
else
{
echo "Cash On Delivery";
}
$delsql = $db->query("SELECT * FROM orderitems WHERE order_id = " . $row['id'] ." And payment_type = 1");
//$itemsres = mysql_query($itemssql);
$delnumrows = $delsql->fetch_assoc();
if($delnumrows['delivery_id'] == ''){
echo "<td><form action='order-dispatch.php' method='POST'>";
echo "<input type='hidden' name='order_id' value='".$row['id']."'>&nbsp;";
echo "<select name='courier_name' id='courier_name' placeholder='Courier Name' class='form-control'>
<option>Select Courier</option>";
require("dbConfig.php");
$cournsql = $db->query("SELECT * FROM couriers WHERE status = 'Active'");
$courenrows = $cournsql->num_rows;
if($courenrows > 0)
{
while($cournrows = $cournsql->fetch_assoc())
{
	echo "<option value='".$cournrows['name']."'>".$cournrows['name']."</option>";
}
}
echo "</select>&nbsp;";
 ?>
  <script type="text/javascript" src="jquery.min.js"></script>
<script>
	$(document).ready(function() {
	$("#courier_name").change(function() {
		var courier_name = $(this).val();
		//var staff_id = $("#staff_id").val();
		if(courier_name != "") {
			$.ajax({
				url:"get-couier-url.php",
				data:{c_n:courier_name},
				type:'POST',
				success:function(response) {
					var resp = $.trim(response);
					$("#courier_url").html(resp);
				}
			});
		} else {
			$("#courier_url").html("<option>No Data</option>");
		}
	});
});
</script>

<?php
echo "<select name='courier_url' id='courier_url' placeholder='Courier Url' class='form-control'>
<option>Courier Url</option>";
echo "</select>&nbsp;";
echo "<input type='text' name='delivery_id' placeholder='Delivery ID'  class='form-control'>&nbsp;";
echo "<button type='submit' name='submit' style='background: rgba(0, 0, 0, 0) linear-gradient(-135deg, #272c33 0%, #00abe1 100%) repeat scroll 0 0;
border: medium none;
border-radius: 4px;
color: #ffffff;
float: left;
font-size: 13px;
padding: 10px 25px; margin-top:2px;'>Submit</button>";
echo "</form></td>";
}
else {
echo "<td>". $delnumrows['delivery_id'] ."</td>";
}
echo "</tr>";
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
