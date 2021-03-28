
<?php
$ms=$msg['user']='';
$repass=null;
if(isset($_GET['uid']))
$u=$_GET['uid'];
else if(isset($_POST['uid']))
$u=$_POST['uid'];
 if(isset($_SESSION['u_name'])&&$_SESSION['u_pass']){
$name=$_SESSION['u_name'];
$pass=$_SESSION['u_pass'];
$q="select * from user where username=? and password=?";
$stat=$db->prepare($q);	
$stat->bindValue(1,$name);
$stat->bindValue(2,md5($pass));
$stat->execute();
$n=$stat->fetch();
$u=$n['user_id'];

}
/*else
header('location:../home.php');
*/
if(isset($_POST['usersave'])){

$name=$_POST['uname'];
$sname=$_POST['usname'];
$email=$_POST['uemail'];
$gender=$_POST['ugender'];
$oldpass=$_POST['oldp'];
$newpass=$_POST['newp'];
$newepass=$_POST['renewp'];
if(isset($_SESSION['u_photo']))
$new_name=$_SESSION['u_photo'];
else
$new_name=null;

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
$newn=$new_name;
if(! in_array($path,$v_type))
$ms='play out only jpg,png,gif,pdf,mp4 are allowed'; 
else if($fs>$size)
$ms='allowed size is 4 mb or less ';
else if ($fe != 0)
	$ms="error occured:  $fe ";
else{
if(isset($_GET['uid'])){
$newn="../$new_name";
if(move_uploaded_file($ftmp,$newn))
	$ms=",تم تحديث الصورة الشخصية";
	else
	$ms="photo not uploaded"; 
	}

	else {
	if(move_uploaded_file($ftmp,$newn)){
	$ms=",تم تحديث الصورة الشخصية";
	}
	else
	$ms="photo not uploaded"; 
	}
	}
	

        }

			
 $sq="UPDATE user SET username=?,surname=?,email=?,gender=?,photo=?
        WHERE user_id='$u'";

		$state=$db->prepare($sq);	
		 $state->bindValue(1,$name);
		 $state->bindValue(2,$sname);
		 $state->bindValue(3,$email);
		 $state->bindValue(4,$gender);
		 $state->bindValue(5,$new_name);
		 $exec=$state->execute();
	$msg['user']="تم التحديث بنجاح $exec  $ms";

		 if($oldpass&&$newpass&&$newepass){//////تغيير كلمة المروور
			 $repass=1;
		

		 if($oldpass ==$pass && $newpass==$newepass){
		 
		 $npass=MD5($newpass);
	$q="UPDATE user SET password=?
        WHERE user_id='$u'";
		$sta=$db->prepare($q);	
		 $sta->bindValue(1,$npass);
		 $ex=$sta->execute();
		 	if($ex){
			 $_SESSION['u_pass'] =$npass;
			 setcookie('pass',$newpass,time()+60*60*24,"/");
			 if(!isset($_SESSION['status']))
			  setcookie('upass',$newpass,time()+60*60*24,"/");
			 $msg['user']="تم تغيير كلمة المرور بنجاح ";
			 $repass=null;
			 }
		  }
	else if($oldpass != $pass){
	$msg['user']=" كلمة المرور الحالية خطاء!!! اعد كتابتها ";
	$repass=null;
	}
	else if( $newpass!=$newepass){
	$msg['user']=" كلمة المرور غير متطابقة ";
	$repass=null;
	}
		 	}
			else
			$repass=null;
	if($exec){
 $_SESSION['u_photo'] =$new_name;
$_SESSION['u_name'] =$name;
$_SESSION['u_sname'] =$sname;
setcookie('name',$name,time()+60*60*24,"/");
	if(!isset($_SESSION['status']))
			  setcookie('uname',$name,time()+60*60*24,"/");		
	}

}

/*
fetch(PDO: FETCH_ASSOC) // PDO: FETCH_NUM , PDO: FETCH_ASSOC , PDO: FETCH_COLUMN
*/



?>