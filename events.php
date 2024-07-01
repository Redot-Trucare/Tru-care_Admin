<?php
   include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Events</title>
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
    <link href="assets/libs/datatables/fixedColumns.bootstrap4.min.php" rel="stylesheet" type="text/css" />

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
                                        <li class="breadcrumb-item active"><a href="event-add.php">Add Event</a></li>
                                    </ol>
                                </div>
                               
                                <h4 class="page-title">Events</h4>
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
											<th>S.No</th>
                                            <th>Title</th>
                                            <th>Date/Time</th>
                                            <th>Address</th>                                            
                                            <th>Event Details</th>
                                            <th>Status</th>
                                            <th>Update / Delete</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
									include_once 'dbConfig.php'; 
									//$blo_id = $_GET['id'];
									$sql = $db->query("select * from events ORDER BY id DESC");
									$count = 0;
									if($sql->num_rows>0){
                                    while($row = $sql->fetch_assoc()){ ?>
                                        <tr>
											<td><?php echo ++$count;?></td>
                                            <td><?php echo $row['title'];?></td>
                                            <td><?php $date_str = $row['event_date'];
                                	          $timestamp = strtotime($date_str);
                                	          $formatted_date = date('F d, Y', $timestamp);
                                	          echo $formatted_date; ?> / <?php echo $row['timing'];?></td>
                                            <td><?php echo $row['address'];?></td>                                            
                                            <td><a href="event-details.php?id=<?php echo $row['id'];?>"><i class="fas fa-link"></i></a></td>
                                            <td><?php echo $row['status'];?></td>
                                            <td><a href="event-update.php?id=<?php echo $row['id'];?>"><i class="fas fa-edit"></i></a> / <a href="event-delete.php?id=<?php echo $row['id'];?>"><i class="fas fa-trash"></i></a></td>
                                        </tr>
                                        <?php } }?>
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
                            2023 &copy; <a href="#">Redot Academy</a>
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

    <script src="assets/libs/datatables/buttons.php5.min.js"></script>
    <script src="assets/libs/datatables/buttons.print.min.js"></script>

    <script src="assets/libs/datatables/dataTables.keyTable.min.js"></script>
    <script src="assets/libs/datatables/dataTables.fixedHeader.min.js"></script>
    <script src="assets/libs/datatables/dataTables.scroller.min.js"></script>
    <script src="assets/libs/datatables/dataTables.fixedColumns.min.php"></script>

    <script src="assets/libs/jszip/jszip.min.js"></script>
    <script src="assets/libs/pdfmake/pdfmake.min.js"></script>
    <script src="assets/libs/pdfmake/vfs_fonts.js"></script>

    <!-- Datatables init -->
    <script src="assets/js/pages/datatables.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>
</html>
