<?php 
    function sendMail($to,$subject,$message)
    {
      $from = 'IBEDC <noreply@ibedc.com>';
      $headers = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= 'From: '.$from."\r\n";
      $headers .= 'X-Mailer: PHP/' . phpversion();

      mail($to, $subject, $message, $headers);
    }
 ?>