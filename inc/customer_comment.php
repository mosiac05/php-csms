<?php
session_start();
include 'db.php';  
 	if(isset($_POST['comment']) && isset($_POST['request_id'])){
    $customer_session = $_SESSION['customer'];
        
        $run_customer = mysqli_query($con, "SELECT * FROM customers WHERE customer_email='$customer_session'");
        
        $row = mysqli_fetch_array($run_customer);
        
        $customer_id = $row['customer_id'];
        $request_id = $_POST['request_id'];
 		$comment = mysqli_real_escape_string($con, $_POST['comment']);
 		$run_comment_submit = mysqli_query($con, "INSERT INTO comments (comment_text,comment_date,comment_time,comment_status,request_id,customer_id,staff_id) VALUES ('$comment',NOW(),NOW(),'N','$request_id','$customer_id',NULL)");

 		if($run_comment_submit){
 			echo "Submitted";
 		}
 	}

 ?>