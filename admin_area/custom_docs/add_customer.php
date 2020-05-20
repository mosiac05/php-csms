<?php 
session_start();
include '../inc/db.php';
include 'shared_files/info.php';
include 'shared_files/functions.php';

if(isset($_POST['email']) && isset($_POST['phone_num']))
{
	$name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $meter_num = mysqli_real_escape_string($con, $_POST['meter_num']);
    $phone_num = mysqli_real_escape_string($con, $_POST['phone_num']);
    $state = mysqli_real_escape_string($con, $_POST['state']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $area = mysqli_real_escape_string($con, $_POST['area']);

    $password = md5($phone_num);

    $run_customer_insert = mysqli_query($con, "INSERT INTO customers(customer_name,customer_email,customer_password,customer_phone_num,customer_meter_num,customer_state,customer_city,customer_address,customer_image,customer_creator,customer_status,area_id) VALUES ('$name','$email','$password','$phone_num','$meter_num','$state','$city','$address','avatar.png','$staff_code','ACTIVATED','$area')");


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

 ?>