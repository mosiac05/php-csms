<?php include "./inc/head.php"; ?>


<?php

if(!isset($_SESSION['tech_staff'])) {
    
    ?>
    
    <style>
    .cc {
        background-image: linear-gradient(to bottom, white, transparent),
       url(../images/landing_image.jpg);
    background-repeat: no-repeat;
    background-size: cover;
  }
</style>

<body class="hold-transition login-page cc">
<div class="login-box">
  <div class="login-logo">
   
    <a href=""><img src="../images/ibedc-logo.png" alt='logo'></a>
  </div>
  <!-- /.login-logo -->   
    <div id="alert_area"></div>
  <div class="login-box-body"> 
    <p class="login-box-msg">Sign in</p>

    <form action="#" id="login_form" method="post">

      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="email" id="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <div class="col-xs-8">
          <a href="./../forgotten_password.php?role=staff" style="color: gray !important; opacity: 0.5;" class="btn disabled"><i class="fa fa-question-circle"></i> <small>Forgotten Password</small></a>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <input type="submit" name="login_submit" value="Submit" id="login_submit" class="btn btn-primary btn-block btn-flat">
        </div>
        <!-- /.col -->
      </div>
    </form>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#login_form').submit(function(e){
          e.preventDefault();
          $.ajax({
            type: "POST",
            url: "tech_login.php",
            data: $('#login_form').serialize(),
            success:function(response)
            {
              var jsonData = JSON.parse(response);

              if(jsonData == "1")
              {
                window.open('index.php?dashboard', '_self');
              }
              else
              {
                $('#alert_area').html(jsonData);
              }
            }
          });
        });
      });
    </script>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="./../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="./../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="./../plugins/iCheck/icheck.min.js"></script>

</body>

<?php
    
}else{
        
        $staff_session = $_SESSION['tech_staff'];
        
        $get_staff = "SELECT * FROM staffs WHERE staff_email='$staff_session'";
        
        $run_staff = mysqli_query($con,$get_staff);
        
        $row = mysqli_fetch_array($run_staff);
        
        $staff_id = $row['staff_id'];
        $staff_name = $row['staff_name'];
        $staff_code = $row['staff_code'];
        $staff_email = $row['staff_email'];
        $staff_phone_num  = $row['staff_phone_num'];
        $staff_image = $row['staff_image'];
        $role_id = $row['role_id'];
        $last_login = $row['last_login'];

        $workteam_query = mysqli_query($con, "SELECT * FROM workteam_members WHERE workteam_member = '$staff_code'");

          $row = mysqli_fetch_assoc($workteam_query);
            $workteam_id = $row['workteam_id'];
        
?>

<body class="hold-transition skin-purple sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">


<?php include "./inc/nav.php"; ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  
   
     
 <?php
      if(isset($_GET['dashboard'])){
        include("dashboard.php");
      }

      else if(isset($_GET['view_requests'])){
        include("view_requests.php");
      }

      else if(isset($_GET['request_id'])){
        include("view_single_request.php");
      }
      else if(isset($_GET['my_details'])){
        include("my_details.php");
      }
      else {
        echo '<script>window.open("logout.php", "_self")</script>';
      }
        
    ?>

  <!-- /.content-wrapper -->
<?php include "./inc/footer.php"; ?>

  <!-- Control Sidebar -->

  <?php #include "./inc/sidebar.php"; ?>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php include "./inc/js.php"; ?>

<?php } ?>