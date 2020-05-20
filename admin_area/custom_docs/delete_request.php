<?php
include '../../inc/head.php';
session_start();

if(isset($_POST['request_id']) && isset($_POST['status']))
{
	$request_id = $_POST['request_id'];
	$status = $_POST['status'];

	if($status == "delete")
	{
		$comment_delete = mysqli_query($con, "DELETE FROM comments WHERE request_id = '$request_id'");

		if($comment_delete)
		{
			mysqli_query($con, "DELETE FROM requests WHERE request_id = '$request_id'");
		}
	}
	
}

?>
