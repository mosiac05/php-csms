<?php
include "../inc/db.php";
if(isset($_POST['staff_id']))
{
  $staff_id = $_POST['staff_id'];
	if($_POST['current_status'] == 'DEACTIVATED')
  {
    mysqli_query($con, "UPDATE staffs SET staff_status = 'ACTIVATED' WHERE staff_id = '$staff_id'");
	}
  else if($_POST['current_status'] == 'ACTIVATED')
  {
    mysqli_query($con, "UPDATE staffs SET staff_status = 'DEACTIVATED' WHERE staff_id = '$staff_id'");
  }
}