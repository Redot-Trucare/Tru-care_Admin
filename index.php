
<?php
   include('session.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Dashboard </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

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
        
        <?php include 'side-bar.php'; ?>

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
                                <!--<div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Zircos</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard </a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </div>-->
                                <h4 class="page-title">Dashboard</h4>
                                <h1>Welcome <?php echo $login_session; ?></h1>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <!--<div class="col-lg-6 col-xl-3">
                            <div class="card widget-box-three">
                                <div class="card-body">
                                    <div class="float-right mt-2">
                                        <i class="mdi mdi-layers display-3 m-0"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="text-uppercase font-weight-medium text-truncate mb-2"><a href="products.php">Products</a></p>
                                        <?php /* $sql = "select * from products";
                                        $result = mysqli_query($db,$sql);
                                        $rowcount = mysqli_num_rows($result);*/
                                        ?>
                                        <h2 class="mb-0"><span data-plugin="counterup"><?php //echo $rowcount; ?></span></h2>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <!-- end col -->
                        
                        <div class="col-lg-6 col-xl-3">
                            <div class="card widget-box-three">
                                <div class="card-body">
                                    <div class="float-right mt-2">
                                        <i class="mdi mdi-layers display-3 m-0"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="text-uppercase font-weight-medium text-truncate mb-2"><a href="services.php">Services</a></p>
                                        <?php $sql3 = "select * from services";
                                        $result3 = mysqli_query($db,$sql3);
                                        $rowcount3 = mysqli_num_rows($result3);
                                        ?>
                                        <h2 class="mb-0"><span data-plugin="counterup"><?php echo $rowcount3; ?></span></h2>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                        
                        <div class="col-lg-6 col-xl-3">
                            <div class="card widget-box-three">
                                <div class="card-body">
                                    <div class="float-right mt-2">
                                        <i class="mdi mdi-layers display-3 m-0"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="text-uppercase font-weight-medium text-truncate mb-2"><a href="blogs.php">Blogs</a></p>
                                        <?php $sql = "select * from blog";
                                        $result2 = mysqli_query($db,$sql);
                                        $rowcount2 = mysqli_num_rows($result2);
                                        ?>
                                        <h2 class="mb-0"><span data-plugin="counterup"><?php echo $rowcount2; ?></span></h2>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                        
                        <!--<div class="col-lg-6 col-xl-3">
                            <div class="card widget-box-three">
                                <div class="card-body">
                                    <div class="float-right mt-2">
                                        <i class="mdi mdi-google-pages display-3 m-0"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="text-uppercase font-weight-medium text-truncate mb-2"><a href="events.php">Events</a></p>
                                        <?php $sql = "select * from events";
                                        $result4 = mysqli_query($db,$sql);
                                        $rowcount4 = mysqli_num_rows($result4);
                                        ?>
                                        <h2 class="mb-0"><span data-plugin="counterup"><?php echo $rowcount4; ?></span></h2>
                                    </div>

                                </div>
                            </div>
                        </div>-->
                        <!-- end col -->
                        
                        <div class="col-lg-6 col-xl-3">
                            <div class="card widget-box-three">
                                <div class="card-body">
                                    <div class="float-right mt-2">
                                        <i class="mdi mdi-account-convert display-3 m-0"></i>
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="text-uppercase font-weight-medium text-truncate mb-2"><a href="testimonials.php">Testimonials</a></p>
                                        <?php $sql4 = "select * from testimonials";
                                        $result4 = mysqli_query($db,$sql4);
                                        $rowcount4 = mysqli_num_rows($result4);
                                        ?>
                                        <h2 class="mb-0"><span data-plugin="counterup"><?php echo $rowcount4; ?></span></h2>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                        
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

    <!-- Right bar overlay-->


    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <script src="assets/libs/morris-js/morris.min.js"></script>
    <script src="assets/libs/raphael/raphael.min.js"></script>

    <script src="assets/js/pages/dashboard.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>
</html>
