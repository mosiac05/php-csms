<?php
session_start();
include '../inc/db.php';
include 'shared_files/functions.php';
	if(isset($_POST['code']) && isset($_POST['email']))
	{
		$name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $phone_num = mysqli_real_escape_string($con, $_POST['phone_num']);
        $code = mysqli_real_escape_string($con, $_POST['code']);
        $role = mysqli_real_escape_string($con, $_POST['role']);
        $staff_creator = $_POST['staff_creator'];

        $password = md5($phone_num);

        $run_staff_insert = mysqli_query($con, "INSERT INTO staffs(staff_name,staff_email,staff_password,staff_phone_num,staff_code,staff_status,staff_image,role_id,staff_creator) VALUES ('$name','$email','$password','$phone_num','$code','ACTIVATED','avatar.png','$role','$staff_creator')");

        # Send Auto-mail
	    $subject = 'IBEDC Account Created Successfully';
	    $message = '<div style="width: 60%; margin: auto; border-radius: 15px; background-color: powderblue; color: #000;">
	                    <h1 style="text-align: center; font-weight: bold; text-transform: uppercase; padding: 5px;">
	                    ACCOUNT CREATION SUCCESSFULL
	                    </h1>
	                    <hr style="border: 1px black solid; opacity: .2;">
	                    <p style="padding: 10px; font-size: 18px;">
	                    <b>'.$name.'</b>, your IBEDC account has been created successfully. You can login using your phone number as password.<br>It is advised that you change your password as soon as you receive this mail.
	                    </p>
	                    <footer style="background-color: #00004d; color: white; text-align: center; font-weight: bold;">&copy; IBEDC Inc. Ltd. 2020</footer>
	                </div>';
	    sendMail($email, $subject, $message);
	}
	elseif(isset($_POST['staff_id']) && isset($_POST['staff_edit']))
	{
	  $staff_id = $_POST['staff_id'];
	  $name = mysqli_real_escape_string($con, $_POST['name_edit']);
	  $email = mysqli_real_escape_string($con, $_POST['email_edit']);
	  $phone_num = mysqli_real_escape_string($con, $_POST['phone_num_edit']);
	  $code = mysqli_real_escape_string($con, $_POST['code_edit']);
	  $role = mysqli_real_escape_string($con, $_POST['role_edit']);


	  $run_staff_update = mysqli_query($con, "UPDATE staffs SET staff_name = '$name', staff_email = '$email', staff_phone_num = '$phone_num', staff_code = '$code', role_id = '$role' WHERE staff_id = '$staff_id'");
	}
	elseif(isset($_POST['delete_staff']))
	{
		$staff_id = $_POST['staff_id'];

    	$run_delete_staff = mysqli_query($con, "DELETE FROM staffs WHERE staff_id = '$staff_id'");

	}
 ?>