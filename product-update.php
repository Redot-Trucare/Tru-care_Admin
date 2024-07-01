<?php
   include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Product Update</title>
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
                                        <li class="breadcrumb-item"><a href="products.php">Products</a></li>
                                        <li class="breadcrumb-item active"> Edit Products</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Product Update</h4>
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
									$blo_id = $_GET['id'];
									$sql = "select * from products where id='$blo_id'";

$result = $db->query($sql);

if ($result->num_rows > 0){

$row = $result->fetch_assoc();

$sku = $row["sku_id"];

$category = $row["category_name"];
$product_name = $row["product_name"];
$image1 = $row["image1"];
$image2 = $row["image2"];
$price = $row["price"];
$description = $row["description"];
$stock = $row["Stock"];	
$Product_Status = $row["Product_Status"];	
									?>
                                    <form action="" method="post" enctype="multipart/form-data">
										<input type="hidden" name="pro_id" value='<?php echo $blo_id;?>'>
										<div class="row">
                                        <div class="col-lg-4 form-group mb-4">
                                            <label for="exampleInputEmail1">SKU <span>*</span></label>
                                            <input type="text" class="form-control" name="sku" id="exampleInputEmail1" value="<?php echo $sku; ?>" readonly>
                                        </div>
                                        <div class="col-lg-4 form-group mb-4">
                                            <label for="exampleInputEmail1">Category <span>*</span></label>
                                             <select class="form-control" placeholder="Category" name="main_category" id="main_category" required>
                                                    <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                                                    <option value="">Select Category</option>
                                                    <?php
// Include the database configuration file
require_once('dbConfig.php');

$query = "SELECT distinct category_name from product_category WHERE status = 'Active' ORDER BY category_name Asc";

$res = mysqli_query($db,$query);
//echo $query;
?>
<?php
if($res->num_rows > 0){
    while($row = $res->fetch_assoc()){
		$category_name = $row["category_name"];
?>
<option value="<?php echo $category_name; ?>"><?php echo ucwords($category_name); ?></option>

                <?php } } ?>
                                                </select>
                                        </div>
                                        <div class="col-lg-4 form-group mb-4">
                                            <label for="exampleInputEmail1">Product Name <span>*</span></label>
                                            <input type="text" class="form-control" name="name" id="" value="<?php echo $product_name; ?>" required>
                                        </div>
                                        </div>
                                        <div class="row"> 
                                        <div class="col-lg-6 form-group mb-4">
                                            <label>Front Image (jpg , png, jpeg)</label>
                                            <input type="file" name="image_file" value="<?php echo $image1; ?>" class="form-control" data-height="210" />
                                             <br><img src="products/<?php echo $image1; ?>" width="50%" height="50%">
                                        </div>
                                        <div class="col-lg-6 form-group mb-4">
                                            <label>Back Image (jpg , png, jpeg)</label>
                                            <input type="file" name="image_file2" value="<?php echo $image2; ?>"class="form-control" data-height="210" />
                                            <br><img src="products/<?php echo $image2; ?>" width="50%" height="50%">
                                        </div>
                                        </div>
                                        <div class="row">
                                         <div class="col-lg-6 form-group mb-4">
                                            <label for="exampleInputEmail1">MRP Price<span>*</span></label>
                                            <input type="text" class="form-control" name="mrp_price" id="mrp_price" value="<?php echo $price; ?>" required>
                                        </div>
                                        <div class="col-lg-6 form-group mb-4">
                                            <label for="exampleInputEmail1">Stock<span>*</span></label>
                                            <input type="text" class="form-control" name="stock" id="stock" value="<?php echo $stock; ?>" required>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-lg-12 form-group mb-4">
                                            <label>Description<span>*</span></label>
                                            <textarea class="form-control" name="description" rows="5" required><?php echo $description; ?></textarea>                                            
                                        </div>
                                        <div class="col-lg-12 form-group mb-4">
                                            <label for="exampleInputEmail1">Product Status<span>*</span></label>
                                            <select class="form-control" name="product_status" required>
												        <option value="<?php echo $Product_Status; ?>"><?php echo $Product_Status; ?></option>
												        <option value="Active">Select Product Status</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>                                                        
                                            </select>
                                        </div>
                                        </div>
                                       
                                        <button type="submit" name="submit" class="btn btn-success waves-effect waves-light mr-1">Update</button>
                                        <!--<button type="button" class="btn btn-danger waves-effect waves-light">Discard</button>-->
                                    </form>
                                    <?php 
								}

//ini_set( 'display_errors', 1 );
  // error_reporting( E_ALL );
 error_reporting(E_ERROR);
    // Include the database configuration file
    if(isset($_POST['submit'])){
include 'dbConfig.php';
$statusMsg = '';

// File upload path
$targetDir = "Products/";
$pro_id = mysqli_real_escape_string($db,$_POST['pro_id']);
$file_sku = mysqli_real_escape_string($db, $_POST["sku"]);
$file_main_category = mysqli_real_escape_string($db, $_POST["main_category"]);
$file_sub_category = mysqli_real_escape_string($db, $_POST["sub_category"]);
$file_name = mysqli_real_escape_string($db, $_POST["name"]);
$file_department = mysqli_real_escape_string($db, $_POST["department"]); 
$file_brand = mysqli_real_escape_string($db, $_POST["brand"]);      
$file_seller = mysqli_real_escape_string($db, $_POST["seller"]);
$file_material = mysqli_real_escape_string($db, $_POST["material"]);      
$file_closure_type = mysqli_real_escape_string($db, $_POST["closure_type"]); 
$file_pattern = mysqli_real_escape_string($db, $_POST["pattern"]); 
$file_colors = mysqli_real_escape_string($db, $_POST["colors"]);
$file_size = mysqli_real_escape_string($db,$_POST["size"]); 
$file_meta_title = mysqli_real_escape_string($db, $_POST["meta_title"]);
$file_video_link = mysqli_real_escape_string($db, $_POST["video_link"]);
$file_tags = mysqli_real_escape_string($db, $_POST["tags"]); 
$file_rating = mysqli_real_escape_string($db, $_POST["rating"]);   
$file_description = mysqli_real_escape_string($db, $_POST["description"]); 
$file_specification = mysqli_real_escape_string($db, $_POST["specification"]);            
         
$file_price = mysqli_real_escape_string($db, $_POST["price"]);
$file_discount = mysqli_real_escape_string($db, $_POST["discount"]);
$file_mrp_price = mysqli_real_escape_string($db, $_POST["mrp_price"]);
$file_tax_type = mysqli_real_escape_string($db, $_POST["tax_type"]);
$file_tax_rate = mysqli_real_escape_string($db, $_POST["tax_rate"]);
$file_shipping = mysqli_real_escape_string($db, $_POST["shipping"]); 
$file_currency = 'TZs';	
$file_stock = mysqli_real_escape_string($db, $_POST["stock"]);
$file_product_status = mysqli_real_escape_string($db, $_POST["product_status"]); 


	/*$provsql = $db->query("SELECT * FROM providers Where provider='$file_provider'");
	$provrow = $provsql->fetch_assoc();
     $manufacture = $provrow['manufacturing_country'];*/

			   

              $result = $db->query("SET NAMES utf8");//the main trick             
            $insert2 =  $db->query("UPDATE products SET category_name = '$file_main_category', product_name = '$file_name', price = '$file_mrp_price', description = '$file_description', Stock = '$file_stock', Product_Status = '$file_product_status', uploaded_on = NOW() WHERE id='$pro_id'");
            //mysqli_query($db,$insert2);
            //echo $insert2;
            
            if($insert2){				
				echo
				$statusMsg ='<script type="text/javascript">                    
                    alert("Product Details Updated Sucessfully.");                     
                </script>';
                
            }else{
                echo                
				$statusMsg ='<script type="text/javascript">                    
                    alert("Product Details Update Failed, Please Try Again.");                     
                </script>';
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
            if(move_uploaded_file($temp,"products/".$name)){
                $sql1 = $db->query("Update products Set Image1 = '$name' Where id='$pro_id'");
			}
		}
     }
     
if(!empty($_FILES['image_file2']['tmp_name'])){
    $name2=$_FILES["image_file2"]["name"];
    $type2=$_FILES["image_file2"]["type"];
    $size2=$_FILES["image_file2"]["size"];
    $temp2=$_FILES["image_file2"]["tmp_name"];
    $error2=$_FILES["image_file2"]["error"];
    $ext2 = strtolower(pathinfo($name2, PATHINFO_EXTENSION));

        $permissible_extension = array('jpg','png','jpeg','gif','JPG','pdf','PDF');
        if(in_array($ext2, $permissible_extension)){
            if(move_uploaded_file($temp2,"products/".$name2)){
                $sql2 = $db->query("Update products Set Image2 = '$name2' Where id='$pro_id'");
			}
		}
     }
           
     
// Display status message
//echo $statusMsg;

} 
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
