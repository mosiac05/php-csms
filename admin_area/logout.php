<?php 

session_start();
include 'inc/db.php';
$staff_email = $_SESSION["admin_staff"];

mysqli_query($con, "UPDATE staffs SET last_login = NOW() WHERE staff_email = '$staff_email'");
unset($_SESSION["admin_staff"]);
?>


<script>
    window.location="index.php?dashboard";
</script>