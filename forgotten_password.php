<?php
include "inc/head.php";

if(isset($_GET['role'])){
  $role = $_GET['role'];
}else{
  echo "<script>history.go(-1)</script>";
}
$error = "";

if(isset($_POST['email']) && (!empty($_POST['email'])))
{
  $role = $_POST['role'];
  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  $email = filter_var($email, FILTER_VALIDATE_EMAIL);

  if(!$email)
  {
    $error .= '<br><span class="alert alert-danger col-md-offset-1 col-md-10 col-xs-offset-1 col-xs-10">Invalid email address, please type a valid email address!<i class="fa fa-times pull-right" data-dismiss="alert" ></i>
         </span><br><br>';
  }
  else
  {
    $sel_query = '';
    if($role == 'customer')
    {
      $sel_query = "SELECT * FROM customers WHERE customer_email = '".$_POST['email']."'";      
    }
    else
    {
      $sel_query = "SELECT * FROM staffs WHERE staff_email = '".$_POST['email']."'";      
    }

    $results = mysqli_query($con, $sel_query);
    $row = mysqli_num_rows($results);

    if($row=="")
    {
      $error .= '<br><span class="alert alert-danger col-md-offset-1 col-md-10 col-xs-offset-1 col-xs-10">No user is registered with that email address!<i class="fa fa-times pull-right" data-dismiss="alert" ></i>
         </span><br><br>';
    }
  }

  if($error == "")
  {
    $exp_format = mktime(date("H"), date("i"), date("s"), date("m"), date("d")+1, date("Y"));
    $exp_date = date("Y-m-d H:i:s", $exp_format);
    $token_key = md5(2418*2+$email);
    $add_key = substr(md5(uniqid(rand(),1)), 3, 10);
    $token_key = $token_key . $add_key;

    mysqli_query($con, "INSERT INTO password_reset_temp (email, token_key, expDate, role) VALUES ('".$_POST['email']."', '$token_key', '$exp_date', '$role')");

    $output = '<div style="width: 60%; margin: auto; border-radius: 15px; background-color: powderblue; color: #000;">
                    <h1 style="text-align: center; font-weight: bold; text-transform: uppercase; padding: 5px;">
                    PASSWORD RESET
                    </h1>
                    <hr style="border: 1px black solid; opacity: .2;">
                    <div style="padding: 10px; font-size: 18px;">
                      <p><b>Dear user,</b></p>
                      <p>Please click on the following link to reset your password.</p>
                      <hr>
                      <p><a href="http://www.obute.epizy.com/reset_password.php?token_key='.$token_key.'&email='.$_POST['email'].'&role='.$role.'&action=reset">http://www.obute.epizy.com/reset_password.php?token_key='.$token_key.'&email='.$_POST['email'].'&role='.$role.'&action=reset</a>
                      </p>
                      <hr>
                      <p>Please be sure to copy the entire link into your browser. The link will expire after 1 day.</p>
                      <br>
                      <p>If you did not request this forgotten password email, no action is needed, your password will not be reset. However, you may want to log into your account and change your security password as someone may have guessed it.</p>
                      <p>Best Regards!</p>
                    </div>
                    <footer style="background-color: #00004d; color: white; text-align: center; font-weight: bold;">&copy; IBEDC Inc. Ltd. 2020</footer>
                </div>';
    $subject = "IBEDC - Password Recovery";
    $to = $_POST['email'];
    $body = $output;

    $from = "noreply@obute.epizy.com";

    require("PHPMailer/PHPMailerAutoload.php");
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = "mail.obute.epizy.com";
    $mail->SMTPAuth = true;
    $mail->Username = "noreply@obute.epizy.com";
    $mail->Password = "password";
    $mail->Port = 25;
    $mail->IsHTML(true);
    $mail->From = "noreply@obute.epizy.com";
    $mail->FromName = "IBEDC";
    $mail->Sender = $from;
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);
    if(!$mail->Send())
    {
      echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
      $error = '<br>
                <span class="alert alert-success col-md-offset-1 col-md-10 col-xs-offset-1 col-xs-10">An email has been sent to you instructions to reset your password!<i class="fa fa-times pull-right" data-dismiss="alert" ></i>
                </span><br><br>';
    }
  }
}

?>



<style>
.cc {
    background-image: linear-gradient(to bottom, white, transparent),
       url(images/landing_image2.jpg);
    background-repeat: no-repeat;
    background-size: cover;
}
</style>

<body class="hold-transition login-page cc">
  <?php 
    if($error != ""){
   ?>
  <div>
    <?php echo $error; ?>
  </div>
<?php } ?>
<div class="login-box">
  <div class="login-logo">
   
    <a href=""><img src="images/ibedc-logo.png" alt='logo'></a>
  </div>
  <!-- /.login-logo -->   
    <div id="alert_area"></div>
  <div class="login-box-body"> 
    <p class="login-box-msg">Reset Password</p>

    <form action="#" id="login_form" method="post">

      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="email" id="email" placeholder="Enter your email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
<!-- 
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div> -->
      <input type="hidden" name="role" value="<?=$role; ?>">
      <div class="row">
        <div class="col-xs-4 pull-right">
          <input type="submit" name="login_submit" value="Reset" id="login_submit" class="btn btn-danger btn-block btn-flat">
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="./bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="./plugins/iCheck/icheck.min.js"></script>

</body>
