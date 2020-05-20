<?php 
session_start();
include '../inc/db.php';

if(isset($_POST['note_text']) && isset($_POST['staff_code']))
{
	$note_text = $_POST['note_text'];
    $staff_code = $_POST['staff_code'];

    $insert_note = mysqli_query($con, "INSERT INTO notes (note_text,note_date,note_status,staff_code) VALUES ('$note_text', NOW(), 'N', '$staff_code')");
}

if(isset($_POST['note_status']))
{
	$note_q = mysqli_query($con, "SELECT note_status, note_text FROM notes WHERE note_id = '".$_POST['note_status']."'");
		$row = mysqli_fetch_assoc($note_q);

	if($row['note_status'] == 'Y')
	{
		$status = 'N';
	}
	else
	{
		$status = 'Y';
	}

	mysqli_query($con, "UPDATE notes SET note_status = '$status' WHERE note_id = '".$_POST['note_status']."'");
}

 ?>