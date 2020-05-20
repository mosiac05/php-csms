<?php
session_start();
include "../inc/db.php";
include "shared_files/info.php";
if(isset($_POST['staff_id'])){
	$staff_query = mysqli_query($con, "SELECT * FROM staffs WHERE staff_id = '".$_POST["staff_id"]."'");
		$row = mysqli_fetch_array($staff_query);

		$role_query = mysqli_query($con, "SELECT role_name FROM roles WHERE role_id = '".$row['role_id']."'");
			$role = mysqli_fetch_array($role_query);
		$output = '<div class="table-responsive">
			<table class="table table-bordered">
				<tr>
					<td width="30%"><label>Full Name</label></td>
					<td width="70%">'.$row['staff_name'].'</td>
				</tr>
				<tr>
					<td width="30%"><label>Staff Code</label></td>
					<td width="70%">'.$row['staff_code'].'</td>
				</tr>
				<tr>
					<td width="30%"><label>Email Address</label></td>
					<td width="70%">'.$row['staff_email'].'</td>
				</tr>
				<tr>
					<td width="30%"><label>Phone Number</label></td>
					<td width="70%">'.$row['staff_phone_num'].'</td>
				</tr>
				<tr>
					<td width="30%"><label>Image</label></td>
					<td width="70%"><img src="../staff_images/'.$row['staff_image'].'" width="100" alt="Staff Image"></td>
				</tr>
				<tr>
					<td width="30%"><label>Role</label></td>
					<td width="70%">'.$role['role_name'].'</td>
				</tr>
				<tr>
					<td width="30%"><label>Last Login</label></td>
					<td width="70%">'.$row['last_login'].'</td>
				</tr>
				<tr>
					<td width="30%"><label>Date Created</label></td>
					<td width="70%">'.$row['date_created'].'</td>
				</tr>
				</table></div>
				';
			if($role_id == 1)
			{
				if($row['staff_status'] == 'ACTIVATED')
				{
					$output .= '<div>
						<button id="'.$row['staff_id'].'" class="btn btn-danger col-md-offset-5 deactivate"><i class="fa fa-lock"></i>&nbsp;Deactivate</button>
					</div>';
				}
				else
				{
					$output .= '<div>
						<button id="'.$row['staff_id'].'" class="btn btn-success col-md-offset-5 activate"><i class="fa fa-unlock"></i>&nbsp;Activate</button>
					</div>';
				}
				$output .= '
				 <script type="text/javascript">
				 	$(".activate").click(function(e){
				 		e.preventDefault()
				 		
				 		var staff_id = $(this).attr("id");
				 		var current_status = "DEACTIVATED";
				 		$.ajax({
				 			url: "custom_docs/staff_status.php",
				 			type: "POST",
				 			data: {staff_id:staff_id,current_status:current_status},
				 			success: function(data)
				 			{
				 				alert("Activated Successfully");
				 				$("#view_staff").modal("hide");
				 				$(".modal-backdrop").remove();
				 			}
				 		});
				 	});

				 	$(".deactivate").click(function(e){
				 		e.preventDefault()
				 		
				 		var staff_id = $(this).attr("id");
				 		var current_status = "ACTIVATED";
				 		$.ajax({
				 			url: "custom_docs/staff_status.php",
				 			type: "POST",
				 			data: {staff_id:staff_id,current_status:current_status},
				 			success: function(data)
				 			{
				 				alert("Deactivated Successfully");
				 				$("#view_staff").modal("hide");
				 				$(".modal-backdrop").remove();
				 			}
				 		});
				 	});
				 </script>';
			
			}
			echo $output;
}

 ?>
