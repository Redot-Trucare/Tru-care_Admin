<?php
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=Leads.xls");  
	header("Pragma: no-cache"); 
	header("Expires: 0");

	require_once 'dbConfig.php';
	
	$output = "";
	
	$output .="
		<table>
			<thead>
				<tr>
					<th>S.No</th>
					<th>Name</th>
					<th>Email</th>
					<th>Mobile Number</th>
					<th>Subject</th>
					<th>Message</th>					
					<th>Date</th>
					<th>Remark</th>
				</tr>
			<tbody>
	";
	
	$query = $db->query("SELECT * FROM `lead_list`") or die(mysqli_errno());
	$count = 0;
	while($fetch = $query->fetch_array()){
		$date_str = $fetch['upload_on'];
                                	          $timestamp = strtotime($date_str);
                                	          $formatted_date = date('F d, Y', $timestamp);
                                	          
	$output .= "
				<tr>
					<td>".++$count."</td>
					<td>".$fetch['name']."</td>
					<td>".$fetch['email']."</td>
					<td>".$fetch['mobile_no']."</td>
					<td>".$fetch['subject']."</td>
					<td>".$fetch['message']."</td>					
					<td>".$formatted_date."</td>
					<td>".$fetch['remark']."</td>
				</tr>
	";
	}
	
	$output .="
			</tbody>
			
		</table>
	";
	
	echo $output;
	
	
?>
