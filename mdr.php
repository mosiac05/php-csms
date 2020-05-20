

<?php include "inc/head.php"; ?>

<style>
    .cc {
        background-image: url(../images/admin_images/mosiac.png);
    }
</style>

<?php

if(!isset($_SESSION["admins"])) {
    
    ?>
    
    <script type= "text/javascript">
        window.location="login.php";
    </script>
   <?php
    
}else{

  ?>

<body class="hold-transition register-page cc">
<div class="register-box">
  <div class="register-logo">
    <!--<a href=""><b>Mosiac</b>Panel</a>-->
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new member</p>

    <form action="" method="post"  enctype="multipart/form-data">

      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="c_name" placeholder="Full name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="c_email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="c_pass" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <div class="col-xs-8">
         
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="register">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

      <?php 

if(isset($_POST['register'])){
    
    $c_name = mysqli_real_escape_string($con, $_POST['c_name']);
    
    $c_email = mysqli_real_escape_string($con, $_POST['c_email']);
    
    $c_pass = mysqli_real_escape_string($con, $_POST['c_pass']);
    
    
    $hashedpwd = password_hash($c_pass, PASSWORD_BCRYPT);
    
    
    $insert_customer = "insert into admins (name,email,password,date_created) values ('$c_name','$c_email','$hashedpwd',NOW())";
    
    $run_customer = mysqli_query($con,$insert_customer);
   
    
    if($run_customer){
        
       
        
        echo "<script>alert('You have been Registered Sucessfully')</script>";
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }
    
}

?>



  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="./bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="./plugins/iCheck/icheck.min.js"></script>

</body>
</html>
<?php } ?>
