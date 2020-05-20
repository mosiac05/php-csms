<?php
include "../inc/db.php";
if(isset($_POST['customer_id']))
{
  $customer_id = $_POST['customer_id'];

  $run_delete_customer = mysqli_query($con, "DELETE FROM customers WHERE customer_id = '$customer_id'");	
}

 ?>