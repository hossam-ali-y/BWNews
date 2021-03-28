<?php

  ob_start();
  @session_start();
try{
if(isset($_COOKIE['name']) && isset($_COOKIE['pass']) &&(isset($_COOKIE['user'])||isset($_COOKIE['admin'])) ){
  $name=$_COOKIE['name'];
  $pass=$_COOKIE['pass'];
  if(isset($_SESSION['u_name']) && $_SESSION['u_pass']){
      if($_SESSION['u_name']!=$name || $_SESSION['u_pass']!= $pass)
      login($name,$pass);
  }
  else
  login($name,$pass);
}

if(isset($_SESSION['u_name']) && $_SESSION['u_pass']){
         	   
} 
else {
    header('location:get.php');
 }
}
 catch(Exception $e){
die("$e->getMessage()");

 }
 
 ?>