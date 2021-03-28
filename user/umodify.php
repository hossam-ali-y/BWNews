<?php
   @session_start();
   require_once'../connectdb.php';
   require_once'usermodifycontroller.php';
?>


<!DOCTYPE html>
<html lang="en"><head>
<title>My info personal</title>
  
  
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
	  	<!-- Put favicon.ico and apple-touch-icon(s).png in the images folder -->
	    <link rel="shortcut icon" href="../assets/images/ws_logo.png">
		
  	  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	  <link rel="stylesheet" href="../elusive-icons/elusive-icons.css">
	

<link rel="stylesheet" href="../css/font-awesome.min.css">
  
<link rel="stylesheet" href="../bootstrap/css/icon.css">
<style>
    body {
        color: #566787;
		background: #f5f5f5;
		font-family: 'Varela Round', sans-serif;
		font-size: 16px;
font-family: initial;
	}
	 nav{
color:white;
font-size:16;

}

.img{
		 
		 height:180px;
		 }

.great{
border:1px solid #0a0a5c66;
background-color: #0b7dda;
}
.photo{
width="20%";
height:50px;
}
.photo img{
height:70px;
border-radius:25em 25em;
}	
		 .logout {
		 background-color: #f44336;
		 border: none;
         } 	 
        .logout:hover {
		 background: #da190b;
		 border: none;
		 }
		 
		 .logout{
		 color:white;
		 }


		 #icon{

width:100%;
border:none;
}
div#icon a img{
width:50px;
height:50px;
} 
</style>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
      <div class="navbar-header">
	  <?php if(isset($_SESSION['u_name'])) {
	  echo "<a class='navbar-brand' href='../index.php'>";
	   echo "<span class='glyphicon glyphicon-user'></span>".$_SESSION['u_name']."&nbsp;".$_SESSION['u_sname']."</a>";
		if(isset($_SESSION['u_photo'])){ 
		    $u_photo= $_SESSION['u_photo'];
             echo"<div class='photo'><a class='' href='../user/umodify.php?uid=1'><img src='../$u_photo'></a></div>";
		    }
	     }else 
		 echo "</a><a class='navbar-brand' href='#'>ALyaari news</a>";
	     ?>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="../home.php">Home</a></li>
	   <li class="active"><a href="umodify.php" >المعلومات الشخصية</a></li>
 
  
	  	  <li><a href="../admin/ad.php"><span class="glyphicon glyphicon-log-in"></span>Admin</a></li>
	  <?php if(isset($_SESSION['statue']))   
		  echo "<li><a href='admin/ad.php'>Content Manag</a></li>";?>
         
 
    </ul>
	 Welcom <?php if(isset($_SESSION['status'])) echo "Admin"; else echo "Mr";?> &nbsp;
	<span class='great'> <?php echo $_SESSION['u_name'];?></span>&nbsp;In content managment
   &nbsp;&nbsp;<a href='../accounts/logoutad.php'><button class='btn logout'>log out</button></a>

    <ul class="nav navbar-nav navbar-right">
           <li><a href="#"  onclick="document.getElementById('id01').style.display='block'" ><span class="glyphicon glyphicon-log-in"></span> + add news</a></li>
<li><a href="#">About we</a></li>   
   </ul>
	</div>
  </div>
</nav>
 
		<?php
		
		if(isset($u)){
		$s="select * from user where user_id='$u'";//limit 3
$result=$db->query($s);
$u=$result->fetch();

?>
	<!-- Edit Modal HTML -->
	<div  id="editEmployeeModal" style="display: center;">
		<div class="modal-dialog">
			<div class="modal-content" > 

		<form method="post" action="<?php echo $_SERVER['PHP_SELF']."?uid=1";?>" enctype="multipart/form-data" >
					<div class="modal-header" align="center">		
  <h4 class="modal-title">Edit Employee </h4>
<button type="button" class="close" onclick="document.getElementById('editEmployeeModal').style.display='none'"data-dismiss="modal" aria-hidden="true"title="Close Modal"> X</button>
      <?php
	  echo $msg['user'];
	  if($u['photo']) {
	  ?>
	   <img  class="w3-col" src="<?php echo "../".$u['photo']?>" onclick="document.getElementById('id02').style.display='block'" style="width:60px;border-radius:50%" >  
	      <h4>user_id <?php echo $u['user_id']?></h4>
		   <input id="id02"  type="file" name="photo" style="display:none">
	  <?php
	   }
	   else {
	   ?>
	   <img  class="w3-col" src="../images/avatar.png" onclick="document.getElementById('id02').style.display='block'"style="width:60px;border-radius:50%" >  
   <h4>user_id <?php echo $u['user_id']?>	</h4>   
	   <input id="id02"  type="file" name="photo" style="display:none">
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
					
						<input type="submit" class="btn btn-info" value="save" name="usersave" >
					</div>
				</form>
			</div>
		</div>
	</div>

		<?php
			}
?>
<?php
include"../footer.php"
?>
	</body>
	</html>

<?php
$conn=null;
?>


