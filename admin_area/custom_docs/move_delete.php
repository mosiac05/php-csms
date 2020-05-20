<?php 
session_start();
include '../inc/db.php';
if(isset($_POST['delete_resolved_id']))
{
  $delete_resolved_id = $_POST['delete_resolved_id'];
  $resolved_del_query = mysqli_query($con, "SELECT * FROM resolved_requests WHERE resolved_id = '$delete_resolved_id'");

  $row = mysqli_fetch_assoc($resolved_del_query);
      $del_code = $row['request_code'];
      $del_subject = $row['resolved_subject'];
      $del_message = $row['resolved_message'];
      $del_address = $row['resolved_address'];
      $del_time = $row['resolved_time'];
      $del_date = $row['resolved_date'];
      $del_attachment = $row['resolved_attachment'];
      $del_cat_id = $row['request_cat_id'];
      $del_assignee = $row['request_assignee'];
      $customer_id = $row['customer_id'];
      $workteam_id = $row['workteam_id'];
      $request_id = $row['request_id'];

    $del_insert_query = mysqli_query($con, "INSERT INTO deleted_requests (del_code,del_address,del_subject,del_message,del_attachment,del_date,del_time,del_cat_id,customer_id,workteam_id,request_id,del_assignee,del_status) VALUES ('$del_code','$del_address','$del_subject','$del_message','$del_attachment',NOW(),NOW(),'$del_cat_id','$customer_id','$workteam_id','$request_id','$del_assignee','RESOLVED')");

    if($del_insert_query)
    {
		mysqli_query($con, "DELETE FROM resolved_requests WHERE resolved_id = '$delete_resolved_id'");
    }
}

elseif(isset($_POST['delete_request_id'])) 
{
      $delete_request_id = $_POST['delete_request_id'];
      $request_del_query = mysqli_query($con, "SELECT * FROM requests WHERE request_id = '$delete_request_id'");

      $row = mysqli_fetch_assoc($request_del_query);
          $del_code = $row['request_code'];
          $del_subject = $row['request_subject'];
          $del_message = $row['request_message'];
          $del_address = $row['request_address'];
          $del_time = $row['request_time'];
          $del_date = $row['request_date'];
          $del_attachment = $row['request_attachment'];
          $del_status = $row['request_status'];
          $del_cat_id = $row['request_cat_id'];
          $del_assignee = $row['request_assignee'];
          $customer_id = $row['customer_id'];
          $workteam_id = $row['workteam_id'];
          $request_id = $row['request_id'];

    $del_insert_query = mysqli_query($con, "INSERT INTO deleted_requests (del_code,del_address,del_subject,del_message,del_attachment,del_date,del_time,del_cat_id,customer_id,workteam_id,request_id,del_assignee,del_status) VALUES ('$del_code','$del_address','$del_subject','$del_message','$del_attachment',NOW(),NOW(),'$del_cat_id','$customer_id','$workteam_id','$request_id','$del_assignee','$del_status')");

  if($del_insert_query)
    {
		mysqli_query($con, "DELETE FROM requests WHERE request_id = '$delete_request_id'");
    }
}
?>