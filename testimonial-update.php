<?php
   include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Testimonial Update</title>
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
                                        <li class="breadcrumb-item"><a href="testimonials.php">Testimonials</a></li>
                                        <li class="breadcrumb-item active"> Edit Testimonial</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Testimonial Update</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="card-box">
                                <div class="">
									<?php
									include_once 'dbConfig.php'; 
									$test_id = $_GET['id'];
									$sql = "select * from testimonials where id='$test_id'";

$result = $db->query($sql);

if ($result->num_rows > 0){

$row = $result->fetch_assoc();

$username = $row["username"];
$profile = $row["profile"];
$feedback = $row["feedback"];
$image = $row["image"];
//$description = $row["description"];
									?>
                                    <form action="" method="post" enctype="multipart/form-data">
										<input type="hidden" name="testi_id" value='<?php echo $test_id;?>'>
										<div class="form-group mb-4">
                                            <label>Image</label>
                                            <input type="file" name="image_file" value="<?php echo $image; ?>" class="form-control" data-height="210" />
                                            <br><img src="testimonials/<?php echo $image; ?>" width="50%" height="50%">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="exampleInputEmail1">User name</label>
                                            <input type="text" class="form-control" name="username" id="exampleInputEmail1" value="<?php echo $username; ?>">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="exampleInputEmail1">Profile</label>
                                            <input type="text" class="form-control" name="profile" id="exampleInputEmail1" value="<?php echo $profile; ?>">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label>Feedback</label>
                                            <textarea class="form-control" name="feedback" rows="5"><?php echo $feedback; ?></textarea>                                            
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="exampleInputEmail1">Status</label>
                                            <select class="form-control" name="status">
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>                                                        
                                               </select>
                                        </div>
                                        
                                        <button type="submit" name="submit" class="btn btn-success waves-effect waves-light mr-1">Update</button>
                                        <!--<button type="button" class="btn btn-danger waves-effect waves-light">Discard</button>-->
                                    </form>
                                    <?php 
								}
// Include the database configuration file 
include_once 'dbConfig.php'; 
 
$statusMsg = ''; 
 
// File upload directory 
$targetDir = "blogs/"; 
 
if(isset($_POST["submit"])){ 
	$testi_id = mysqli_real_escape_string($db,$_POST['testi_id']);
	$username = mysqli_real_escape_string($db,$_POST['username']);
      $profile = mysqli_real_escape_string($db,$_POST['profile']);
      $feedback  = mysqli_real_escape_string($db,$_POST['feedback']);
      $status  = mysqli_real_escape_string($db,$_POST['status']);
      
      
                $insert = $db->query("Update testimonials set username = '".$username."', profile = '".$profile."',feedback = '".$feedback."',status = '".$status."', uploaded_on = NOW() WHERE id ='".$testi_id."'"); 
                if($insert){ 
                    $statusMsg = "<br><div class='alert alert-success text-center' role='alert'><strong>".$username. "</strong> Feedback has been updated successfully.</div>"; 
                }else{ 
                    $statusMsg = "<br><div class='alert alert-danger mb-0 text-center' role='alert'>File upload failed, please try again.</div>"; 
                }
                if(!empty($_FILES['image_file']['tmp_name'])){
    $name=$_FILES["image_file"]["name"];
    $type=$_FILES["image_file"]["type"];
    $size=$_FILES["image_file"]["size"];
    $temp=$_FILES["image_file"]["tmp_name"];
    $error=$_FILES["image_file"]["error"];
    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

        $permissible_extension = array('jpg','png','jpeg','gif','JPG','pdf','PDF');
        if(in_array($ext, $permissible_extension)){
            if(move_uploaded_file($temp,"testimonials/".$name)){
                $sql1 = $db->query("Update testimonials Set image = '$name' Where id = '$testi_id'");
			}
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
