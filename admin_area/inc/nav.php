  <header class="main-header">
    <!-- Logo -->
    <a href="index.php?dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>IBEDC</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>IBEDC</b> CRMS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
<?php 
if($role_id == 1)
{
$request_query = mysqli_query($con, "SELECT * FROM requests WHERE request_status='OPEN'");
}
else
{
$request_query = mysqli_query($con, "SELECT * FROM requests WHERE request_status='OPEN' AND request_assignee = '$staff_code'");  
}

$request_counts = mysqli_num_rows($request_query);
?>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Open Requests">
              <i class="fa fa-spinner"></i>
              <span class="label label-success"><?php echo $request_counts; ?></span>
            </a>
            <ul class="dropdown-menu">

              <li class="header">You have <?php echo $request_counts; ?> open requests</li>
              
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                 <?php 
                      if($role_id == 1)
                      {
                      $request_query = mysqli_query($con, "SELECT * FROM requests WHERE request_status='OPEN' ORDER BY 1 DESC LIMIT 6");
                      }
                      else
                      {
                      $request_query = mysqli_query($con, "SELECT * FROM requests WHERE request_status='OPEN' AND request_assignee = '$staff_code' ORDER BY 1 DESC LIMIT 6");  
                      }

                       while ($row = mysqli_fetch_assoc($request_query)) {
                        $request_id = $row['request_id'];
                        $request_subject = substr($row['request_subject'],0,12);
                        $request_message = substr($row['request_message'],0,35);
                        $request_date = $row['request_date'];
                    ?>
                 
                  <li>
                    <a href="index.php?request_id=<?=$request_id; ?>" class="single-request" id="<?=$request_id; ?>">
                      <h4>
                       Subject:  <?php echo $request_subject ?>...
                      </h4>
                      <p><small><i class="fa fa-clock-o"></i> <?php echo $request_date ?></small></p>
                    </a>
                  </li>
            <?php }  ?>
                </ul>
              </li>
              <li class="footer"><a href="index.php?view_requests=OPEN" class="requests_btn" id="OPEN">See All Open Requests</a></li>
            </ul>
          </li>

            <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <?php
            if($role_id == 1)
            {
              $comment_query = mysqli_query($con, "SELECT * FROM comments WHERE comment_status='N'");
            }
            else
            {
              $comment_query = mysqli_query($con, "SELECT * FROM comments WHERE comment_status='N' AND request_id IN (SELECT request_id FROM requests WHERE request_assignee = '$staff_code')");              
            }

              $total_comment = mysqli_num_rows($comment_query);
            ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="New Comments">
              <i class="fa fa-comments-o"></i>
              <span class="label label-success"><?php echo $total_comment; ?></span>
            </a>
            <ul class="dropdown-menu">

              <li class="header">You have <?php echo $total_comment; ?> new comments</li>
              
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                 <?php

            if($role_id == 1)
            {
              $comment_query = mysqli_query($con, "SELECT * FROM comments WHERE comment_status='N' ORDER BY 1 DESC LIMIT 6");
            }
            else
            {
              $comment_query = mysqli_query($con, "SELECT * FROM comments WHERE comment_status='N' AND request_id IN (SELECT request_id FROM requests WHERE request_assignee = '$staff_code') ORDER BY 1 DESC LIMIT 6");
            }
                    
                       while ($row = mysqli_fetch_assoc($comment_query)) {
                        $comment_id = $row['comment_id'];
                        $comment_text = substr($row['comment_text'],0,35);
                        $comment_date = $row['comment_date'];
                        $comment_time = $row['comment_time'];
                        $request_id = $row['request_id'];
                        $customer_id = $row['customer_id'];
                        $staff_id = $row['staff_id'];
                    ?>
                 
                  <li>
                    <a href="index.php?request_id=<?=$request_id; ?>" class="single-request" id="<?=$request_id; ?>">
                      <h4>
                        <?php
                        if($staff_id != NULL){ 
                          $staff_query = mysqli_query($con, "SELECT staff_name FROM staffs WHERE staff_id = '$staff_id'");

                            $row = mysqli_fetch_assoc($staff_query);
                              $staf_name = substr($row['staff_name'],0,12);
                         ?>
                        From:  <?php echo $staf_name ?>...                       
                      <?php }elseif($customer_id != NULL){
                          $customer_query = mysqli_query($con, "SELECT customer_name FROM customers WHERE customer_id = '$customer_id'");

                            $row = mysqli_fetch_assoc($customer_query);
                              $customer_name = substr($row['customer_name'],0,12);
                       ?>
                       From:  <?php echo $customer_name ?>...
                     <?php } ?>
                        <small><i class="fa fa-clock-o"></i> <?php echo $comment_date ?></small>
                      </h4>
                      <p><?php echo $comment_text ?>...</p>
                    </a>
                  </li>
            <?php } ?>
                </ul>
              </li>
            </ul>
          </li>

          <li class="dropdown messages-menu">
            <?php 
              $note_q = mysqli_query($con, "SELECT * FROM notes WHERE staff_code = '$staff_code'");

              $note_count = mysqli_num_rows($note_q);
             ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="My Notes">
              <i class="fa fa-list-alt note_click"></i>
              <span class="label label-success"><?php echo $note_count; ?></span>
            </a>
            <ul class="dropdown-menu notes_area">
              <!-- NOTES AREA ajax display -->
            </ul>
          </li>        
             <!-- User Account: style can be found in dropdown.less -->
             <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../staff_images/<?=$staff_image; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs">Welcome,&nbsp;<?=$staff_name; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../staff_images/<?=$staff_image; ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $staff_name; ?>
                  <br>
                  <?php 
                    echo $staff_email;

                    $role_query = mysqli_query($con, "SELECT role_name FROM roles WHERE role_id = '$role_id'");
                      $role = mysqli_fetch_assoc($role_query);
                   ?>
                  <small><?=$role['role_name'] . ' | ' . $staff_code; ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <button type="button" class="btn btn-default btn-flat" title="Upload Image" data-toggle="modal" data-target="#modal-upload-image"><i class="fa fa-photo"></i>&nbsp;Upload Image</button>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" style="">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../staff_images/<?=$staff_image; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$staff_name; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <?php 
          if(isset($_GET['dashboard'])){
            echo '<li class="active"><a href="index.php?dashboard"><i class="fa fa-home"></i> Dashboard</a></li>';
          }
          else{
            echo '<li><a href="index.php?dashboard"><i class="fa fa-home"></i> Dashboard</a></li>';
          }
         ?>

         <?php
          $tree_active ="";
          if(isset($_GET['insert_customer']) || isset($_GET['view_customers'])){
            $tree_active = "active";
          }
          ?>
        <li class="<?=$tree_active; ?> treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Customers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php 
          if(isset($_GET['insert_customer'])){
            echo '<li class="active"><a href="index.php?insert_customer"><i class="fa fa-user-plus"></i>Create New Account</a></li>';
          }else{
            echo '<li><a href="index.php?insert_customer"><i class="fa fa-user-plus"></i>Create New Account</a></li>';
          }
          ?>

          <?php 
          if(isset($_GET['view_customers'])){
            echo '<li class="active"><a href="index.php?view_customers"><i class="fa fa-users"></i>View Customers</a></li>';
          }else{
            echo '<li><a href="index.php?view_customers"><i class="fa fa-users"></i>View Customers</a></li>';
          }
          ?>
          </ul>
        </li>
        

         <?php
          $tree_active ="";
          if(isset($_GET['view_requests']) || isset($_GET['view_resolved_requests']) || isset($_GET['view_request_cats'])){
            $tree_active = "active";
          }
          ?>
        <li class="<?=$tree_active; ?> treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Requests</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <?php 
          if(isset($_GET['view_requests']) && $_GET['view_requests'] == 'NEW'){
            echo '<li class="active"><a href="index.php?view_requests=NEW"><i class="fa fa-plus-circle"></i>View New Requests </a></li>';
          }else{
            echo '<li><a href="index.php?view_requests=NEW"><i class="fa fa-plus-circle"></i>View New Requests </a></li>';
          }
          ?>

        <?php 
          if(isset($_GET['view_requests']) && $_GET['view_requests'] == 'OPEN'){
            echo '<li class="active"><a href="index.php?view_requests=OPEN"><i class="fa fa-spinner"></i>View Open Requests </a></li>';
          }else{
            echo '<li><a href="index.php?view_requests=OPEN"><i class="fa fa-spinner"></i>View Open Requests </a></li>';
          }
          ?>


          <?php 
          if(isset($_GET['view_requests']) && $_GET['view_requests'] == 'PENDING'){
            echo '<li class="active"><a href="index.php?view_requests=PENDING"><i class="fa fa-indent"></i>View Pending Requests </a></li>';
          }else{
            echo '<li><a href="index.php?view_requests=PENDING"><i class="fa fa-indent"></i>View Pending Requests </a></li>';
          }
          ?>


          <?php 
          if(isset($_GET['view_requests']) && $_GET['view_requests'] == 'RESOLVED'){
            echo '<li class="active"><a href="index.php?view_requests=RESOLVED"><i class="fa fa-check-square-o"></i>View Resolved Requests </a></li>';
          }else{
            echo '<li><a href="index.php?view_requests=RESOLVED"><i class="fa fa-check-square-o"></i>View Resolved Requests </a></li>';
          }
          ?> 

          <?php
          if($role_id == 1)
          { 
            if(isset($_GET['view_requests']) && $_GET['view_requests'] == 'DELETED'){
              echo '<li class="active"><a href="index.php?view_requests=DELETED"><i class="fa fa-trash"></i>View Deleted Requests </a></li>';
            }else{
              echo '<li><a href="index.php?view_requests=DELETED"><i class="fa fa-trash"></i>View Deleted Requests </a></li>';
            }
          }
          ?> 

           <?php 
          if(isset($_GET['view_request_cats'])){
            echo '<li class="active"><a href="index.php?view_request_cats"><i class="fa fa-bars"></i>Request Categories </a></li>';
          }else{
            echo '<li><a href="index.php?view_request_cats"><i class="fa fa-bars"></i>Request Categories </a></li>';
          }
          ?>
          </ul>
        </li>


        <?php
        if($role_id == 1)
        {
          $tree_active ="";
          if(isset($_GET['insert_staff']) || isset($_GET['view_staffs'])){
            $tree_active = "active";
          }
          ?>
        <li class="<?=$tree_active; ?> treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Staff</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php 
          if(isset($_GET['insert_staff'])){
            echo '<li class="active"><a href="index.php?insert_staff"><i class="fa fa-user-plus"></i>Create Staff Account</a></li>';
          }else{
            echo '<li><a href="index.php?insert_staff"><i class="fa fa-user-plus"></i>Create Staff Account</a></li>';
          }
          ?>

          <?php 
          if(isset($_GET['view_staffs'])){
            echo '<li class="active"><a href="index.php?view_staffs"><i class="fa fa-users"></i>View Staff</a></li>';
          }else{
            echo '<li><a href="index.php?view_staffs"><i class="fa fa-users"></i>View Staff</a></li>';
          }
          ?>
          
          <?php 
          if(isset($_GET['roles'])){
            echo '<li class="active"><a href="index.php?roles"><i class="fa fa-gears"></i>Staff Roles</a></li>';
          }else{
            echo '<li><a href="index.php?roles"><i class="fa fa-gears"></i>Staff Roles</a></li>';
          }
          ?>
          </ul>
        </li>


        
        <?php 
          if(isset($_GET['areas'])){
            echo '<li class="active"><a href="index.php?areas"><i class="fa fa-flag-checkered"></i>Areas</a></li>';
          }else{
            echo '<li><a href="index.php?areas"><i class="fa fa-flag-checkered"></i>Areas</a></li>';
          }
          ?>
      <?php } ?>

          <?php 
          if(isset($_GET['view_workteams'])){
            echo '<li class="active"><a href="index.php?view_workteams"><i class="fa fa-group"></i>View Workteams </a></li>';
          }else{
            echo '<li><a href="index.php?view_workteams"><i class="fa fa-group"></i>View Workteams </a></li>';
          }
          ?>

          <?php 
          if(isset($_GET['my_details'])){
            echo '<li class="active"><a href="index.php?my_details"><i class="fa fa-info-circle"></i> My Details</a></li>';
          }else{
            echo '<li><a href="index.php?my_details"><i class="fa fa-info-circle"></i> My Details</a></li>';
          }
          ?>

        <br><br><br>
        <li><a href="#" data-toggle="modal" data-target="#modal-sign-out"><i class="fa fa-sign-out"></i>Sign out</a></li>
    
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <script type="text/javascript">

            $(document).ready(function(){
              $("#note_form").submit(function(e){
                e.preventDefault();

                $.ajax({
                  url: "custom_docs/add_note.php",
                  type: "POST",
                  data: $("#note_form").serialize(),
                  success: function(data)
                  {
                    $("#note_form")[0].reset();
                    $("#modal-note_add").modal("hide");
                    $(".modal-backdrop").remove();
                    alert("Submitted successfully");
                  }
                });
              });


              $(".note_click").click(function(e){
                e.preventDefault()
                var note_click = "<?php echo $staff_code; ?>";
                $.ajax({
                  url: "custom_docs/fetch_notes.php",
                  type: "GET",
                  data: {note_click:note_click},
                  success: function(data)
                  {
                    $(".notes_area").html(data);
                  }
                });
              });
            });
          </script>


<div id="modal-upload-image" class="modal modal-default fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-purple">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Select Image</h4>
        </div>
        <div class="modal-body" id="">
          <form class="form" id="image_upload" action="#" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="name">Click to select file:</label>
              <p class="text-danger"><small>*Upload PNG, JPG, JPEG files only, not more than 1MB!</small></p>    
              <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png" class="col-md-6 form-control btn btn-warning" required="">
            </div>
            <input type="hidden" name="image_upload" value="image_upload">
            <input type="hidden" name="staff_id" id="staff_id" value="<?php echo $staff_id; ?>" />
            <br>
            <hr>
            <div class="form-group">                
              <input type="submit" name="image_submit" value="Upload Image" class="col-md-offset-5 btn bg-purple">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php 
    if(isset($_POST['image_submit']))
    {
      $staff_id = $_POST['staff_id'];

      $image = $_FILES['image']['name'];
      $size = $_FILES['image']['size'];
      $type = $_FILES['image']['type'];
      $tmp_name = $_FILES['image']['tmp_name'];

      $max_size = 1000000;
      $extension = substr($image, strpos($image, '.') + 1);
      $extension = strtolower($extension);

      if($extension == "jpg" || $extension == "jpeg" || $extension == 'png')
      {
        if($size<=$max_size)
        {
          move_uploaded_file($tmp_name, "../staff_images/$image");

          $run_update_details = mysqli_query($con, "UPDATE staffs SET staff_image = '$image' WHERE staff_id = $staff_id");

          if($run_update_details)
          {
            echo "<script>         
              Swal.fire(
                'Uploaded Successfully!',
                '',
                'success'
              )      
              </script>

              <script>window.open('index.php?dashboard', '_SELF')</script>";
          }
        }
        else
        {
         echo "<script>alert('Your file is more than 1MB!')</script>";
        }
      }
      else
      {
         echo "<script>alert('Only PNG, JPEG, JPG files are allowed!')</script>";
      }
    }
 ?>

  <div class="modal modal-default fade" id="modal-sign-out">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Sign Out?</h4>
        </div>
        <div class="modal-body">
          <form class="form" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">                
              <a href="logout.php" class="btn btn-danger pull-left col-md-offset-4 col-xs-offset-4">Yes</a>
              <a href="#" data-dismiss="modal" class="btn btn-primary col-md-offset-2 col-xs-offset-2">No</a>
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  <!-- /.modal-dialog -->
  </div>
<!-- /.modal -->


<div class="modal modal-default fade" id="modal-note_add">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-purple">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">New Note</h4>
        </div>
        <div class="modal-body">
          <form id="note_form" class="form" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="note_text">Enter note here:</label>             
              <textarea name="note_text" placeholder="Type your note here..." class="form-control" required=""></textarea>
            </div>
            <input type="hidden" name="staff_code" value="<?php echo $staff_code; ?>">
            <div class="form-groupr">
              <input type="submit" name="note_submit" value="Submit" class="btn bg-purple col-xs-offset-4 col-md-offset-5">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  <!-- /.modal-dialog -->
  </div>
<!-- /.modal -->



<div id="view_note" class="modal modal-default fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Note</h4>
        </div>
        <div class="modal-body" id="note_content">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->