<?php 
session_start();
include '../inc/db.php';

if(isset($_POST['workteam_id']))
{
	$workteam_id = $_POST['workteam_id'];
	
	$workteam_q = mysqli_query($con, "SELECT * FROM workteams WHERE workteam_id = '$workteam_id'");
	$row = mysqli_fetch_array($workteam_q);

	echo json_encode($row);
}

elseif(isset($_POST['title']) && isset($_POST['head']))
{
	$title = $_POST['title'];
	$head = $_POST['head'];
	$workteam_edit_id = $_POST['workteam_edit_id'];

	mysqli_query($con, "UPDATE workteams SET workteam_title = '$title', workteam_head = '$head' WHERE workteam_id ='$workteam_edit_id'");
}
elseif(isset($_POST['workteam_title']) && isset($_POST['workteam_head']))
{
	$head = $_POST['workteam_head'];
	$title = $_POST['workteam_title'];

	$workteam_insert = mysqli_query($con, "INSERT INTO workteams(workteam_head,workteam_title) VALUES ('$head','$title')");
	if($workteam_insert)
	{
		$last_id_q = mysqli_query($con, "SHOW TABLE STATUS WHERE Name = 'workteams'");
        $id = mysqli_fetch_assoc($last_id_q);
        $next_req_id = $id['Auto_increment'];

        $staff_query = mysqli_query($con, "SELECT staff_code FROM staffs WHERE staff_id = '$head'");
        $staff_row = mysqli_fetch_assoc($staff_query);
        $staff_code = $staff_row['staff_code'];

        mysqli_query($con, "INSERT INTO workteam_members(workteam_id,workteam_member,date_created) VALUES ('$next_req_id','$staff_code',NOW())");
	}
}
elseif(isset($_POST['delete_member']))
{
	$delete_member = $_POST['delete_member'];
    $member_delete = mysqli_query($con, "DELETE FROM workteam_members WHERE workteam_member = $delete_member");
}
 ?>
