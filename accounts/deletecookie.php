<?php

@session_start();
   
unset($_SESSION["u_name"]);
unset($_SESSION["u_sname"]);
unset($_SESSION["u_pass"]);
if(isset($_SESSION["status"]))
 unset($_SESSION["status"]);

if(isset($_SESSION['u_photo']))
  unset($_SESSION['u_photo']);

 if(isset($_COOKIE['user'])){
     setcookie('user',null,time()+60*60*24*360,"/");
   }
   if(isset($_COOKIE['admin']))
    setcookie('admin',null,time()+60*60*24*360,"/");
   
   echo 'You have cleaned session';
header('location:../home.php');


?>