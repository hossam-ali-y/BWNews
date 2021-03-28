<?PHP

//login controller

$msg['img']=$msg['post']=$msg['name']=$msg['delnews']=$msg1='';
$imgid=$newname=$headline='';

if(isset($_GET['msg']))
$msg['post']=$_GET['msg'];

$msg['name']=$msg['pass']=$msg['email']=$msg['gender']='';
$tx['name']=$tx['pass']=$tx['email']=$tx['gender']=$tx['cookie']='';
$r=0;
$ms='';
       $nid='';
if(isset($_POST['log'])){
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
//end login controller
////////////////////////////////////////////////////////
//begin signup controller

$ms=$photo=null;
if(isset($_POST['sign'])){

 if(isset($_SESSION['u_name']) && $_SESSION['u_pass']){
         	  header('location:index.php');  
} 

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
	


$msg['name']=$msg['sname']=$msg['email']=$msg['passw']=$msg['epass']=$msg['phone']=$msg['gender']='';
$tx['photo']=$tx['name']=$tx['sname']=$tx['email']=$tx['passw']=$tx['epass']=$tx['phone']=$tx['gender']='';


if(isset($_POST['sign'])){
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
      $sqluser="INSERT INTO user (photo,username,password,surname,email,gender,phonenumber) values(?,?,?,?,?,?,?)";
         $state=$db->prepare($sqluser);	
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
//begin signup controller

?>



  <script type="text/javascript">
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});
</script>
 
<?php

//////////////////////////////Modal Html//////////////////////////////////////////////////////////////
//	 Edit user_info Modal
if(isset($u)){
		$s="select * from user where user_id='$u'";//limit 3
$result=$db->query($s);
$u=$result->fetch(); 
	 	 if(isset($_GET['nid']))
	 $nid=$_GET['nid'];
?>

	<!-- Edit user_info Modal HTML -->
	<div  id="edituserModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content" > 

		<form method="post" action="<?php if(isset($_GET['nid'])){echo $_SERVER['PHP_SELF']."?nid=".$nid;}else echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" >
					<div class="modal-header" align="center">		
  <h4 class="modal-title"> تعديل الملف الشخصي</h4>
  <button type="button" class="w3-button w3-xlarge w3-transparent w3-display-topright"  onclick="document.getElementById('edituserModal').style.display='none'"
data-dismiss="modal" aria-hidden="true" title="Close Modal"> X</button>

   <?php
	  if($u['photo']) {
	  ?>
	   <img  class="w3-col" src="<?php echo $u['photo']?>" onclick="document.getElementById('id03').style.display='block'" style="width:60px;border-radius:50%" >  
	      <h4>user_id <?php echo $u['user_id']?></h4>
		   <input id="id03"  type="file" name="photo" style="display:none">
	  <?php
	   }
	   else {
	   ?>
	   <img  class="w3-col" src="images/avatar.png" alt="photo"onclick="document.getElementById('id03').style.display='block'"style="width:60px;border-radius:50%" >  
   <h4>user_id <?php echo $u['user_id']?>	</h4>   
	   <input id="id03"  type="file" name="photo" style="display:none">
	   <?php
	   }

	   ?>				</div>
					 
					<div class="modal-body">
					
					<input class="form-control"  type="text" name="uid"  value="<?php echo $u['user_id']?> " style="display:none" >
							
						<div class="form-group">
						    <label>Name</label>
							<input class="form-control" required="" type="text" name="uname" value="<?php echo $u['username']?>" placeholder="إسم المستخدم">
						</div>
						<div class="form-group">
						    <label>SurName</label>
							<input class="form-control" required="" type="text" name="usname" value="<?php echo $u['surname']?>" placeholder="اللقب">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input class="form-control"  type="email" name="uemail" value="<?php echo $u['email']?>" placeholder="الأيميل">
						</div>
						
						<li class="btn btn-default" onclick="document.getElementById('repa').style.display='block'">
						تغيير كلمة المرور</li>
							<div id="repa" style="display:none">
						
						&nbsp;	<input class="form-control"  type="password" name="oldp" value="" placeholder="كلمة المرور الحالية">
						
							&nbsp; <input class="form-control" type="password" name="newp" value="" placeholder="كلمة المرور الجديدة">
							 
							&nbsp;<input class="form-control" type="password" name="renewp"value="" placeholder="تأكيد كلمة المرور">
						
						</div>
						
					
						<div class="form-group">
							<label>Gender</label>
        Male  <input class="" required="" type="radio" name="ugender" 
        value="male" <?php if($u['gender']=='male') echo 'checked'; ?> >
    
       Female  <input class="" required=""  type="radio" name="ugender" 
       value="female" <?php if($u['gender']=='female') echo 'checked'; ?> >
   
						</div>
										
					</div>
						<div class="modal-footer">
						<input class="btn btn-default" data-dismiss="modal" value="back" type="reset">
					<a href="#conf" data-toggle="modal" ><div class="btn btn-info" value="save" >save</div></a>

					</div>

			</div>
		</div>
	</div>

		<?php
	}
?>
	<!-- confirm -->
	<div id="conf" class="modal fade" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				
					<div class="modal-header">						
						<h4 class="modal-title">Save Change</h4>
						<button type="button" class="w3-button w3-xlarge w3-transparent w3-display-topright"
                     data-dismiss="modal" aria-hidden="true" title="Close Modal"> X</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to save change on your informaion - ?</p>
						<p class="text-warning"><small>cancle to unsave</small></p>
					</div>
					<div class="modal-footer">
		         	<input type="submit" class="btn btn-info" value="save" name="usersave" >
						<input class="btn btn-default" name="cancel"data-dismiss="modal" value="Cancel" type="button">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- //end user_ifo modal////////////////////////// -->
<!-- login modal -->
<div id="login" class="modal fade" style="display:none;">

	<div class="modal-dialog">

    <div  id="id01" class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px" >
  
      <div class="w3-center">
	  <span  data-dismiss="modal" aria-hidden="true" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal"> X</span>

        <img src="images/avatar.png" style="width:20%" class="w3-circle w3-margin-top">
		<h4><span  class="glyphicon glyphicon-log-in ">_تسجيل الدخول(مستخدم)</span></h4>
      </div>


	   <form class = "w3-container" role = "form" action="<?php echo $_SERVER['PHP_SELF']."?nid=".$nid;?>" method="POST">
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
		  <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit" name="log" value=""> تسجيل دخول</button>
          <input class="w3-check w3-margin-top" type="checkbox" name="remember" checked="checked"> تذكرني	
        </div>
		      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
			 
        <button type="resete" class="w3-button w3-red">الغاء</button>
        <span class="w3-right w3-padding w3-hide-small">نسيت  <a href="#"> كلمة المرور?</a></span>
      </div>
      </form>
    </div>
	</div>
  </div>
  <!--end login modal-->
			<!--start logout modale-->
	<div id="logoutmodal" class="modal fade" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
					<div class="modal-header">						
						<h4 class="modal-title">Log Out</h4>
												<button type="button" class="w3-button w3-xlarge w3-transparent w3-display-topright"
                                         data-dismiss="modal" aria-hidden="true" title="Close Modal"> X</button>
					</div>
					<div class="modal-body">					
						<p>هل تريد تسجيل الخروج من حسابك؟</p>
						<p class="text-warning"><small>clear cookies لحذف ايقونة اختصار إستعادة الولوج</small></p>
					</div>
					<div class="modal-footer">
	 <a href='accounts/deletecookie.php' class="" data-toggle="modal"> <button class='btn btn-danger'>Clear cookies</button></a>
		  <?php if(isset($_SESSION['statue'])){ 
		  ?>
		                  <a href='accounts/logoutad.php' class='' data-toggle='modal'> <button class='btn btn-default'>تسجيل الخروج</button></a>
                      <?php  
					  }		
				else{  
				?>
						<a href='accounts/logout.php' class="" data-toggle='modal'> <button class='btn btn-default'>تسجيل الخروج</button></a>
				<?php 
				}?>
					</div>
			</div>
		</div>
	</div>
	
	</form>
	  </div>
	  <!--end logout modal-->
			  
  
  <!--sign up modal-->
  <div id="sign_up" class="modal fade " style="display: none;">
	<div class="modal-dialog">
    <div  id="id02" class="w3-modal-content w3-card-4 w3-animate-zoom " style="max-width:500px">
 
 <form action="<?php echo  $_SERVER['PHP_SELF']."?nid=".$nid;?>" role = "form" method="post" class="w3-container w3-card-4 w3-light-grey w3-text-blue " enctype="multipart/form-data" >
  <div class="w3-center">
  <h3><span  class="glyphicon glyphicon-user">اكتب بياناتك</span>

<span  data-dismiss="modal" aria-hidden="true" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal"> X</span>
        <span id="m"><?php echo $ms; ?></span>
	    <img  class="w3-col" src="images/avatar.png" onclick="document.getElementById('addphoto').style.display='block'"style="width:50px;border-radius:50%" >  
	 <h6  class="w3-col" style="text-align:left;" onclick="document.getElementById('addphoto').style.display='block'">أضف صورة شخصية ستظهر على اسم حسابك</h6> 
	 <input id="addphoto"  type="file" name="photo" style="display:none">

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
	  placeholder="<?php if($msg['phone']!='')echo $msg['phone']; else {echo "رقم الهاتف";}?>" required  >
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
         
<div class="w3-center">
 <input class="w3-check w3-margin-top" type="checkbox" name="remember" checked="checked">تذكرني
<input class="w3-button  w3-green w3-section w3-padding" type="submit" value="إنشاء" name="sign">
 <button type="resete" class="w3-button w3-red">الغاء</button>
       
</div>
</form>
</div>
</div>
</div>
<!--end signup modal-->
<!-- adduser Modal HTML -->
	<div id="addEmployeeModal" class="modal fade" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
			<form action="<?php echo  $_SERVER['PHP_SELF'];?>" method="post">
					<div class="modal-header">						
						<h4 class="modal-title">Add Employee</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">׼</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Name</label>
							<input class="form-control" required="" type="text">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input class="form-control" required="" type="email">
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea class="form-control" required=""></textarea>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input class="form-control" required="" type="text">
						</div>					
					</div>
					<div class="modal-footer">
						<input class="btn btn-default" data-dismiss="modal" value="Cancel" type="button">
						<input class="btn btn-success" value="Add" type="submit">
					</div>
				</form>
			</div>
		</div>
	</div>

	
  	<!-- addnews Modal HTML //////////////////////////////////////-->
<div   id="AddNewsModal" class="modal fade" style="display: none;" >
	<div class="modal-dialog">

    <div  id="id01" class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px" >
     <form class = "w3-container" role = "form" action="<?php echo  $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data"  method="post">
       
      <div class="w3-center">

				<button type="button" class="w3-button w3-xlarge w3-transparent w3-display-topright"
                data-dismiss="modal" aria-hidden="true" title="Close Modal"> X</button>
		
        <img src="" style="width:20%" class="w3-circle w3-margin-top">
		<h4><span  class="glyphicon glyphicon">+ضافة منشور post</span></h4>
      </div>

     <div class="w3-section">
		  <h4 class = "error" align="center"><?php echo $msg['post']; ?></h4>
       category 
<select class = "form-control" name="postname">
<option>social</option>
<option>local</option>
<option>sport</option>
<option>education</option>
<option>economic</option>
</select><br>
	
	
        headline<textarea class = "form-control"  type='text' name='headline' rows="1" > </textarea><br>	
		report<textarea class = "form-control"  type='text' name='report' rows="1" >   </textarea>	<br>

			<li class="btn btn-default" onclick="document.getElementById('addimg').style.display='block'">
						إضافة صورة</li>
							<div id="addimg" style="display:none">
							   <input type="file" name="img">
							   	<span id="m"><?php echo $msg['img']; ?></span><br>
						</div>

 <input class="w3-button w3-block w3-green w3-section w3-padding" type="submit" name="send">
		  </div>
		  </form>
		  </div>
		  </div>
		    </div>
<!-- end addnews Modal HTML //////////////////////////////////-->

