<?php
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
 ?>