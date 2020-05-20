<?php
include "../inc/db.php";
if(isset($_POST['workteam_member'])){

		$output = '<form class="form" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group"> 
            	<input type="hidden" name="workteam_member" value="'.$_POST["workteam_member"].'" />               
              <input type="submit" value="Yes" name="delete_member" class="btn btn-danger pull-left col-md-offset-4 col-xs-offset-4">
              <button type="button" data-dismiss="modal" class="btn btn-primary col-md-offset-2 col-xs-offset-2">No</a>
            </div>
          </form>';
			echo $output;
}

 ?>