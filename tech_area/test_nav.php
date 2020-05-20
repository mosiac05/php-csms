<?php 
	if(isset($_POST['nav_link']))
	{
		$dashboard = include 'my_details.php';
		echo json_encode($dashboard);
	}
	else
	{
		echo json_encode('Failed');
	}
 ?>