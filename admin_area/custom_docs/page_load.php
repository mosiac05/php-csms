<?php
	session_start();
	include '../inc/db.php'; 
	$staff_session = $_SESSION['admin_staff'];
        
    $get_staff = "SELECT * FROM staffs WHERE staff_email='$staff_session'";
    
    $run_staff = mysqli_query($con,$get_staff);
    
    $row = mysqli_fetch_array($run_staff);
    
    $staff_id = $row['staff_id'];
    $staff_name = $row['staff_name'];
    $staff_code = $row['staff_code'];
    $staff_email = $row['staff_email'];
    $staff_phone_num  = $row['staff_phone_num'];
    $staff_image = $row['staff_image'];
    $role_id = $row['role_id'];
	
	$file = '';
	if(isset($_GET['page_name']))
	{
		$page_name = $_GET['page_name'];
		if($page_name == 'dashboard')
		{
			echo "<script>window.open('index.php?dashboard', '_self')</script>";		
		}
		if($page_name == 'my_details')
		{
			echo "<script>window.open('index.php?my_details', '_self')</script>";			
		}
		elseif($page_name == 'insert_customer')
		{
			echo "<script>window.open('index.php?insert_customer', '_self')</script>";
		}
		elseif($page_name == 'view_customers')
		{
			echo "<script>window.open('index.php?view_customers', '_self')</script>";
		}
		elseif($page_name == 'insert_staff')
		{
			echo "<script>window.open('index.php?insert_staff', '_self')</script>";
		}
		elseif($page_name == 'view_staffs')
		{
			echo "<script>window.open('index.php?view_staffs', '_self')</script>";
		}
		elseif($page_name == 'roles')
		{
			echo "<script>window.open('index.php?roles', '_self')</script>";
		}
		elseif($page_name == 'view_request_cats')
		{
			echo "<script>window.open('index.php?view_request_cats', '_self')</script>";
		}
		elseif($page_name == 'view_resolved_requests')
		{
			echo "<script>window.open('index.php?view_resolved_requests', '_self')</script>";
		}
		elseif($page_name == 'view_workteams')
		{
			echo "<script>window.open('index.php?view_workteams', '_self')</script>";
		}
		elseif($page_name == 'areas')
		{
			echo "<script>window.open('index.php?areas', '_self')</script>";
		}
		elseif($page_name == 'view_requests')
		{
			echo "<script>window.open('index.php?view_requests', '_self')</script>";
		}

		echo $file;
	}

	// if(isset($_GET['view_requests']))
	// {
	// 	$file = include '../view_requests.php';

	// 	echo $file;
	// }

	if(isset($_GET['workteam_id']))
	{
		$file = include '../view_single_workteam.php';

		echo $file;
	}

	if(isset($_GET['request_id']))
	{
		$file = include '../view_single_request.php';

		echo $file;
	}

	if(isset($_GET['resolved_id']))
	{
		$file = include '../view_single_resolved.php';

		echo $file;
	}

	if(isset($_GET['nav_page']))
	{
      $cur_url = $_GET['nav_page'];
	}
 ?>