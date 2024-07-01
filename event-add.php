<?php
   include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Event Add</title>
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
                                <!---<div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Zircos</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Blog</a></li>
                                        <li class="breadcrumb-item active">Add / Edit Post</li>
                                    </ol>
                                </div>-->
                                <h4 class="page-title">Add Event</h4>
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
                                            <label for="exampleInputEmail1">Title</label>
                                            <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="Enter title" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="exampleInputEmail1">Sub Title</label>
                                            <input type="text" class="form-control" name="sub_title" id="exampleInputEmail1" placeholder="Enter Sub title" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="exampleInputEmail1">Event Date</label>
                                            <input type="date" class="form-control" name="event_date" id="" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="exampleInputEmail1">Timing</label>
                                            <input type="text" class="form-control" name="timing" id="exampleInputEmail1" placeholder="10 am to 12 pm" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="exampleInputEmail1">Address</label>
                                            <input type="text" class="form-control" name="address" id="exampleInputEmail1" placeholder="Address" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="exampleInputEmail1">Contact Number</label>
                                            <input type="text" class="form-control" name="contact" id="exampleInputEmail1" placeholder="9876543210" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label>Event Image</label>
                                            <input type="file" name="file" class="form-control" data-height="210" />

                                        </div>
                                        <div class="form-group mb-4">
                                            <label>Description</label>
                                            <textarea class="form-control" name="description" rows="5" required></textarea>                                            
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="exampleInputEmail1">Status</label>
                                            <select class="form-control" name="status" required>
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
$targetDir = "events/"; 
 
if(isset($_POST["submit"])){ 
	
	$title = mysqli_real_escape_string($db,$_POST['title']);
      $sub_title = mysqli_real_escape_string($db,$_POST['sub_title']);
      $event_date = mysqli_real_escape_string($db,$_POST['event_date']);
      $timing = mysqli_real_escape_string($db,$_POST['timing']);
      $address = mysqli_real_escape_string($db,$_POST['address']);
      $contact = mysqli_real_escape_string($db,$_POST['contact']);
      $description  = mysqli_real_escape_string($db,$_POST['description']);
      $status  = mysqli_real_escape_string($db,$_POST['status']);
      
      $query = $db->query("SELECT title FROM events WHERE title='$title'");
        $count = mysqli_num_rows($query);
        
        if($count == 1) { 
			  $statusMsg = "<br><div class='alert alert-danger mb-0 text-center' role='alert'><strong>Already Exists</strong></div>";
			}
        else{
      
    if(!empty($_FILES["file"]["name"])){ 
        $fileName = basename($_FILES["file"]["name"]); 
        $targetFilePath = $targetDir . $fileName; 
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION); 
     
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            // Upload file to server 
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
                // Insert image file name into database 
                $insert = $db->query("INSERT INTO events (title, sub_title, address, event_date, timing, contact, event_image, description, status, uploaded_on) VALUES ('".$title."','".$sub_title."','".$address."','".$event_date."','".$timing."','".$contact."','".$fileName."','".$description."','".$status."', NOW())"); 
                if($insert){ 
                    $statusMsg = "<br><div class='alert alert-success text-center' role='alert'><strong>".$title. "</strong> Event  has been uploaded successfully.</div>"; 
                }else{ 
                    $statusMsg = "<br><div class='alert alert-danger mb-0 text-center' role='alert'>File upload failed, please try again.</div>"; 
                }  
            }else{ 
                $statusMsg = "<br><div class='alert alert-danger mb-0 text-center' role='alert'>Sorry, there was an error uploading your file.</div>"; 
            } 
        }else{ 
            $statusMsg = '<br><div class="alert alert-danger mb-0 text-center" role="alert">Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.</div>'; 
        } 
    }else{ 
        $statusMsg = '<br><div class="alert alert-danger mb-0 text-center" role="alert">Please select a file to upload.</div>'; 
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

