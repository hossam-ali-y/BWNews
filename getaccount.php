<?php
   @session_start();
    require_once"connectdb.php";//connect to db newsdb
 if(isset($_SESSION['u_name']) && $_SESSION['u_pass']){
         	  header('location:index.php');  
} 
?>

<?php
$ms=$photo=null;
if(isset($_POST['send'])){
	if(!empty($_FILES['photo']['name'])){
$fn= $_FILES['photo']['name'];
$ft= $_FILES['photo']['type'];
$fs= $_FILES['photo']['size'];
$fe= $_FILES['photo']['error'];
$ftmp= $_FILES['photo']['tmp_name'];	
$v_type=['jpg','png','gif','pdf','mp4'];
//pathinfo()

$e=explode(".", $fn);
$path=strtolower(end($e));
 //echo $path;
$size=400000000;
$new_name="user/photo/".uniqid().".$path";
if(! in_array($path,$v_type))
$ms='play out only jpg,png,gif,pdf,mp4 are allowed'; 
else if($fs>$size)
$msg='allowed size is 4 mb or less ';
else if ($fe != 0)
	$ms="error occured:  $fe ";
else{
	if(move_uploaded_file($ftmp,$new_name)){
	$photo=$new_name;
	}
else
	$ms="file not uploaded";  }

}
else
	echo "Your Photo";

}
	

	// mime_content_type($ftmp);
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

function test_input($t){
$t=trim($t);
$t=stripslashes($t);
$t=htmlspecialchars($t);
return $t;
}
$msg['name']=$msg['sname']=$msg['email']=$msg['passw']=$msg['epass']=$msg['phone']=$msg['gender']='';
$tx['photo']=$tx['name']=$tx['sname']=$tx['email']=$tx['passw']=$tx['epass']=$tx['phone']=$tx['gender']='';


if(isset($_POST['send'])){
if(isset($photo))
$tx['photo']=test_input($photo);


if(empty($_POST['u_name']))
$msg['name']="إسم المستخدم مطلوب";
else{
$tx['name']=test_input($_POST['u_name']);
}
//if (!preg_match("/^[a-zA-z]+\D{4}$/", $tx['name']))
	//		$msg['name']="name must star with char and at least 5 char & sympol";
	//if (!preg_match("/^((\w+\W+)|(\W+\w+)).{4,}$/",$tx['pass']))
		//	$msg['pass']="name contiune chars & sympols and at least 6";
if(empty($_POST['u_sname']))
$msg['sname']="مطلوب ";
else{
$tx['sname']=test_input($_POST['u_sname']);

}

if(empty($_POST['u_email']))
$msg['email']="";
else{
$validemail=preg_match("/(.+)@([^\.].*)\.([a-z]{2,})/",$_POST['u_email']);
if(!$validemail)
$msg['email']="خاطئ";
else
$tx['email']=test_input($_POST['u_email']);

}

if(empty($_POST['u_pass']))
$msg['passw']="كلمة المرور مطلوبة";
else{
$validpass=true;
$tx['passw']=test_input($_POST['u_pass']);
}
$validepass=false;
if(empty($_POST['u_epass'])){
$msg['epass']="اعد كتابة كلمة المرور ";
}
else{
if($_POST['u_epass']==$_POST['u_pass']&&$validpass){
$validepass=true;
$tx['epass']=test_input($_POST['u_epass']);
}
else if($_POST['u_epass']==$_POST['u_pass']&&!$validpass)
$msg['epass']="اعد كتابة كلمة المرور";
else
$msg['epass']="كلمة المرور غير مطابقة";
}

if(empty($_POST['u_phone'])){
$msg['phone']="رقم الهاتف مطلوب";
#$validphone=true;
}
else{
$tx['phone']=test_input($_POST['u_phone']);
}

if(empty($_POST['u_gender']))
$msg['gender']="الجنس ";
else
$tx['gender']=test_input($_POST['u_gender']);


if($_POST['u_epass']!=''&&$_POST['u_gender']!=''&&$_POST['u_phone']
&&$validpass&&$validepass){
$name=$_POST['u_name'];
$pass=$_POST['u_pass'];
$sname=$_POST['u_sname'];

if(isset($_POST['u_email']))
$email=$_POST['u_email'];
else
$email='';

$phone=$_POST['u_phone'];
$gender=$_POST['u_gender'];

// $db=new mysqli("localhost","root","","newsdb");
try{
$db->begintransaction();
      $sql="INSERT INTO user (photo,username,password,surname,email,gender,phonenumber) values(?,?,?,?,?,?,?)";
         $state=$db->prepare($sql);	
	     $state->bindValue(1,$photo);
		 $state->bindValue(2,$name);
		 $state->bindValue(3,md5($pass));
		 $state->bindValue(4,$sname);
		 $state->bindValue(5,$email);
		 $state->bindValue(6,$gender);
		 $state->bindValue(7,$phone);
		 $exec=$state->execute();

	
	 if(!$exec){
	   $msg['name']="this username ".$name." has_Useing";
		
		
		}
	  else{

	      $q="SELECT photo,username,surname,password,status FROM user where username=?";
         $res=$db->prepare($q);
		 $res->bindValue(1,$name);
		 $res->execute();
         $r=$res->fetch();
		 $db=null;
						echo "you have registered";
						if($r['photo']!=null)
			          $_SESSION['u_photo'] =$r['photo'];
					  
             $_SESSION['u_name'] =$r['username'];
		     $_SESSION['u_sname'] =$r['surname'];
			 $_SESSION['u_pass'] =$pass ;
			 if($r['status']==1){
			 $_SESSION['status'] = $r['status'];
			 }
			 if(isset($_POST['remember'])){  //cookie set
		     setcookie('name',$name,time()+60*60*24,"/");
			 setcookie('pass',$pass,time()+60*60*24,"/");
			 
                 }
			 
		 header("location:index.php");
	    }
    }
	 CATCH(PDOException $e){
	 $db->rollback();
 $msg['name'] ="invalid connection";
die($e->getMessage());
			 }
}

}

?>
<?php
   @session_start();
?>

<!doctyp html>
<html lang = "en">
<head>
<title>SignUp</title>
<meta name="viewport" content="width=device-width, initial-scale=1">


<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  	  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	    <link rel="shortcut icon" href="assets/images/favicon.ico">
<link rel="stylesheet" href="my.css" >
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
			line-height:0;
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
 <li><a href="admin/ad.php"><span class="glyphicon glyphicon-log-in"></span>Admin</a></li>
      <li class="active"><a href="getaccount.php"><span class="glyphicon glyphicon-user"></span> انشاء حساب</a></li>
      <li><a href="get.php" ><span class="glyphicon glyphicon-log-in"></span> تسجيل الدخول</a></li>
    </ul>
	  
  </div>

</nav>


<div class="w3-container">
    <div  id="id01" class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
 
 <form action="<?php echo  $_SERVER['PHP_SELF'];?>" role = "form" method="post" class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin" enctype="multipart/form-data" >
  <div class="w3-center">
  <h3><span  class="glyphicon glyphicon-user">اكتب بياناتك</span>
<span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal"> X</span>
        <span id="m"><?php echo $ms; ?></span>
	    <img  class="w3-col" src="images/avatar.png" onclick="document.getElementById('id02').style.display='block'"style="width:50px;border-radius:50%" >  
	 <h6  class="w3-col" style="text-align:left;" onclick="document.getElementById('id02').style.display='block'">أضف صورة شخصية ستظهر على اسم حسابك</h6> 
	 <input id="id02"  type="file" name="photo" style="display:none">

	 </h3>
 </div>
  

        

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" type="text" name="u_name" value="<?php if($msg['name'])$tx['name']=''; else echo $tx['name'];?>"
	  placeholder="<?php if($msg['name']!='') echo $msg['name'];else echo'اسم المستخدم';?>" required autofocus>
    </div>
</div>



<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" type="text" name="u_sname" value="<?php echo $tx['sname'];?>"
	  placeholder="اللقب <?php echo $msg['sname'];?>" required>
    </div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" type="email" name="u_email"  value="<?php echo $tx['email'];?>" 
	  placeholder="الإيميل <?php echo $msg['email'];?>">
    </div>
</div>

  <div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" type="password" name="u_pass" 
	   value="<?php echo $tx['passw'];?>" 
	  placeholder="<?php if($msg['passw']!='')echo $msg['passw']; else echo"كلمة المرور"?>" required >
    </div>
</div>

  <div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" type="password" name="u_epass"  
	   value="<?php if($tx['epass']!=''){echo $tx['epass'];}?>" 
	  placeholder="<?php if($msg['epass']!='')echo $msg['epass']; else {echo "اعد كتابة كلمة المرور";}?>" required>
	</div>
</div>

<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-phone"></i></div>
    <div class="w3-rest">
      <input class="w3-input w3-border" type="tel" name="u_phone" 
	  	  value="<?php echo $tx['phone'];?>"
	  placeholder="<?php if($msg['phone']!='')echo $msg['phone']; else {echo "رقم الهاتف";}?>" required   
>
    </div>
</div>

<div class="w3-row w3-section" >
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-"></i></div>
   
   <div class="w3-rest" dir="rtl">
	الجنس: 
<input type='radio' name='u_gender' value='male'
<?php if($tx['gender']=='male')echo 'checked'?> required>
 ذكر 
<input type='radio' name='u_gender' value='female' 
<?php if($tx['gender']=='female')echo 'checked';?> required>
انثى
<span class="error"><?php echo $msg['gender'];?>
    </div>
</div>
          <input class="w3-check w3-margin-top" type="checkbox" name="remember" checked="checked">تذكرني
<p class="w3-center">

<input class="w3-button  w3-green w3-section w3-padding" type="submit" value="إنشاء" name="send">
     <input type="button" class="w3-button w3-red" type="reset" value="الغاء">
       
</p>
</form>

</div>
</div>
</body>
</html>

