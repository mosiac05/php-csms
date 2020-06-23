<?php 
	include "../inc/db.php";
	if(isset($_POST['area_id'])){
		$area_query = mysqli_query($con, "SELECT * FROM areas WHERE area_id = '".$_POST["area_id"]."'");
		$row = mysqli_fetch_array($area_query);

		echo json_encode($row);
	}
	elseif(isset($_POST['area_edit_id']))
	{
		$name_edit = $_POST['name_edit'];
	  $eprt_edit = $_POST['eprt_edit'];
	  $area_id = $_POST['area_edit_id'];

	  $area_update = mysqli_query($con, "UPDATE areas SET area_name = '$name_edit', area_text = '$eprt_edit' WHERE area_id ='$area_id'");
	}
	else if(isset($_POST['area_delete_id']))
	{
		$area_id = $_POST['area_delete_id'];

		$delete_query = mysqli_query($con, "DELETE FROM areas WHERE area_id = '$area_id'");

		if($delete_query)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
	elseif(isset($_POST['area_name']) && isset($_POST['area_eprt']))
	{
		$area_name = $_POST['area_name'];
	    $area_eprt = $_POST['area_eprt'];

	    $area_insert = mysqli_query($con, "INSERT INTO areas (area_name,area_text) VALUES ('$area_name','$area_eprt')");
	}
 ?>