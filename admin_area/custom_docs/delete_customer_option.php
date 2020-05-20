<?php
include "../inc/db.php";
if(isset($_POST['customer_id'])){
	// $customer_query = mysqli_query($con, "SELECT * FROM customers WHERE customer_id = '".$_POST["customer_id"]."'");
	// 	$row = mysqli_fetch_array($customer_query);

		$output = '<form class="form" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group"> 
            	<input type="hidden" name="customer_id" value="'.$_POST["customer_id"].'" />               
              <input type="submit" value="Yes" name="delete_customer" class="btn btn-danger pull-left col-md-offset-4 col-xs-offset-4">
              <button type="button" data-dismiss="modal" class="btn btn-primary col-md-offset-2 col-xs-offset-2">No</a>
            </div>
          </form>';
			echo $output;
}

 ?>