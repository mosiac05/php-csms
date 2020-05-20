<?php 
	include "../inc/db.php";
	if(isset($_POST['staff_id'])){
		$staff_query = mysqli_query($con, "SELECT * FROM staffs WHERE staff_id = '".$_POST["staff_id"]."'");
		$row = mysqli_fetch_array($staff_query);

		echo json_encode($row);
	}
 ?>