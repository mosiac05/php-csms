<?php 	
		if(isset($_POST['request_edit'])){
			$subject = mysqli_real_escape_string($con, $_POST['subject']);
			$message = mysqli_real_escape_string($con, $_POST['message']);
			$address = mysqli_real_escape_string($con, $_POST['address']);

			$attachment = $_FILES['attachment']['name'];
			$tmp_name = $_FILES['attachment']['tmp_name'];

			move_uploaded_file($tmp_name, "attachments/$attachment");

			$run_request_edit = mysqli_query($con, "UPDATE `requests` SET `request_subject` = '$subject', `request_message` = '$message', `request_address` = '$address', `request_attachment` = '$attachment' WHERE `request_id` = '$request_id'");

			if($run_request_edit){
				echo "<script>         
                    Swal.fire(
                      'Updated Successfully!',
                      '',
                      'success'
                    )      
                    </script>

                    <script>window.open('index.php?request_id={$request_id}', '_SELF')</script>";
			}
		}
 ?>


 <?php 
 	if(isset($_POST['request_delete'])){
 		$delete_attachment = mysqli_query($con, "SELECT * FROM requests WHERE request_id = '$request_id'");

 			$row = mysqli_fetch_assoc($delete_attachment);
 			$request_attachment = $row['request_attachment'];


 		$run_request_delete = mysqli_query($con, "DELETE FROM requests WHERE request_id = $request_id");

 		if($run_request_delete){
 			unlink('attachments/{$request_attachment}');

 			echo "<script>         
                    Swal.fire(
                      'Request Deleted!',
                      '',
                      'success'
                    )      
                    </script>

                    <script>window.open('index.php?view_requests={$request_status}', '_SELF')</script>";
 		}
 	}
 ?>


 <?php 
 	if(isset($_POST['pending_submit'])){
 		$pending_query = mysqli_query($con, "UPDATE requests SET request_status = 'PENDING' WHERE request_id = '$request_id'");

 		if($pending_query){
 			echo "<script>         
                    Swal.fire(
                      'Updated Successfully!',
                      '',
                      'success'
                    )      
                    </script>

                    <script>window.open('index.php?request_id={$request_id}', '_SELF')</script>";
 		}
 	}
  ?>



 <?php 
 	if(isset($_POST['resolve_submit'])){
    $customer_session = $_SESSION['customer'];
        
        $run_customer = mysqli_query($con, "SELECT * FROM customers WHERE customer_email='$customer_session'");        
        $row = mysqli_fetch_array($run_customer);
        
        $customer_id = $row['customer_id'];
 		$resolve_query = mysqli_query($con, "INSERT INTO resolved_requests (request_code,resolved_address,resolved_subject,resolved_message,resolved_attachment,resolved_date,resolved_time,request_id,request_cat_id,customer_id,workteam_id,request_assignee) VALUES ('$request_code','$resolved_address','$request_subject','$request_message','$request_attachment',NOW(),NOW(),'$request_id','$request_cat_id','$customer_id','$workteam_id','$request_assignee')");

 		$delete_request = mysqli_query($con, "DELETE FROM requests WHERE request_id = $request_id");

 		if($delete_request){
 			echo "<script>         
                    Swal.fire(
                      'Thank you!',
                      'Updated Successfully',
                      'success'
                    )      
                    </script>

                    <script>window.open('index.php?view_resolved_requests', '_SELF')</script>";
 		}
 	}
 ?>

<?php 
  if(isset($_POST['open_submit'])){
    $open_query = mysqli_query($con, "UPDATE requests SET request_status = 'OPEN' WHERE request_id = '$request_id'");

    if($open_query){
      echo "<script>         
                    Swal.fire(
                      'Updated Successfully!',
                      '',
                      'success'
                    )      
                    </script>

                    <script>window.open('index.php?request_id={$request_id}', '_SELF')</script>";
    }
  }
  ?>