<?php 
	include "../inc/db.php";
	if(isset($_POST['cat_id'])){
		$cat_query = mysqli_query($con, "SELECT * FROM request_cats WHERE request_cat_id = '".$_POST["cat_id"]."'");
		$row = mysqli_fetch_array($cat_query);

		echo json_encode($row);
	}
 ?>