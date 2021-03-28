

<?php
   @session_start();
   	 $_SESSION['u_pass'] =$pass ;
   unset($_SESSION["u_name"]);
   unset($_SESSION["u_sname"]);
   unset($_SESSION["u_pass"]);
   if(isset($_SESSION["status"]))
    unset($_SESSION["status"]);
   if(isset($_SESSION['u_photo']))
     unset($_SESSION['u_photo']);

    
      echo 'You have cleaned session';
   header('location:../home.php');

?>