<?php
 ob_start();
 @session_start();
try{
if(isset($_COOKIE['adname']) && isset($_COOKIE['adpass'])&&isset($_COOKIE['admin'])){
 $name=$_COOKIE['adname'];
 $pass=$_COOKIE['adpass'];

 
 $sql="SELECT photo,username,surname FROM user where username=?";
 $sql1="SELECT email,password,status FROM user where username=? and password=?";
       $result=$db->prepare($sql);
   $result->bindValue(1,$name);
   $result->execute();
   
   $result1=$db->prepare($sql1);
   $result1->bindValue(1,$name);
   $result1->bindValue(2,md5($pass));
   $result1->execute();
  
   

       $row=$result->fetch();
   $row1=$result1->fetch();
  
 if($result&&$result1){                                 
   if($row['username']&& $row1['password'] && $row1['status']==1){
      
           if(isset($_SESSION['u_name']) || isset($_SESSION['status'])) {
            unset($_SESSION["u_sname"]);
   unset($_SESSION["u_pass"]);
   if(isset($_SESSION["status"]))
    unset($_SESSION["status"]);
   if(isset($_SESSION['u_photo']))
     unset($_SESSION['u_photo']);
	  if(isset($_COOKIE['user'])){
     setcookie('user',null,time()+60*60*24*360,"/");
   }
     } 
     
           if($row['photo']!=null)
              $_SESSION['u_photo'] =$row['photo'];
          
       $_SESSION['u_name'] =$row['username'];
       $_SESSION['u_sname'] =$row['surname'];
     $_SESSION['u_pass'] = $pass;
      if($row1['status']==1){
     $_SESSION['status'] = $row1['status'];
     }
}


 }
}
else if(isset($_SESSION['status']) && isset($_SESSION['u_pass'])){

} 
else {
  header('location:loginad.php');
}

}
catch(Exception $e){
die("$e->getMessage()");

}

  ?>