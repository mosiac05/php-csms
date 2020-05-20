<?php 
	include '../inc/db.php';
    if(isset($_POST['image_submit']))
    {
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];

      echo '<script>alert("'.$image.'")</script>';
    }
 ?>