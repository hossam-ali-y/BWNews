<?php
function test_input($t){
$t=trim($t);
$t=stripslashes($t);
$t=htmlspecialchars($t);
return $t;
}
///////////////////////////////
function delete_news($db){
$msg='';
	$sqldel="delete from news where news_id={$_POST['news_id']}";
	if(isset($_POST['img_id'])){
	$sql1="delete from images where img_id={$_POST['img_id']}";
	if($del=$db->exec($sqldel) && $db->exec($sql1))
		$msg="$del post deleted with image";
	else
		 $msg="post and image not deleted ";		
	}
	else{
	if($del=$db->exec($sqldel))
		$msg="$del post deleted and no image";
	else
		 $msg="post not deleted";	
		}
		return $msg;
}
/////////////////////////////////////////////////
function login($name,$pass){
global $db;
global $result;
global $result1;
global   $ms;
global $r;
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
	if($row['username']&& $row1['password']){
		/* if(isset($_SESSION['u_name']) || $_SESSION['status']) {
			include"accounts/logout.php";
		} */
		if(isset($_SESSION['u_name']) || isset($_SESSION['status'])) {
	unset($_SESSION["u_sname"]);
   unset($_SESSION["u_pass"]);
   if(isset($_SESSION["status"]))
    unset($_SESSION["status"]);
   if(isset($_SESSION['u_photo']))
     unset($_SESSION['u_photo']);
	  if(isset($_COOKIE['admin'])){
     setcookie('admin',null,time()+60*60*24*360,"/");
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

	  if(isset($_POST['remember'])){  //cookie set
		setcookie('name',$name,time()+60*60*24*360,"/");
		setcookie('pass',$pass,time()+60*60*24*360,"/");
		setcookie('user',$name,time()+60*60*24*360,"/");
		setcookie('uname',$name,time()+60*60*24*360,"/");
		setcookie('upass',$pass,time()+60*60*24*360,"/");
			}	 
			$r=1;
   } 
   else if($row['username'] && !$row1['password'])
   $ms= 'Wrong password';
   else
	$ms = 'Invalid User With <b>'.$name.'</b>&nbsp;pleas SignUp';
	//$result=getResult();
}

 
}
?>