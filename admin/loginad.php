<?php
   @session_start();
require"../connectdb.php";//connect to db newsdb

function test_input($t){
$t=trim($t);
$t=stripslashes($t);
$t=htmlspecialchars($t);
return $t;
}
$msg['name']=$msg['pass']=$msg['email']=$msg['gender']='';
$tx['name']=$tx['pass']=$tx['email']=$tx['gender']=$tx['cookie']='';


	$r='';
	
if(isset($_POST['send'])){
    $p=$_POST['u_pass'];
    $n=$_POST['u_name'];
	       
              
TRY{
//include"connectdb.php";//connect to db newsdb

if($db){
     $sql="SELECT photo,username,surname FROM user where username=?";
	 $sql1="SELECT email,password,status FROM user where username=? and password=?";
         $result=$db->prepare($sql);
		 $result->bindValue(1,$n);
		 $result->execute();
		 
		 $result1=$db->prepare($sql1);
		 $result1->bindValue(1,$n);
		 $result1->bindValue(2,md5($p));
		 $result1->execute();
		
		 
	
         $row=$result->fetch();
		 $row1=$result1->fetch();
		
	 if($result&&$result1){                                 
		 if($row['username']&& $row1['password'] && $row1['status']==1){
		    
					   if(isset($_SESSION['u_name']) || $_SESSION['status']) {
                 unset($_SESSION["u_name"]);
   unset($_SESSION["u_sname"]);
   unset($_SESSION["u_pass"]);
   if(isset($_SESSION["status"]))
    unset($_SESSION["status"]);
   if(isset($_SESSION['u_photo']))
     unset($_SESSION['u_photo']);

			 } 
			 
			 			if($row['photo']!=null)
			          $_SESSION['u_photo'] =$row['photo'];
					  
		     $_SESSION['u_name'] =$row['username'];
		     $_SESSION['u_sname'] =$row['surname'];
			 $_SESSION['u_pass'] = $p;
			  if($row1['status']==1){
			 $_SESSION['status'] = $row1['status'];
			 }
         if(isset($_POST['remember'])){  //cookie set  
	     setcookie('name',$n,time()+60*60*24*360,"/");
       setcookie('pass',$p,time()+60*60*24*360,"/");
	   setcookie('adname',$n,time()+60*60*24*360,"/");
       setcookie('adpass',$p,time()+60*60*24*360,"/");
       setcookie('admin',$n,time()+60*60*24*360,"/");
         }
             header('location:ad.php');  
        } 
         ELSE IF($row['username'] && !$row1['password'])
		 $msg['name'] = 'Wrong password';
         else
		  $msg['name'] = '*'.$_POST['u_name'].'*&nbsp;&nbsp;&nbsp;You Are Not Admin';
		  //$result=getResult();
  
    }
	   else{
	   $msg['name'] ="try again";
	   }
       }
else{
$msg['name'] ="wrong in connect to database";
}
}
 CATCH(PDOException $e){
 $msg['name'] ="invalid connection";
die($e->getmessage());
			 }
			 
if(empty($_POST['u_name']))
$msg['name']="name is required";
else{

$tx['name']=test_input($_POST['u_name']);//validation
}


if(empty($_POST['u_pass']))
$msg['pass']="password is required";
else{
$tx['pass']=test_input($_POST['u_pass']);//validation
}

if(empty($_POST['email']))
$msg['email']="email is required";
else
$tx['email']=$_POST['email'];
if(empty($_POST['gender']))
$msg['gender']="gender is required";
else
$tx['gender']=$_POST['gender'];

}

?>

<!doctyp html>
<html lang = "en">
<head>
      <title>log Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  	  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	    <link rel="shortcut icon" href="../assets/images/favicon.ico">
<link rel="stylesheet" href="../my.css">

<style>
	  .error{
color:red;
}
      body {
            padding-top: 0px;
            padding-bottom: 0px;
            background-color: #2a4e5f;
			font-family: initial;
			line-height:1.5;
			font-size: 16px;
			
         }
 
		 </style>
 </head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <?php if(isset($_SESSION['u_name'])) 
	     echo "<a class='navbar-brand' href='../index.php'><span class='glyphicon glyphicon-user'></span>".$_SESSION['u_name']."&nbsp;".$_SESSION['u_sname']."</a>";
	     else echo "<a class='navbar-brand' href='#'>ALyaari news</a>";
	     ?>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="../home.php">الرئيسية</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Category<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Import news</a></li>
          <li><a href="#">Today</a></li>
          <li><a href="#">More famious</a></li>
        </ul>
      </li>
 <li><a href="#">About we</a></li>
	  <li><a href="#">About my site</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
<li class="active"><a href=""  onclick="document.getElementById('id01').style.display='block'" ><span class="glyphicon glyphicon-log-in"></span>Admin</a></li>
	 
      <li><a href="../getaccount.php"><span class="glyphicon glyphicon-user"></span> انشاء حساب</a></li>
      <li><a href="../get.php" ><span class="glyphicon glyphicon-log-in"></span> تسجسل الدخول</a></li>
    </ul>
  </div>
</nav>
     
<div class="w3-container">
    <div  id="id01" class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px" >
  
      <div class="w3-center">
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright"
		title="Close Modal">X</span>
        <img src="../images/avatar.png" style="width:20%" class="w3-circle w3-margin-top">
		<h4><span  class="glyphicon glyphicon-log-in ">_Login Admin</span></h4>
      </div>


	   <form class = "w3-container" role = "form" action="loginad.php"method="POST">
        <div class="w3-section">
		  <h4 class = "error" align="center"><?php echo $msg['name']; ?></h4>
		  
          <label><b>Username</b></label>
          <input class="w3-input w3-border w3-margin-bottom" id="name" type="gmail"  name="u_name"
           value="<?php if(isset($_COOKIE['adname']))echo$_COOKIE['adname']; else echo $tx['name'];?>" placeholder="Enter Username" required>
		  
           <input type='text' name='u_sname' value="<?php ;?>" hidden>
		   
		  <label><b>Password</b></label>
          <input  class="w3-input w3-border" id="pass" type="password" name="u_pass" 
		  value="<?php if(isset($_COOKIE['adpass'])) echo $_COOKIE['adpass'];?>" placeholder="Enter Password"   required>
		  <?php 
		  // <datalist id="password">
		// 
		
		 // foreach($_COOKIE as $n=>$p){

		 // echo"<option value='$n=>$p'>";
		 // }
		?>
		  
	
	
		  <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit" name="send">Login</button>
          <input class="w3-check w3-margin-top" type="checkbox" name="remember" checked="checked"> Remember me	
        </div>
  <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
        <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
      </div>     
	 </form>

    

    </div>
  </div>
     

   </body>
</html>









