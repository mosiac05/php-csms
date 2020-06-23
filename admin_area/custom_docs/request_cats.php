<?php
session_start();
include '../inc/db.php';
if(isset($_POST['cat']))
{
	$cat = $_POST['cat'];
	$cat_insert = mysqli_query($con, "INSERT INTO request_cats (request_category) VALUES ('$cat')");
}
elseif(isset($_POST['cat_id']) && isset($_POST['request_cat_edit']))
{
	$cat_id = $_POST['cat_id'];
	$request_cat_edit = $_POST['request_cat_edit'];

	$cat_update = mysqli_query($con, "UPDATE request_cats SET request_category = '$request_cat_edit' WHERE request_cat_id ='$cat_id'");
}
else if(isset($_POST['request_cat_delete_id']))
{
	$request_cat_id = $_POST['request_cat_delete_id'];

	$delete_query = mysqli_query($con, "DELETE FROM request_cats WHERE request_cat_id = '$request_cat_id'");

	if($delete_query)
	{
		echo 1;
	}
	else
	{
		echo 0;
	}
}

?>
