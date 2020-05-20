<?php
session_start();
include 'inc/db.php';
if (isset($_POST["email"]) && isset($_POST['password']))
{
    
    $uid = mysqli_real_escape_string($con,$_POST['email']);
    $pwd = mysqli_real_escape_string($con,$_POST['password']);

    if(empty($uid) || empty($pwd))
    {
        echo json_encode('<strong class="alert alert-danger col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1" style="text-align:center;" >Email or password is empty!  <i class="fa fa-times pull-right" data-dismiss="alert"></i></strong>');
    }
    else
    {
        $sql = "SELECT * FROM customers WHERE customer_email = '$uid' ";
        $result = mysqli_query($con, $sql);
        
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck < 1)
        {
            echo json_encode('<strong class="alert alert-danger col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1" style="text-align:center;" >Invalid Credential, check your email!  <i class="fa fa-times pull-right" data-dismiss="alert"></i></strong>');
        }
        else
        {
            $row = mysqli_fetch_assoc($result);

            $password = $row['customer_password'];
            $encPwd = md5($pwd);

            if($encPwd != $password)
            {
                echo json_encode('<strong class="alert alert-danger col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1" style="text-align:center;" >Wrong Password!  <i class="fa fa-times pull-right" data-dismiss="alert"></i></strong>');
            }
            else
            {
                if($row['customer_status'] == 'DEACTIVATED')
                {
                    echo json_encode('<strong class="alert alert-danger col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1" style="text-align:center;" >Account Deactivated!  <i class="fa fa-times pull-right" data-dismiss="alert"></i></strong>');
                }
                else
                {
                    $_SESSION["customer"] = $row['customer_email'];

                    echo json_encode(1);
                }
            }
            
        }
    }
}
?>
