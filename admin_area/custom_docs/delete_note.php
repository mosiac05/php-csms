<?php
include "../inc/db.php";
if(isset($_POST['note_id']))
{
  $note_id = $_POST['note_id'];

  $run_delete_note = mysqli_query($con, "DELETE FROM notes WHERE note_id = '$note_id'");	
}

 ?>