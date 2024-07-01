<?php
   include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Course Update</title>
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
                                        <li class="breadcrumb-item"><a href="courses.php">Courses</a></li>
                                        <li class="breadcrumb-item active">Edit Course</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Course Update</h4>
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
									$cou_id = $_GET['id'];
									$sql = "select * from courses where id='$cou_id'";

$result = $db->query($sql);

if ($result->num_rows > 0){

$row = $result->fetch_assoc();

$category_name = $row["category_name"];
$title = $row["title"];
$sub_title = $row["sub_title"];
$instructor = $row["instructor"];
$cou_image = $row["cou_image"];
$short_description = $row["short_description"];
$description = $row["description"];
$meta_title = $row["meta_title"];
$meta_description = $row["meta_desc"];
$meta_link = $row["meta_link"];
$meta = $row["meta"];
									?>
                                    <form action="" method="post" enctype="multipart/form-data">
										<input type="hidden" name="course_id" value='<?php echo $cou_id;?>'>
                                        <div class="form-group mb-4">
                                            <label for="exampleInputEmail1">Category</label>
                                            <select class="form-control" name="category_name">
												<option value="<?php echo $category_name;?>"><?php echo $category_name;?></option>
												<?php
									include_once 'dbConfig.php'; 
									//$blo_id = $_GET['id'];
									$sql = $db->query("select * from course_category");
									if($sql->num_rows>0){
                                    while($row = $sql->fetch_assoc()){ ?>
                                                        <option value="<?php echo $row['category_name'];?>"><?php echo $row['category_name'];?></option>
                                        <?php } }?>                                                                      
                                                    </select>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="exampleInputEmail1">Title</label>
                                            <input type="text" class="form-control" name="title" id="exampleInputEmail1" value="<?php echo $title; ?>">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="exampleInputEmail1">Sub Title</label>
                                            <input type="text" class="form-control" name="sub_title" id="exampleInputEmail1" value="<?php echo $sub_title; ?>">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="exampleInputEmail1">Instructor</label>
                                            <input type="text" class="form-control" name="instructor" id="" placeholder="" value="<?php echo $instructor; ?>">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label>Course Image</label>
                                            <input type="file" name="image_file" value="<?php echo $image_file; ?>" class="form-control" data-height="210" />
                                            <br><img src="courses/<?php echo $cou_image; ?>" width="50%" height="50%">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label>Short Description</label>
                                            <textarea class="form-control" name="short_description" rows="5"><?php echo $short_description; ?></textarea>                                            
                                        </div>
                                        <div class="form-group mb-4">
                                            <label>Description</label>
                                            <textarea class="form-control" name="description" rows="5"><?php echo $description; ?></textarea>                                            
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="exampleInputEmail1">Meta Title</label>
                                            <input type="text" class="form-control" name="meta_title" id="" placeholder="" value="<?php echo $meta_title; ?>">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label>Meta Description</label>
                                            <textarea class="form-control" name="meta_description" rows="5"><?php echo $meta_description; ?></textarea>                                            
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="exampleInputEmail1">Meta Link</label>
                                            <input type="text" class="form-control" name="meta_link" id="" placeholder="" value="<?php echo $meta_link; ?>">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label>Meta</label>
                                            <textarea class="form-control" name="meta" rows="5"><?php echo $meta; ?></textarea>                                            
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
$targetDir = "courses/"; 
 
if(isset($_POST["submit"])){ 
	$course_id = mysqli_real_escape_string($db,$_POST['course_id']);
	$category_name = mysqli_real_escape_string($db,$_POST['category_name']);
	$title = mysqli_real_escape_string($db,$_POST['title']);
      $sub_title = mysqli_real_escape_string($db,$_POST['sub_title']);
       $instructor = mysqli_real_escape_string($db,$_POST['instructor']);
       $short_description  = mysqli_real_escape_string($db,$_POST['short_description']);
      $description  = mysqli_real_escape_string($db,$_POST['description']);
       $meta_title  = mysqli_real_escape_string($db,$_POST['meta_title']);
      $meta_description  = mysqli_real_escape_string($db,$_POST['meta_description']);
      $meta_link  = mysqli_real_escape_string($db,$_POST['meta_link']);
      $meta  = mysqli_real_escape_string($db,$_POST['meta']);
      $status  = mysqli_real_escape_string($db,$_POST['status']);
      
      $query = $db->query("SELECT title FROM courses WHERE title='$title'");
        $count = mysqli_num_rows($query);
        
        /*if($count == 1) { 
			  $statusMsg = "<br><div class='alert alert-danger mb-0 text-center' role='alert'><strong>Already Exists</strong></div>";
			}
        else{*/
                // Insert image file name into database 
                $insert = $db->query("Update courses set category_name = '".$category_name."',title = '".$title."', sub_title = '".$sub_title."', instructor ='".$instructor."', short_description = '".$short_description."', description = '".$description."', meta_title = '".$meta_title."', meta_desc = '".$meta_description."', meta_link = '".$meta_link."', meta = '".$meta."', status = '".$status."', uploaded_on = NOW() WHERE id ='".$course_id."'"); 
                if($insert){ 
                    $statusMsg = "<br><div class='alert alert-success text-center' role='alert'><strong>".$title. "</strong> has been updated successfully.</div>"; 
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
            if(move_uploaded_file($temp,"Courses/".$name)){
                $sql1 = $db->query("Update courses Set cou_image = '$name' Where id = '$course_id'");
			}
		}
     }
} 
//} 
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
