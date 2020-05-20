<?php
include "../inc/db.php";
if(isset($_POST['customer_id']))
{
  $customer_id = $_POST['customer_id'];
	if($_POST['current_status'] == 'DEACTIVATED')
  {
    mysqli_query($con, "UPDATE customers SET customer_status = 'ACTIVATED' WHERE customer_id = '$customer_id'");
	}
  else if($_POST['current_status'] == 'ACTIVATED')
  {
    mysqli_query($con, "UPDATE customers SET customer_status = 'DEACTIVATED' WHERE customer_id = '$customer_id'");
  }
}