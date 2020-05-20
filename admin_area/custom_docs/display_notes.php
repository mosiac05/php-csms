<?php
  session_start();
  include '../inc/db.php';
  include 'shared_files/info.php';
    $note_query = mysqli_query($con, "SELECT * FROM notes WHERE staff_code = '$staff_code'");

       while ($row = mysqli_fetch_assoc($note_query)) {
        $note_id = $row['note_id'];
        $note_text = substr($row['note_text'],0,12);
        $note_date = $row['note_date'];
        $note_status = $row['note_status'];
        $note_staff_code = $row['staff_code']
    ?>

    <li>
      <a href="#" class="single-note" id="<?=$note_id; ?>">
        <h4>
         <?php echo $note_text ?>...
          
        </h4>
        <p><small><i class="fa fa-clock-o"></i><?php echo $note_date ?></small></p>
      </a>
    </li>
<?php }  ?>