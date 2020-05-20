<?php 
	include 'inc/head.php';

	$error = "";
	$time_diff = '';
	$exp_date = '';
	$cur_date = '';

	if(isset($_GET['token_key']) && isset($_GET['email']) && isset($_GET['role']) && isset($_GET['action']) && ($_GET['action']=='reset') && !isset($_POST['action']))
	{
		$role = $_GET['role'];
		$token_key = $_GET['token_key'];
		$email = $_GET['email'];
		$cur_date = date("Y-m-d H:i:s");
		$cur_date = strtotime($cur_date);
		$query = mysqli_query($con, "SELECT * FROM password_reset_temp WHERE token_key='$token_key' AND email_address='$email'");

		$row = mysqli_num_rows($query);
		if($row=="")
		{
			$error .= "<h2>Invalid/Expired Link</h2>
						<p>
						<ul>
							<h4>Some issues:</h4>
							<li>The link was not copied completely</li>
							<li>There is an error in link copied</li>
							<li>The link has expired, it is valid for only 24 hours (1 day after request)</li>
							<li>The link has been used, hence it has been deactivated</li>
						</ul>
						<ul>
							<h4>What you can do:</h4>
							<li>Copy the link from the email and paste on your browser</li>
							<li>Reset password again by clicking on the button below</li>
						</ul>
						</p>
						<p><a href='https://obute.epizy.com/index.php' class='btn btn-primary'>Go to Login Page</a></p>
						";
		}
		else
		{
			$row = mysqli_fetch_assoc($query);
			$exp_date = $row['expDate'];
			$exp_date = strtotime($exp_date);
			$time_diff = abs($cur_date - $exp_date)/3600;
			if($time_diff < 24)
			{
				$form_area = '<p class="login-box-msg">Reset Password</p>

						    <form action="#" id="login_form" method="post" name="update">
						      <div class="form-group has-feedback">
						        <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password">
						        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
						      </div>
						      <div class="form-group has-feedback">
						        <input type="password" class="form-control" id="password" name="confirm_password" placeholder="Re-Enter New Password">
						        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
						      </div>
						      <input type="hidden" name="action" value="update">
						      <input type="hidden" name="role" value="'.$_GET['role'].'">
						      <input type="hidden" name="email" value="'.$_GET['email'].'">
						      <div class="row">
						        <div class="col-xs-6 pull-right">
						          <input type="submit" name="login_submit" value="Reset Password" id="login_submit" class="btn btn-danger btn-block btn-flat">
						        </div>
						        <!-- /.col -->
						      </div>
						    </form>';
			}
			else
			{
				mysqli_query($con, "DELETE FROM password_reset_temp WHERE email_address='$email'");
				$error .= "<h2>Link expired!</h2>
							<p>The link is expired. You are trying to use the expired link which is valid for only 24 hours (1 day after request)<br><br></p>
						<p><a href='https://obute.epizy.com/index.php' class='btn btn-primary'>Go to Login Page</a></p>";
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
<div class="login-box">
  <div class="login-logo">
   
    <a href=""><img src="images/ibedc-logo.png" alt='logo'></a>
  </div>
  <!-- /.login-logo -->   
    <div id="alert_area"></div>
  <div class="login-box-body"> 
  	<?php 
  		if($error != "")
  		{
  			echo $error;
  		}
  		if(isset($form_area))
  		{
  			echo $form_area;
  		}
  	 ?>
  	 
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

<?php 
	if(isset($_POST['email']) && isset($_POST['action']) && ($_POST['action']=='update'))
	{
		$password = mysqli_real_escape_string($con, $_POST['password']);
		$confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

		$email = $_POST['email'];
		$role = $_POST['role'];

		$error="";
		if($password != $confirm_password)
		{
			$error .= '</p>Password do not match, both password should be exactly the same.<br><br>';
		}
		else
		{
			$password = md5($password);
			if($role == 'customer')
			{
				mysqli_query($con, "UPDATE customers SET customer_password='$password' WHERE customer_email='$email'");
			}
			else
			{
				mysqli_query($con, "UPDATE staffs SET staff_password='$password' WHERE staff_email='$email'");
			}

			mysqli_query($con, "DELETE FROM password_reset_temp WHERE email_address='$email'");

			$error .= "<p>Congratulations! Your password has been updated successfully.<br><br></p>
						<p><a href='https://obute.epizy.com/index.php' class='btn btn-primary'>Go to Login Page</a></p>";
		}
	}
 ?>