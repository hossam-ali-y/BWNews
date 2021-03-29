<?php
   @session_start();
   require_once"connectdb.php";//connect to db newsdb
   require_once"functions.php";
?>
<?PHP
//if($_SERVER["REQUEST_METHOD"]=="POST"){
/*if(isset($_POST['send'])){
$x=$_POST["name"];
$y=$_POST["password"];
$z=$_POST["email"];
echo "<div color='blue'>$x<br>$y<br>$z</div>";

echo "<img src='images/audi.jpg' width='30%'> ";
}*/

$msg['name']=$msg['pass']=$msg['email']=$msg['gender']='';
$tx['name']=$tx['pass']=$tx['email']=$tx['gender']=$tx['cookie']='';
$r=0;
$ms='';
       
if(isset($_POST['send'])){
    $n=$_POST['u_name'];
	$p=$_POST['u_pass'];

TRY{
//include"connectdb.php";//connect to db newsdb
if($db){

  login($n,$p);
  if($r==1){  
    header('location:index.php');  
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
<?php
   @session_start();
 
?>
<!doctyp html>
<html lang = "en">
<head>
      <title>log in</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  	  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	    <link rel="shortcut icon" href="assets/images/favicon.ico">
<link rel="stylesheet" href="my.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
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
	     echo "<a class='navbar-brand' href='index.php'><span class='glyphicon glyphicon-user'></span>".$_SESSION['u_name']."&nbsp;".$_SESSION['u_sname']."</a>";
	     else echo "<a class='navbar-brand' href='#'>ALyaari news</a>";
	     ?>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="home.php">الرئيسية</a></li>
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
	<?PHP
	if(isset($_COOKIE['admin']) || isset($_COOKIE['user'])){
if(isset($_COOKIE['admin']))
  $name=$_COOKIE['admin'];
  else if(isset($_COOKIE['user']))
    $name=$_COOKIE['user'];
?>  
 <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span><?php  echo $name ; ?></a></li>
<?php }?>  
  
<li><a href="admin/ad.php"><span class="glyphicon glyphicon-log-in"></span>Admin</a></li>
      <li><a href="getaccount.php"><span class="glyphicon glyphicon-user"></span>إنشاء حساب </a></li>
      <li class="active"><a href="get.php"  onclick="document.getElementById('id01').style.display='block'" ><span class="glyphicon glyphicon-log-in"></span>  تسجل الدخول</a></li>
    </ul>
  </div>
</nav>
     
<div class="w3-container">
    <div  id="id01" class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:500px" >
  
      <div class="w3-center">
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright"
		title="Close Modal">X</span>
        <img src="images/avatar.png" style="width:20%" class="w3-circle w3-margin-top">
		<h4><span  class="glyphicon glyphicon-log-in ">_تسجيل الدخول(مستخدم)</span></h4>
      </div>


	   <form class = "w3-container" role = "form" action="get.php"method="POST">
        <div class="w3-section">
		  <h4 class = "error" align="center"><?php echo $msg['name'].$ms; ?></h4>
		  
		  <div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
		   <div class="w3-rest">
          <input class="w3-input w3-border" id="name" type="text"  name="u_name"
           value="<?php if(isset($_COOKIE['uname']))echo$_COOKIE['uname']; else echo $tx['name'];?>" placeholder="Enter Username" required>
		  </div>
		  		  </div>
           <input type='text' name='u_sname' value="<?php ;?>" hidden>

			     <div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock"></i></div>
    <div class="w3-rest">
          <input  class="w3-input w3-border" id="pass" type="password" name="u_pass" 
		  value="<?php if(isset($_COOKIE['upass'])) echo $_COOKIE['upass'];?>" placeholder="Enter Password"   required>
		  </div>
		   </div>
		  <?php 
		  // <datalist id="password">
		 // foreach($_COOKIE as $n=>$p){
		 // echo"<option value='$n=>$p'>";
		 // }
		?>
		  <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit" name="send"> تسجيل دخول</button>
          <input class="w3-check w3-margin-top" type="checkbox" name="remember" checked="checked"> تذكرني	
        </div>
		      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">الغاء</button>
        <span class="w3-right w3-padding w3-hide-small">نسيت  <a href="#"> كلمة المرور?</a></span>
      </div>
      </form>
    </div>
  </div>
     

   </body>
</html>








