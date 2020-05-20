<?php 
	include "../inc/db.php";
	if(isset($_GET['note_click'])){

        $note_query = mysqli_query($con, "SELECT * FROM notes WHERE staff_code = '".$_GET['note_click']."'");

        $note_count = mysqli_num_rows($note_query);

        $output = '<li class="header">You have '.$note_count.' notes</li>
              
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">';

           while ($row = mysqli_fetch_assoc($note_query)) {
            $note_id = $row['note_id'];
            $note_text = substr($row['note_text'],0,12);
            $note_date = $row['note_date'];
            $note_status = $row['note_status'];
            $note_staff_code = $row['staff_code'];
     
      $output .= '<li>
        <a href="#" class="single-note" id="'.$note_id.'">
          <h4>
           '.$note_text.'...
          </h4>
          <p><small><i class="fa fa-clock-o"></i>'.$note_date.'</small></p>
        </a>
      </li>';
		}

	$output .= '</ul>
          </li>
          <li class="footer"><button class="btn btn-warning form-control" data-toggle="modal" data-target="#modal-note_add">Add New</button></li>


          <script type="text/javascript">

            
              $(".single-note").click(function(e){
                e.preventDefault();
                var note_id = $(this).attr("id");

                $.ajax({
                  url: "custom_docs/select_note.php",
                  type: "POST",
                  data: {note_id:note_id},
                  success: function(data)
                  {
                    $("#note_content").html(data);
                    $("#view_note").modal("show");
                  }
                });
              });
          </script>
          ';
	echo $output;
	}
 ?>