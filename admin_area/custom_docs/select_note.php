<?php
include "../inc/db.php";
if(isset($_POST['note_id'])){
	$note_query = mysqli_query($con, "SELECT * FROM notes WHERE note_id = '".$_POST["note_id"]."'");
		$row = mysqli_fetch_array($note_query);

		$output = '<div class="table-responsive">';

		if($row['note_status'] == 'Y')
		{
			$output .= '<div><button title="Click to change status" class="btn btn-sm col-md-4 btn-success pull-right note_edit_status" id='.$row['note_id'].'><b>Current Status:&nbsp;</b>Completed</button></div><br><br>';
		}
		else
		{
			$output .= '<div><button title="Click to change status" class="btn btn-sm col-md-4 btn-warning pull-right note_edit_status" id='.$row['note_id'].'><b>Current Status:&nbsp;</b>Open</button></div><br><br>';
		}

		$output .= '<table class="table table-bordered">
			<tr>
				<td width="30%"><label>NOTE</label></td>
				<td width="70%">'.$row['note_text'].'</td>
			</tr>
			<tr>
				<td width="30%"><label>DATE</label></td>
				<td width="70%">'.$row['note_date'].'</td>
			</tr>';
		if($row['note_status'] == 'Y'){

		$output .= '<tr>
				<td colspan="2"><button title="Click to change status" class="btn btn-sm btn-danger note_delete" id='.$row['note_id'].'><i class="fa fa-trash"></i></button></td>
			</tr>';
		}

				

		$output .= '</tr>
					</table></div>';

			echo $output;
}

 ?>
<script type="text/javascript">
      $(".note_edit_status").click(function(e){
        e.preventDefault();
        
        var note_status = $(this).attr("id");
        $.ajax({
        	url: "custom_docs/add_note.php",
        	type: "POST",
        	data: {note_status:note_status},
        	success: function(data)
        	{
                $('#view_note').modal('hide');
                $('.modal-backdrop').remove();
        		alert('Updated');
        	}
        });
      });

      $(".note_delete").click(function(e){
      	e.preventDefault()

      	var note_id = $(this).attr("id");
      	$.ajax({
      		url: "custom_docs/delete_note.php",
      		type: "POST",
      		data: {note_id:note_id},
      		success: function(data)
      		{
                $('#view_note').modal('hide');
                $('.modal-backdrop').remove();
        		alert('Deleted');
      		}
      	});
      })
 </script>