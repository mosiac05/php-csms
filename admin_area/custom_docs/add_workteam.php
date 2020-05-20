<?php
session_start();
include '../inc/db.php';
if (isset($_POST['member']) && isset($_POST['workteam_id']))
{
    $workteam_member = $_POST['member'];

    $member_check = mysqli_query($con, "SELECT * FROM workteam_members WHERE workteam_member = '".$_POST['member']."'");

    $check_count = mysqli_num_rows($member_check);

    if($check_count < 1)
    {
        $workteam_id = $_POST['workteam_id'];

        $member_insert = mysqli_query($con, "INSERT INTO workteam_members(workteam_id,workteam_member) VALUES ('".$_POST['workteam_id']."','".$_POST['member']."')");
        if($member_insert)
        {
            echo json_encode(1);
        }
    }
    else
    {
        echo json_encode('<span class="alert alert-danger col-md-offset-3 col-md-6 col-xs-offset-2 col-xs-8">Individual already a member of a workteam!<i class="fa fa-times pull-right" data-dismiss="alert" ></i>
         </span><br><br><br><br>');
    }
}
else
{
    echo json_encode('<span class="alert alert-danger col-md-offset-3 col-md-6 col-xs-offset-2 col-xs-8">Please select a person!<i class="fa fa-times pull-right" data-dismiss="alert" ></i>
         </span><br><br><br><br>');
} 
?>
