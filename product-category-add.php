<?php
   include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Product Category Add</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Plugins css -->
    <link href="assets/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" />

    <link href="assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <!-- Summernote css -->
    <link href="assets/libs/summernote/summernote-bs4.css" rel="stylesheet" type="text/css" />

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
                                        <li class="breadcrumb-item"><a href="product-category.php">Product Categories</a></li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Add Product Category</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="card-box">
                                <div class="">
                                    <form action="" method="post" enctype="multipart/form-data">
										<div class="form-group mb-4">
                                            <label for="exampleInputEmail1">Category Name</label>
                                            <input type="text" class="form-control" name="category_name" id="" placeholder="Enter Category" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="exampleInputEmail1">Status</label>
                                            <select class="form-control" name="status">
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>                                                        
                                                    </select>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-success waves-effect waves-light mr-1">Save</button>
                                        <!--<button type="button" class="btn btn-danger waves-effect waves-light">Discard</button>-->
                                    </form>
                                    <?php 
// Include the database configuration file 
include_once 'dbConfig.php'; 
 
$statusMsg = ''; 
 
// File upload directory 
//$targetDir = "courses/"; 
 
if(isset($_POST["submit"])){ 
	$category_name = mysqli_real_escape_string($db,$_POST['category_name']);
      $status  = mysqli_real_escape_string($db,$_POST['status']);
      
      $query = $db->query("SELECT category_name FROM product_category WHERE category_name = '$category_name'");
        $count = mysqli_num_rows($query);
        
        if($count == 1) { 
			  $statusMsg = "<br><div class='alert alert-danger mb-0 text-center' role='alert'><strong>Already Exists</strong></div>";
			}
        else{
       
                // Insert image file name into database 
                $insert = $db->query("INSERT INTO product_category (category_name, status, uploaded_on) VALUES ('".$category_name."','".$status."', NOW())"); 
                if($insert){ 
                    $statusMsg = "<br><div class='alert alert-success text-center' role='alert'><strong>".$category_name. "</strong> has been uploaded successfully.</div>"; 
                }else{ 
                    $statusMsg = "<br><div class='alert alert-danger mb-0 text-center' role='alert'>File upload failed, please try again.</div>"; 
                }  
  }          
} 
// Display status message 
echo $statusMsg; 

?>
                                </div>
                            </div>
                            <!-- end p-20 -->
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

    

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <script src="assets/libs/select2/select2.min.js"></script>

    <!-- Summernote js -->
    <script src="assets/libs/summernote/summernote-bs4.min.js"></script>

    <!-- Plugins js -->
    <script src="assets/libs/dropify/dropify.min.js"></script>

    <script src="assets/js/pages/blog-add.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>
</html>
