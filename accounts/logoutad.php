<?php
   @session_start();
   
     unset($_SESSION["u_name"]);
   unset($_SESSION["u_sname"]);
   unset($_SESSION["u_pass"]);
    unset($_SESSION["status"]);
if($_SESSION['u_photo'])
     unset($_SESSION['u_photo']);


      echo 'You have cleaned session';
   header('location:../home.php');



?>