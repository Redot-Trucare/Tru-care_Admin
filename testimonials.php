<?php
   include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Testimonials</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Tablesaw css -->
    <link href="assets/libs/tablesaw/tablesaw.css" rel="stylesheet" type="text/css" />

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
                                        <li class="breadcrumb-item active"><a href="testimonial-add.php">Add Testimonial</a></li>
                                    </ol>
                                </div>
                               
                                <h4 class="page-title">Testimonials</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">

                                <!--s<h4 class="header-title"><b>Column Toggle Table</b></h4>
                                <p class="sub-header">
                                    The Column Toggle Table allows the user to select which columns they want to be visible.
                                </p>-->

                                <table class="tablesaw table mb-0" data-tablesaw-mode="columntoggle">
                                    <thead>
                                        <tr>
											<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1">S.NO</th>
                                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Feedback</th>
                                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3">User name</th>
                                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Profile</th>
                                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1">Status</th>
                                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Update / Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
									include_once 'dbConfig.php'; 
									//$blo_id = $_GET['id'];
									$sql = $db->query("select * from testimonials");
									$count = 0;
									if($sql->num_rows>0){
                                    while($row = $sql->fetch_assoc()){ ?>
                                        <tr>
											<td><?php echo ++$count;?></td>
											<td><?php echo $row['feedback'];?></td>
                                            <td><img src="testimonials/<?php echo $row['image'];?>" width="100%"><br>
                                                <?php echo $row['username'];?></td>
                                            <td><?php echo $row['profile'];?></td>
                                            <td><?php echo $row['status'];?></td>
                                            <td><a href="testimonial-update.php?id=<?php echo $row['id'];?>"><i class="fas fa-edit"></i></a> / <a href="testimonial-delete.php?id=<?php echo $row['id'];?>"><i class="fas fa-trash"></i></a></td>                                                                                        
                                        </tr>
                                        <?php } }?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    

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

    
        <!-- Tablesaw js -->
    <script src="assets/libs/tablesaw/tablesaw.js"></script>

    <!-- Init js -->
    <script src="assets/js/pages/tablesaw.init.js"></script>s

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>
</html>
