<?php 
	include "../inc/db.php";
	$output = '';
	if(isset($_POST['role_id']) && isset($_POST['role_name_edit']))
	{
		$role_id = $_POST['role_id'];
		$role_name = $_POST['role_name_edit'];

		$role_update = mysqli_query($con, "UPDATE roles SET role_name = '$role_name' WHERE role_id ='$role_id'");
	}
	elseif(isset($_POST['role_id']))
	{
		$role_id = $_POST['role_id'];

		$role_q = mysqli_query($con, "SELECT role_id, role_name FROM roles WHERE role_id = '$role_id'");
		$role = mysqli_fetch_assoc($role_q);

		echo json_encode($role);
	}
	elseif(isset($_POST['role_name']))
	{
		$role_name = $_POST['role_name'];

    	$role_insert = mysqli_query($con, "INSERT INTO roles (role_name) VALUES ('$role_name')");
	}
 ?>