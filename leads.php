<?php
   include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Leads List</title>
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
								
								<!--<div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item active"><a href="event-add.php">Add Event</a></li>
                                    </ol>
                                </div>-->
                               
                                <h4 class="page-title">Leads List</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    
                    <div class="row">
                        <div class="col-sm-12">						
							
                            <div class="card-box table-responsive">
								<a class="btn btn-info" href="export_excel.php">Excel</a>
								
                                <!--<h4 class="header-title"><b>Buttons example</b></h4>
                                <p class="sub-header">
                                    The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
                                </p>-->

                                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
											<th>S.No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile Number</th> 
                                            <th>Subject</th> 
                                            <th>Message</th>                                       
                                            <th>Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
									include_once 'dbConfig.php'; 
									//$blo_id = $_GET['id'];
									$sql = $db->query("select * from lead_list ORDER BY upload_on DESC");
									$count = 0;
									if($sql->num_rows>0){
                                    while($row = $sql->fetch_assoc()){ ?>
                                        <tr>
											<td><?php echo ++$count;?></td>
                                            <td><?php echo $row['name'];?></td>                                            
                                            <td><?php echo $row['email'];?></td>   
                                            <td><?php echo $row['mobile_no'];?></td>
                                            <td><?php echo $row['subject'];?></td>
                                            <td><?php echo $row['message'];?></td>
                                            <td><?php $date_str = $row['upload_on'];
                                	          $timestamp = strtotime($date_str);
                                	          $formatted_date = date('F d, Y', $timestamp);
                                	          echo $formatted_date; ?></td>
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

            <!-- Edit Department Modal -->
				 
				<script>
				$(".passingDepData").click(function () {
	var data_id = $(this).attr('data-id');		
	var data_name = $(this).attr('data-name');	
	var data_email = $(this).attr('data-email');
	var data_mobile = $(this).attr('data-mobile');
	var data_subject = $(this).attr('data-subject');
	var data_message = $(this).attr('data-message');
	var data_remark = $(this).attr('data-remark');	
   
    $("#data_id").val( data_id );
    $("#cli_name").val( data_name );
    $("#email").val( data_email );
    $("#mobile").val( data_mobile );
    $("#subject").val( data_subject );
    $("#message").val( data_message );
    $("#remark").val( data_remark );
    
    $('#remark_status').modal('show');
});


				</script>
				<div id="remark_status" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title mt-0">Modal Content is Responsive</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
												<form id="remark_status_update" method="post">
									<input id="data_id" name="data_id" value="" type="hidden">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="field-1" class="control-label">Name</label>
                                                            <input type="text" class="form-control" id="cli_name" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="field-2" class="control-label">Surname</label>
                                                            <input type="text" class="form-control" id="email" placeholder="Doe">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="field-3" class="control-label">Address</label>
                                                            <input type="text" class="form-control" id="field-3" placeholder="Address">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="field-4" class="control-label">City</label>
                                                            <input type="text" class="form-control" id="field-4" placeholder="Boston">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="field-5" class="control-label">Country</label>
                                                            <input type="text" class="form-control" id="field-5" placeholder="United States">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="field-6" class="control-label">Zip</label>
                                                            <input type="text" class="form-control" id="field-6" placeholder="123456">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group no-margin">
                                                            <label for="field-7" class="control-label">Personal Info</label>
                                                            <textarea class="form-control autogrow" id="field-7" placeholder="Write something about yourself" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
								<h4 id="res2" class="submit-section" style="text-align: center;"></h4>
<script>

$(document).ready(function (e) {
	$("#department_edit").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "department_edit.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success:function(response) {
					var resp = $.trim(response);
					$("#res2").html(resp);
				},
		  	error: function() 
	    	{
	    	} 	        
	   });
	}));
});
</script>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->
				<div id="" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Remark Status</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form id="remark_status_update" method="post">
									<input id="" name="data_id" value="" type="hidden">
									<div class="input-block mb-3">
										<label class="col-form-label">Name <span class="text-danger">*</span></label>
										<input class="form-control" id="" name="cli_name" value="" type="text" readonly>
									</div>
									<div class="input-block mb-3">
										<label class="col-form-label">Email <span class="text-danger">*</span></label>
										<input class="form-control" id="" name="email" value="" type="text" readonly>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Save</button>
									</div>
								</form>
								<h4 id="res2" class="submit-section" style="text-align: center;"></h4>
<script>

$(document).ready(function (e) {
	$("#department_edit").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "department_edit.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success:function(response) {
					var resp = $.trim(response);
					$("#res2").html(resp);
				},
		  	error: function() 
	    	{
	    	} 	        
	   });
	}));
});
</script>
							</div>
						</div>
					</div>
				</div>
				<!-- /Edit Department Modal -->

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

   <script src="assets/js/bootstrap.min.js"></script>
   <script src="assets/js/jquery.min.js"></script>

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

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
    <script src="assets/libs/datatables/dataTables.fixedColumns.min.php"></script>-->

    <script src="assets/libs/jszip/jszip.min.js"></script>
    <script src="assets/libs/pdfmake/pdfmake.min.js"></script>
    <script src="assets/libs/pdfmake/vfs_fonts.js"></script>

    <!-- Datatables init -->
    <script src="assets/js/pages/datatables.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>
</html>
