<?php
session_start();
include '../inc/db.php';
include 'shared_files/functions.php';

#################################################################################################
function statusSendMail($request_id, $mail_status)
{
	$get_request = mysqli_query($con, "SELECT customer_id, request_code FROM requests WHERE request_id = '$request_id'");

	$request_row = mysqli_fetch_assoc($get_request);
	$customer_id = $request_row['customer_id'];
	$request_code = $request_row['request_code'];
				
	$get_customer = mysqli_query($con, "SELECT customer_name, customer_email FROM customers WHERE customer_id = '$customer_id'");
	$customer_row = mysqli_fetch_assoc($get_customer);
	$customer_name = $customer_row['customer_name'];
	$customer_email = $customer_row['customer_email'];

	$subject = $request_code . ': REQUEST STATUS CHANGED TO ' . $mail_status;
	$message = '';

	if($mail_status != 'RESOLVED')
	{
		$message = '<div style="width: 60%; margin: auto; border-radius: 15px; background-color: powderblue; color: #000;">
                    <h1 style="text-align: center; font-weight: bold; text-transform: uppercase; padding: 5px;">
                    REQUEST STATUS CHANGED
                    </h1>
                    <hr style="border: 1px black solid; opacity: .2;">
                    <p style="padding: 10px; font-size: 18px;">
                    <b>'.$customer_name.'</b>, the status of your request with ID: '.$request_code.', has been changed to '.$mail_status.'. You can add comments, and follow up.
                    	<br />
                    	Thank you.
                    </p>
                    <footer style="background-color: #00004d; color: white; text-align: center; font-weight: bold;">&copy; IBEDC Inc. Ltd. 2020</footer>
                </div>';
    }
    else
    {
    	$message = '<div style="width: 60%; margin: auto; border-radius: 15px; background-color: powderblue; color: #000;">
                    <h1 style="text-align: center; font-weight: bold; text-transform: uppercase; padding: 5px;">
                    REQUEST RESOLVED
                    </h1>
                    <hr style="border: 1px black solid; opacity: .2;">
                    <p style="padding: 10px; font-size: 18px;">
                    <b>'.$customer_name.'</b>, your request with ID: '.$request_code.', has been resolved and closed. Thank you for your time and for reaching out. We hope you are satisfied with our services.
                    	<br />
                    	Best Regards!
                    </p>
                    <footer style="background-color: #00004d; color: white; text-align: center; font-weight: bold;">&copy; IBEDC Inc. Ltd. 2020</footer>
                </div>';
    }
	sendMail($customer_email, $subject, $message);

}
##################################################################################################



	if(isset($_POST['request_id']) && isset($_POST['staff_code']) && $_POST['status'] == 'accept')
	{
			$request_id = $_POST['request_id'];
			$staff_code = $_POST['staff_code'];

			$request_q = mysqli_query($con, "SELECT request_id, request_assignee, request_status FROM requests WHERE request_id = '$request_id' AND request_status = 'NEW'");
			$req_count = mysqli_num_rows($request_q);

			if($req_count == 1)
			{
				$accept_query = mysqli_query($con, "UPDATE requests SET request_status = 'OPEN', request_assignee = '$staff_code' WHERE request_id = '$request_id'");

				#Send Auto-mail
				$mail_status = 'OPEN';
				statusSendMail($request_id, $mail_status);

				echo json_encode(0);
			}
			else
			{
				echo json_encode(1);
			}
	}
	elseif(isset($_POST['request_id']) && isset($_POST['status']))
	{
		if($_POST['status'] == 'pending')
		{
			$request_id = $_POST['request_id'];

			$pending_query = mysqli_query($con, "UPDATE requests SET request_status = 'PENDING' WHERE request_id = '$request_id'");

	    	if($pending_query)
	    	{

				#Send Auto-mail
				$mail_status = 'PENDING';
				statusSendMail($request_id, $mail_status);

	      		echo $request_id;
	    	}
		}
		elseif($_POST['status'] == 'open')
		{
			$request_id = $_POST['request_id'];

			$open_query = mysqli_query($con, "UPDATE requests SET request_status = 'OPEN' WHERE request_id = '$request_id'");

	    	if($open_query)
	    	{

				#Send Auto-mail
				$mail_status = 'OPEN';
				statusSendMail($request_id, $mail_status);

	      		echo $request_id;
	    	}
		}
		elseif($_POST['status'] == 'resolved')
		{
			$request_id = $_POST['request_id'];

			$resolved_query = mysqli_query($con, "UPDATE requests SET request_status = 'RESOLVED', request_date=NOW(), request_time=NOW() WHERE request_id = '$request_id'");

	    	if($request_query)
	    	{

				#Send Auto-mail
				$mail_status = 'RESOLVED';
				statusSendMail($request_id, $mail_status);

	      		echo $request_id;
	    	}
		}
		elseif($_POST['status'] == 'deleted')
		{
			$request_id = $_POST['request_id'];

			$deleted_query = mysqli_query($con, "UPDATE requests SET request_status='DELETED', request_date=NOW(), request_time=NOW() WHERE request_id = '$request_id'");

	    	if($deleted_query)
	    	{
	      		echo $request_id;
	    	}
		}
	}	
	

	if(isset($_POST['assign_workteam_id']) && isset($_POST['assign_staff_code']))
	{
		$workteam_id = $_POST['assign_workteam_id'];
		$staff_code = $_POST['assign_staff_code'];
		$request_id = $_POST['assign_request_id'];

		if($workteam_id == '')
		{
			echo json_encode('<span class="alert alert-danger col-md-offset-3 col-md-6">Please select a workteam!<i class="fa fa-times pull-right" data-dismiss="alert" ></i></span>');
		}
		else
		{
			$assign_query = mysqli_query($con, "UPDATE requests SET workteam_id = '$workteam_id', request_status = 'OPEN', request_assignee = '$staff_code' WHERE request_id = '$request_id'");

			if($assign_query)
			{

				#Send Auto-mail
				$mail_status = 'OPEN';
				statusSendMail($request_id, $mail_status);

				$int_id = 1;
				echo json_encode($int_id);
			}
		}		
	}
 ?>