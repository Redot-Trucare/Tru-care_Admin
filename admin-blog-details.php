<?php
   include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Blog Details</title>
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
        <?php include 'top-bar.php';?>
        <!-- end Topbar --> 
        
        <!-- ========== Left Sidebar Start ========== -->
         <?php include 'side-bar.php';?>
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
                                        <li class="breadcrumb-item"><a href="blogs.php">Blogs</a></li>
                                        <li class="breadcrumb-item active">Blog Detail</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Blog Detail</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="row">
								<?php
									include_once 'dbConfig.php'; 
									$cou_id = $_GET['id'];
									$sql = "select * from blog where id='$cou_id'";

$result = $db->query($sql);

if ($result->num_rows > 0){

$row = $result->fetch_assoc();

$title = $row["title"];
$sub_title = $row["sub_title"];
$cou_image = $row["cou_image"];
$description = $row["description"];
$meta_title = $row["meta_title"];
$meta_desc = $row["meta_desc"];
$meta_link = $row["meta_link"];
$meta = $row["meta"];
									?>
                                <div class="col-lg-12">
                                    <div class="p-4">

                                        <!-- Image Post -->
                                        <div class="card blog-post bg-transparent">
                                            <div class="post-image">
                                                <img src="blogs/<?php echo $cou_image; ?>" alt="" class="img-fluid mx-auto d-block rounded-top">
                                                
                                            </div>

                                            <div class="card-body">
                                                <!--<div class="text-muted"><span>by <a class="text-dark">John Doe</a>,</span> <span>Dec 10, 2018</span></div>-->
                                                <div class="post-title">
                                                    <h5><b><?php echo $title; ?></b></h5>
                                                    <h6><b><?php echo $sub_title; ?></b></h6>
                                                </div>
                                                <div>
                                                    <p><?php echo $description; ?>
                                                    </p>
                                                    <p><b>Meta Title : </b><?php echo $meta_title; ?>
                                                    </p>
                                                    <p><b>Meta Desc : </b><?php echo $meta_desc; ?>
                                                    </p>
                                                    <p><b>Meta Link : </b><?php echo $meta_link; ?>
                                                    </p>
                                                    <p><b>Meta Key Words : </b><?php echo $meta; ?>
                                                    </p>
                                                    <!--<blockquote class="blockquote mt-3">
                                                        <p>
                                                            When an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.
                                                        </p>
                                                        <footer class="blockquote-footer">
                                                            Someone famous in <cite title="Source Title">Source Title</cite>
                                                        </footer>
                                                    </blockquote>

                                                    <p>Praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.
                                                    </p>

                                                    <div class="text-center p-4">
                                                        <h5 class="text-danger"><i>"Excepturi sint occaecati cupiditate non provident deserunt mollitia anim"</i></h5>
                                                    </div>

                                                    <p class="text-muted">Praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.
                                                    </p>

                                                    <blockquote class="blockquote blockquote-reverse mt-3 mb-0">
                                                        <p>
                                                            When an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.
                                                        </p>
                                                        <footer class="blockquote-footer">
                                                            Someone famous in <cite title="Source Title">Source Title</cite>
                                                        </footer>
                                                    </blockquote>-->
                                                </div>
                                            </div>

                                        </div>

                                        <!--<div class="mt-5">
                                            <h5 class="text-uppercase mb-4">About Author</h5>

                                            <div class="media">
                                                <div class="media-left mr-2">
                                                    <a href="#"> <img class="rounded mr-2 avatar-xl" alt="64x64" src="assets/images/users/avatar-1.jpg"> </a>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="font-18 media-heading mt-0">Daniel Syme</h5>
                                                    <p class="mb-2">
                                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.
                                                    </p>

                                                    <a href="javascript:void(0);" class="btn btn-xs btn-success waves-light waves-effect">View Profile</a>
                                                </div>
                                            </div>
                                        </div>

                                        <hr/>

                                        <div class="mt-5 blog-post-comment">
                                            <h5 class="text-uppercase mb-4">Comments <small>(4)</small></h5>

                                            <ul class="media-list pl-0">

                                                <li class="media">
                                                    <a class="mr-2" href="#">
                                                        <img class="media-object rounded-circle" src="assets/images/users/avatar-2.jpg" alt="img">
                                                    </a>
                                                    <div class="media-body">
                                                        <h5 class="font-18 media-heading mt-0">Johnathan deo</h5>
                                                        <h6 class="text-muted">Nov 23, 2016, 11:45 am</h6>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim.</p>
                                                        <a href="#" class="text-success"><i
                                                                    class="mdi mdi-reply"></i>&nbsp; Reply</a>
                                                    </div>
                                                </li>

                                                <li class="media">
                                                    <a class="mr-2" href="#">
                                                        <img class="media-object rounded-circle" src="assets/images/users/avatar-3.jpg" alt="img">
                                                    </a>
                                                    <div class="media-body">
                                                        <h5 class="font-18 media-heading mt-0">John deo</h5>
                                                        <h6 class="text-muted">Nov 25, 2018, 11:45 am</h6>
                                                        <p>Nulla venenatis. In pede mi, aliquet sit amet, euismod in, auctor ut, ligula. Aliquam dapibus tincidunt metus. Praesent justo dolor, lobortis quis, lobortis dignissim, pulvinar ac, lorem. Vestibulum sed ante.</p>
                                                        <a href="#" class="text-success"><i
                                                                    class="mdi mdi-reply"></i>&nbsp; Reply</a>

                                                        <div class="media sub_media">
                                                            <a class="mr-2" href="#">
                                                                <img class="media-object rounded-circle" src="assets/images/users/avatar-4.jpg" alt="img">
                                                            </a>
                                                            <div class="media-body">
                                                                <h5 class="font-18 media-heading mt-0">Johnathan deo</h5>
                                                                <h6 class="text-muted">Nov 25, 2018, 03:15 am</h6>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
                                                                <a href="#" class="text-success"><i
                                                                            class="mdi mdi-reply"></i>&nbsp;
                                                                        Reply</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="media">
                                                    <a class="mr-2" href="#">
                                                        <img class="media-object rounded-circle" src="assets/images/users/avatar-5.jpg" alt="">
                                                    </a>
                                                    <div class="media-body">
                                                        <h5 class="font-18 media-heading mt-0">John deo</h5>
                                                        <h6 class="text-muted">Nov 27, 2018, 11:45 am</h6>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim.</p>
                                                        <a href="#" class="text-success"><i
                                                                    class="mdi mdi-reply"></i>&nbsp; Reply</a>
                                                    </div>
                                                </li>

                                            </ul>

                                            <h5 class="text-uppercase mt-5 mb-4">Leave a comment</h5>

                                            <form>

                                                <div class="form-group">
                                                    <input class="form-control" id="name2" name="name" placeholder="Your name" type="text" value="" required="">
                                                </div>
                                                

                                                <div class="form-group">
                                                    <input class="form-control" id="email2" name="email" type="email" placeholder="Your email" value="" required="">
                                                </div>
                                                

                                                <div class="form-group">
                                                    <textarea class="form-control" id="message2" name="message" rows="5" placeholder="Message" required=""></textarea>
                                                </div>
                                                

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="">
                                                            <button type="submit" class="btn btn-primary" id="send">Submit</button>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                

                                            </form>

                                        </div>-->
                                        <!-- end m-t-50 -->

                                    </div>
                                    <!-- end p-20 -->
                                </div>
                                <!-- end col -->
   <?php } ?>
                                
                                <!-- end row -->
                            </div>
                        </div>

                    </div>
                    <!-- end container-fluid -->
                </div>

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

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>
</html>
