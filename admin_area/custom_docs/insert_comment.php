<?php
session_start();
include '../inc/db.php';  
 	if(isset($_POST['comment']) && isset($_POST['request_id'])){
    $staff_session = $_SESSION['admin_staff'];
        
        $run_staff = mysqli_query($con, "SELECT * FROM staffs WHERE staff_email='$staff_session'");
        
        $row = mysqli_fetch_array($run_staff);
        
        $staff_id = $row['staff_id'];
        $request_id = $_POST['request_id'];
 		$comment = mysqli_real_escape_string($con, $_POST['comment']);
 		$run_comment_submit = mysqli_query($con, "INSERT INTO comments (comment_text,comment_date,comment_time,comment_status,request_id,customer_id,staff_id) VALUES ('$comment',NOW(),NOW(),'N','$request_id',NULL,'$staff_id')");

 		if($run_comment_submit){
 			echo "Submitted";
 		}
 	}

 ?>