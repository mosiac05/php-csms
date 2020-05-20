<?php 
	include "../inc/db.php";
	if(isset($_POST['role_id'])){
		$role_query = mysqli_query($con, "SELECT * FROM roles WHERE role_id = '".$_POST["role_id"]."'");
		$row = mysqli_fetch_array($role_query);

		echo json_encode($row);
	}
 ?>