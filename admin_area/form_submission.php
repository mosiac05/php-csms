<!-- MODAL SUBMISSIONS -->
<?php 
  if(isset($_POST['accept_submit']))
  {
    $staff_code = $_POST['staff_code'];
    $accept_query = mysqli_query($con, "UPDATE requests SET request_status = 'OPEN', request_assignee = '$staff_code' WHERE request_id = '$request_id'");

    if($accept_query){
      echo "<script>         
                    Swal.fire(
                      'Opened Successfully!',
                      '',
                      'success'
                    )      
                    </script>

                    <script>window.open('index.php?request_id={$request_id}', '_SELF')</script>";
    }
  }
 ?>

<?php 
  if(isset($_POST['assign_submit']))
  {
    $staff_code = $_POST['staff_code'];
    $workteam_id = $_POST['workteam_id'];
    $assign_query = mysqli_query($con, "UPDATE requests SET request_status = 'OPEN', request_assignee = '$staff_code', workteam_id = '$workteam_id' WHERE request_id = '$request_id'");

    if($assign_query){
      echo "<script>         
                    Swal.fire(
                      'Assigned Successfully!',
                      '',
                      'success'
                    )      
                    </script>

                    <script>window.open('index.php?request_id={$request_id}', '_SELF')</script>";
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



 <?php 
 	if(isset($_POST['???'])){
 		$resolve_query = mysqli_query($con, "INSERT INTO resolved_requests (resolved_address,resolved_subject,resolved_message,resolved_attachment,resolved_date,resolved_time,request_id,request_cat_id,customer_id,workteam_id,request_assignee) VALUES ('$resolved_address','$request_subject','$request_message','$request_attachment',NOW(),NOW(),'$request_id','$request_cat_id','$customer_id','$workteam_id','$request_assignee')");

 		$delete_request = mysqli_query($con, "DELETE FROM requests WHERE request_id = $request_id");

 		if($delete_request){
 			echo "<script>         
                    Swal.fire(
                      'Resolved!',
                      'Updated Successfully',
                      'success'
                    )      
                    </script>

                    <script>window.open('index.php?view_resolved_requests', '_SELF')</script>";
 		}
 	}
 ?>