  <header class="main-header">
    <!-- Logo -->
    <a href="index.php?dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>IBEDC</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>IBEDC</b>&nbsp;&nbsp;CRMS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
<?php 
            $tot = 0;
$request_query = mysqli_query($con, "SELECT * FROM requests WHERE request_status='OPEN' ");

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
                    $request_query = mysqli_query($con, "SELECT * FROM requests WHERE request_status='OPEN' ");

                       while ($row = mysqli_fetch_assoc($request_query)) {
                        $request_id = $row['request_id'];
                        $request_subject = substr($row['request_subject'],0,12);
                        $request_message = substr($row['request_message'],0,35);
                        $request_date = $row['request_date'];
                    ?>
                 
                  <li>
                    <a href="index.php?request_id=<?=$request_id; ?>">
                      <h4>
                       Subject:  <?php echo $request_subject ?>...
                      </h4>
                      <p>
                        <small><i class="fa fa-clock-o"></i> <?php echo $request_date ?></small>
                      </p>
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
              $tot = 0;
              $comment_query = mysqli_query($con, "SELECT * FROM comments WHERE comment_status ='N' AND customer_id = '$customer_id' AND staff_id != 'NULL'");

              $comment_counts = mysqli_num_rows($comment_query);
            ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="New Comments">
              <i class="fa fa-comments-o"></i>
              <span class="label label-success"><?php echo $comment_counts; ?></span>
            </a>
            <ul class="dropdown-menu">

              <li class="header">You have <?php echo $comment_counts; ?> new comments</li>
              
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                 <?php 
                    $tot = 0;
                    $comment_query = mysqli_query($con, "SELECT * FROM comments WHERE comment_status ='N' AND customer_id = '$customer_id' AND staff_id != 'NULL'");
                    
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
                    <a href="index.php?view_appointments">
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
            <?php }  ?>
                </ul>
              </li>
              <li class="footer"><a href="index.php?request_id=<?=$request_id ?>">See All Comments</a></li>
            </ul>
          </li>
          <?php 
            
            if(isset($_GET['request_id'])) {
              $the_request_id = $_GET['request_id'];

                $q=mysqli_query($con,"UPDATE `comments` SET comment_status='Y'  WHERE request_id = '$the_request_id' AND customer_id = '$customer_id'");
            }
            
            ?>

          
             <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="customer_images/<?=$customer_image; ?>" class="user-image" alt="Customer Image">
                <span class="hidden-xs">Welcome,&nbsp;<?=$customer_name; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- Customer Image -->
                <li class="user-header">
                  <img src="customer_images/<?=$customer_image; ?>" class="img-circle" alt="Customer Image">
                  <p>
                    <?php echo $customer_name."<br>";?>
                    <?php echo "<span class='small'>".$customer_email." | ".$customer_phone_num."</span>";?>
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
          <img src="customer_images/<?=$customer_image; ?>" class="img-circle" alt="Customer Image">
        </div>
        <div class="pull-left info">
          <p><?=$customer_name; ?></p>
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
          if(isset($_GET['insert_new_request'])){
            echo '<li class="active"><a href="index.php?insert_new_request"><i class="fa  fa-plus-circle"></i>Make New Request </a> </li>';
          }
          else{
            echo '<li><a href="index.php?insert_new_request"><i class="fa  fa-plus-circle"></i>Make New Request </a> </li>';
          }
         ?>

         <?php 
          if(isset($_GET['view_requests']) && $_GET['view_requests'] == 'NEW'){
            echo '<li class="active"><a href="index.php?view_requests=NEW"><i class="fa fa-align-justify"></i>View New Requests </a></li>';
          }else{
            echo '<li><a href="index.php?view_requests=NEW"><i class="fa fa-align-justify"></i>View New Requests </a></li>';
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
        <div class="modal-header bg-purple">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Your Details</h4>
        </div>
        <div class="modal-body">
          <table class="table">
            <div>
              <td class="form-control big"><b>NAME: </b><?=$customer_name; ?></td>
            </div>
            <div>
              <td class="form-control"><b>EMAIL: </b><?=$customer_email; ?></td>
            </div>
            <div>
              <td class="form-control"><b>ADDRESS: </b><?=$customer_address; ?></td>
            </div>
            <div>
              <?php 
                   $area_query = "SELECT * FROM areas WHERE area_id = '$area_id'";
                          $area_q = mysqli_query($con,$area_query);

                          $row = mysqli_fetch_assoc($area_q);
                              $area_id = $row['area_id'];
                              $area_name = $row['area_name'];
                       ?>
              <td class="form-control"><b>AREA: </b><?=$area_name; ?></td>
            </div>
            <div>
              <td class="form-control"><b>CITY: </b><?=$customer_city; ?></td>
            </div>
            <div>
              <td class="form-control"><b>STATE: </b><?=$customer_state; ?></td>
            </div>
          </table>
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
              <p class="text-danger"><small>*Upload PNG, JPG, JPEG files only, not more than 1MB!</small></p>                
              <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png" class="col-md-6 form-control btn btn-warning" required="">
            </div>
            <input type="hidden" name="image_upload" value="image_upload">
            <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $customer_id; ?>" />
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
      $customer_id = $_POST['customer_id'];

      $image = $_FILES['image']['name'];
      $tmp_name = $_FILES['image']['tmp_name'];

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
          move_uploaded_file($tmp_name, "customer_images/$image");

          $run_update_details = mysqli_query($con, "UPDATE customers SET customer_image = '$image' WHERE customer_id = $customer_id");

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
