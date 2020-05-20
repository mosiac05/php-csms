<?php 
	include "../inc/db.php";
	if(isset($_POST['customer_id'])){
		$customer_query = mysqli_query($con, "SELECT * FROM customers WHERE customer_id = '".$_POST["customer_id"]."'");
		$row = mysqli_fetch_array($customer_query);

		echo json_encode($row);
	}
 ?>