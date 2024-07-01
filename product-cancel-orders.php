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
                                        <li class="breadcrumb-item active"><a href="product-orders.php">Product Orders</a></li>
                                    </ol>
                                </div>
                               
                                <h4 class="page-title">Cancel Orders</h4>
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
                          <th>Uploaded on</th>
                          <th>Valid Customer</th>
                          <th>Price</th>
                          <th>Payment Type</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                       <?php
                                       include_once 'dbConfig.php';
						  if(isset($_GET['func']) == TRUE) {

$funcsql = "UPDATE orders SET status = 10, cancel_status = 'Confirm the order' WHERE id = " . $_GET['id'];
//mysql_query($funcsql);
mysqli_query($db, $funcsql);
header("Location: " . $config_basedir . "product-order.php");
}
else if(isset($_GET['cancel']) == TRUE){
	$cancelcsql = "UPDATE orders SET cancel_status = 'Cancel the order' WHERE id = " . $_GET['id'];
//mysql_query($funcsql);
mysqli_query($db, $cancelcsql);

header("Location: " . $config_basedir . "product-order.php");
	}
else {
//require("header.php");
//echo "<h3><a href='product-order.php'>Outstanding orders</a></h3>";
/*echo "<a class='btn-st bordr rd-30' href='product-order.php'><span class='ti-arrow-left'></span> go back to the Products orders </a>";
echo"<br><br>";
echo "<h2><a href='product-confirm-orders.php'>Cancel orders</a></h2>";
echo"<br>";*/
$orderssql = $db->query("SELECT * FROM orders WHERE status = 3 And cancel_status = 'Cancel the order' ORDER BY id Desc");
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
echo "<td><a href='order-details.php?id=" . $row['id']. "'>View</a></td>";
echo "<td>". date("D jS F Y g.iA", strtotime($row['date'])). "</td>";
echo "<td>";
if($row['registered'] == 3)
{
echo "Reg Customer";
}
else
{
echo "Non-Reg Customer";
}
echo "</td>";
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
echo "</td>";
//echo "<td><a href='product-order.php?cancel=conf&id=" . $row['id']. "'><i class='icon-trash'></i>Cancel</a></td>";
//echo "<td><a href='product-order.php?func=conf&id=" . $row['id']. "'><i class='icon-pencil'></i>Confirm</a></td>";
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
