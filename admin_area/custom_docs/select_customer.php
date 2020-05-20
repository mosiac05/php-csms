<?php
session_start();
include "../inc/db.php";
include "shared_files/info.php";

if(isset($_POST['customer_id'])){
	$customer_query = mysqli_query($con, "SELECT * FROM customers WHERE customer_id = '".$_POST["customer_id"]."'");
		$row = mysqli_fetch_array($customer_query);

		$area_query = mysqli_query($con, "SELECT area_name FROM areas WHERE area_id = '".$row['area_id']."'");
			$area = mysqli_fetch_array($area_query);
		$output = '<div class="table-responsive">
			<table class="table table-bordered">
				<tr>
					<td width="30%"><label>Name</label></td>
					<td width="70%">'.$row['customer_name'].'</td>
				</tr>
				<tr>
					<td width="30%"><label>Email</label></td>
					<td width="70%">'.$row['customer_email'].'</td>
				</tr>
				<tr>
					<td width="30%"><label>Meter Number</label></td>
					<td width="70%">'.$row['customer_meter_num'].'</td>
				</tr>
				<tr>
					<td width="30%"><label>Phone Number</label></td>
					<td width="70%">'.$row['customer_phone_num'].'</td>
				</tr>
				<tr>
					<td width="30%"><label>State</label></td>
					<td width="70%">'.$row['customer_state'].'</td>
				</tr>
				<tr>
					<td width="30%"><label>City</label></td>
					<td width="70%">'.$row['customer_city'].'</td>
				</tr>
				<tr>
					<td width="30%"><label>Address</label></td>
					<td width="70%">'.$row['customer_address'].'</td>
				</tr>
				<tr>
					<td width="30%"><label>Area</label></td>
					<td width="70%">'.$area['area_name'].'</td>
				</tr>
				<tr>
					<td width="30%"><label>Image</label></td>
					<td width="70%"><img src="../customer_images/'.$row['customer_image'].'" alt="customer image" width="100"></td>
				</tr>
				<tr>
					<td width="30%"><label>Last Login</label></td>
					<td width="70%">'.$row['last_login'].'</td>
				</tr>
				<tr>
					<td width="30%"><label>Date Created</label></td>
					<td width="70%">'.$row['date_created'].'</td>
				</tr>
				</table></div>';

			if($role_id == 1)
			{
				if($row['customer_status'] == 'ACTIVATED')
				{
					$output .= '<div>
						<button id="'.$row['customer_id'].'" class="btn btn-danger col-md-offset-5 deactivate"><i class="fa fa-lock"></i>&nbsp;Deactivate</button>
					</div>';
				}
				else
				{
					$output .= '<div>
						<button id="'.$row['customer_id'].'" class="btn btn-success col-md-offset-5 activate"><i class="fa fa-unlock"></i>&nbsp;Activate</button>
					</div>';
				}
				$output .= '
					 <script type="text/javascript">
					 	$(".activate").click(function(e){
					 		e.preventDefault()
					 		
					 		var customer_id = $(this).attr("id");
					 		var current_status = "DEACTIVATED";
					 		$.ajax({
					 			url: "custom_docs/customer_status.php",
					 			type: "POST",
					 			data: {customer_id:customer_id,current_status:current_status},
					 			success: function(data)
					 			{
					 				alert("Activated Successfully");
					 				$("#view_customer").modal("hide");
					 				$(".modal-backdrop").remove();
					 			}
					 		});
					 	});

					 	$(".deactivate").click(function(e){
					 		e.preventDefault()
					 		
					 		var customer_id = $(this).attr("id");
					 		var current_status = "ACTIVATED";
					 		$.ajax({
					 			url: "custom_docs/customer_status.php",
					 			type: "POST",
					 			data: {customer_id:customer_id,current_status:current_status},
					 			success: function(data)
					 			{
					 				alert("Deactivated Successfully");
					 				$("#view_customer").modal("hide");
					 				$(".modal-backdrop").remove();
					 			}
					 		});
					 	});
					 </script>';
			}
			
			echo $output;
}

 ?>