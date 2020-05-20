<?php 

session_start();
include 'inc/db.php';
$customer_email = $_SESSION["customer"];

mysqli_query($con, "UPDATE customers SET last_login = NOW() WHERE customer_email = '$customer_email'");

unset($_SESSION["customer"]);
?>


<script>
    window.location="index.php";
</script>