  <header class="main-header">
    <!-- Logo -->
    <a href="index.php?dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>IBEDC</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b> IBEDC</b>&nbsp;CRMS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
<?php 
            $tot = 0;
$request_query = mysqli_query($con, "SELECT * FROM requests WHERE request_status='OPEN' AND workteam_id = '$workteam_id'");

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
                    $tot = 0;
                    $request_query = mysqli_query($con, "SELECT * FROM requests WHERE request_status='OPEN' AND workteam_id='$workteam_id' ");

                       while ($row = mysqli_fetch_assoc($request_query)) {
                        $request_subject = substr($row['request_subject'],0,12);
                        $request_message = substr($row['request_message'],0,35);
                        $request_date = $row['request_date'];
                    ?>
                 
                  <li>
                    <a href="index.php?view_contacts">
                      <h4>
                       Subject:  <?php echo $request_subject ?>...
                        <small><i class="fa fa-clock-o"></i> <?php echo $request_date ?></small>
                      </h4>
                      <p><?php echo $request_message ?></p>
                    </a>
                  </li>
            <?php }  ?>
                </ul>
              </li>
              <li class="footer"><a href="index.php?view_requests=OPEN">See All Open Requests</a></li>
            </ul>
          </li>


            <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <?php 
              $total_comment = 0;
              $request_query = mysqli_query($con, "SELECT * FROM requests WHERE workteam_id = '$workteam_id' ");
                while($request = mysqli_fetch_assoc($request_query)){
                  $request_id = $request['request_id'];
              $comment_query = mysqli_query($con, "SELECT * FROM comments WHERE comment_status ='N' AND request_id = '$request_id'");

              $total_comment += mysqli_num_rows($comment_query);
            }
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
                    $request_query = mysqli_query($con, "SELECT * FROM requests WHERE workteam_id='$workteam_id' ");
                      while(mysqli_fetch_assoc($request_query)){
                    $comment_query = mysqli_query($con, "SELECT * FROM comments WHERE comment_status ='N' AND request_id = '$request_id'");
                    
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
                    <a href="index.php?request_id=<?=$request_id; ?>">
                      <h4>
                        <?php 
                          $staff_query = mysqli_query($con, "SELECT * FROM staffs WHERE staff_id = '$staff_id'");

                            $row = mysqli_fetch_assoc($staff_query);
                              $staff_name = substr($row['staff_name'],0,12);
                         ?>
                       From:  <?php echo $staff_name ?>...
                        <small><i class="fa fa-clock-o"></i> <?php echo $comment_date ?></small>
                      </h4>
                      <p><?php echo $comment_text ?>...</p>
                    </a>
                  </li>
            <?php } } ?>
                </ul>
              </li>
            </ul>
          </li>
          <?php 
            
            if(isset($_GET['request_id'])) {
              $the_request_id = $_GET['request_id'];

                $q=mysqli_query($con,"UPDATE `comments` SET comment_status='Y'  WHERE request_id = '$the_request_id' AND staff_id='NULL'");
            }
            
            ?>

          
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
                  <?php echo $staff_email; ?>
                  <small><?=$staff_code; ?></small>
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
          <!-- <li>
                  &nbsp;&nbsp;<button class="btn bg-black-light btn-flat" title="Customer Details" data-toggle="modal" data-target="#modal-customer">
                    <i class="fa fa-user">&nbsp;Welcome, <?=$staff_name; ?></i>
                  </button>
          </li> -->
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


        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Requests</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
          </ul>
        </li> -->
        
        <?php 
          if(isset($_GET['view_requests']) && $_GET['view_requests'] == 'OPEN'){
            echo '<li class="active"><a href="index.php?view_requests=OPEN"><i class="fa fa-spinner"></i>View Assigned Requests </a></li>';
          }else{
            echo '<li><a href="index.php?view_requests=OPEN"><i class="fa fa-spinner"></i>View Assigned Requests </a></li>';
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

  <div class="modal modal-default fade" id="modal-customer">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Your Details</h4>
        </div>
        <div class="modal-body">
          <table class="table">
            <div>
              <td class="form-control big"><b>NAME: </b><?=$staff_name; ?></td>
            </div>
            <div>
              <td class="form-control"><b>EMAIL: </b><?=$staff_email; ?></td>
            </div>
            <div>
              <?php 
                   $workteam_query = "SELECT * FROM workteams WHERE workteam_id = '$workteam_id'";
                          $workteam_q = mysqli_query($con,$workteam_query);

                          $row = mysqli_fetch_assoc($workteam_q);
                              $workteam_id = $row['workteam_id'];
                              $workteam_title = $row['workteam_title'];
                              $workteam_head = $row['workteam_head'];
                       ?>
              <td class="form-control"><b>WorkTeam: </b><?=$workteam_title; ?></td>
            </div>
            <div>
              <?php 
                   $staff_query = "SELECT * FROM staffs WHERE staff_id = '$workteam_head'";
                          $staff_q = mysqli_query($con,$staff_query);

                          $row = mysqli_fetch_assoc($staff_q);

                          $workteam_head_name = $row['staff_name'];
              ?>
              <td class="form-control"><b>TeamHead: </b><?=$workteam_head_name; ?></td>
            </div>
          </table>
              <button type="button" class="btn btn-flat btn-primary col-md-offset-5" title="Edit" data-toggle="modal" data-target="#modal-sign-out"><i class="fa fa-sign-out"></i>Sign out</i>
                      </button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


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
              <input type="file" name="image" id="image" class="col-md-6 form-control btn btn-warning" required="">
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
      $tmp_name = $_FILES['image']['tmp_name'];

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
