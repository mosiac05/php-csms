<?php
session_start();
include '../inc/db.php';
if(isset($_POST['customer_id']))
{
  $customer_id = $_POST['customer_id'];
  $name = mysqli_real_escape_string($con, $_POST['name']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$meter_num = mysqli_real_escape_string($con, $_POST['meter_num']);
	$phone_num = mysqli_real_escape_string($con, $_POST['phone_num']);
	$state = mysqli_real_escape_string($con, $_POST['state']);
	$city = mysqli_real_escape_string($con, $_POST['city']);
	$address = mysqli_real_escape_string($con, $_POST['address']);
	$area = mysqli_real_escape_string($con, $_POST['area']);

	$run_customer_update = mysqli_query($con, "UPDATE customers SET customer_name = '$name', customer_email = '$email', customer_phone_num = '$phone_num', customer_meter_num = '$meter_num', customer_state = '$state', customer_city = '$city', customer_address = '$address', area_id = '$area' WHERE customer_id = '$customer_id'");
}
 ?>