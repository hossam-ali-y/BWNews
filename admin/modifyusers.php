<?php
   @session_start();
       include"../connectdb.php";//connect to db newsdb
   require '../accounts/checkAuthrizedad.php';
 //     require_once'../user/usermodifycontroller.php';
    require_once'../modal.php';
	

function getuid(){
global $get_uid;
global $db;
global $su;
global $w;
$w="document.getElementById('get_uid').value";
   $sq="select * from user where user_id=".$w;
   $res=$db->query($sq);
   if($res){
   $su=$res->fetch();
   }
   }
   
$msg='';
$ms='';

?>

<?php
if(isset($_GET['msg']))
$msg=$_GET['msg'];
////////////////////////استرجاع بيانات المستخدمين  
   $q="select * from user order by user_id asc";
   $result=$db->query($q);	
   
   ////////////////////////////////////استرجاع عدد العدد الكلي للمستخدمين
  $qc="select count(*) from user ";
   $res=$db->query($qc);
   $users=$res->fetch();
 $count_users=$users[0];
 /////////////////////////////////////////////////////////
 
if(isset($_POST['delete']))
{

$id=$_POST['u_id'];
$name=$_POST['u_name'];
	$sql="delete from user  where user_id in(?)";
			$state=$db->prepare($sql);	
		 $state->bindValue(1,$id);
		 $ec=$state->execute();
	if($ec==1){
	$msg="user $name whith id ".$id." deleted";
//	header("location:modifyusers.php?msg=$msg");
	}else
		$msg="not deleted";	
		   header("location:modifyusers.php?msg=$msg");
}

/*
if(isset($_GET['uid']))
$u=$_GET['uid'];
else if(isset($_POST['uid']))
$u=$_POST['uid'];


else
header('location:../home.php');
*/

if(isset($_POST['save'])){
$u=$_POST['u_id'];
if(isset($_POST['photopath']))
$photo=$_POST['photopath'];
else
$photo=null;
if(isset($_POST['u_phone']))
$phone=$_POST['u_phone'];
else
$phone=null;
if(isset($_POST['u_email']))
$email=$_POST['u_email'];
else
$email=null;

$name=$_POST['u_name'];
$sname=$_POST['u_sname'];
$gender=$_POST['u_gender'];
$status=$_POST['status'];
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
$new_name="../user/photo/".uniqid().".$path";
if(! in_array($path,$v_type))
$ms='play out only jpg,png,gif,pdf,mp4 are allowed'; 
else if($fs>$size)
$ms='allowed size is 4 mb or less ';
else if ($fe != 0)
	$ms="error occured:  $fe ";
else{
	if(move_uploaded_file($ftmp,$new_name)){
	$ex=explode("../",$new_name);
    $photo=strtolower(end($ex));
	$ms="تم تحديث الصورة الشخصية";
	}
else
	$ms="photo not uploaded"; 
	}
	        }

			
 $sql="UPDATE user SET username=?,surname=?,email=?,gender=?,photo=?,phonenumber=?,status=?
        WHERE user_id=?";

		$state=$db->prepare($sql);	
		 $state->bindValue(1,$name);
		 $state->bindValue(2,$sname);
		 $state->bindValue(3,$email);
		 $state->bindValue(4,$gender);
		 $state->bindValue(5,$photo);
		 $state->bindValue(6,$phone);
		 $state->bindValue(7,$status);
		 $state->bindValue(8,$u);
		 $exec=$state->execute();


	if($exec){
   $msg="$exec تم التحديثه بنجاح $u المستخدم رقم , $ms";
   header("location:modifyusers.php?msg=$msg");
	}
	else 
	$msg="$exec تم تغيير  , $ms";
}

/*
fetch(PDO: FETCH_ASSOC) // PDO: FETCH_NUM , PDO: FETCH_ASSOC , PDO: FETCH_COLUMN
*/

?>
<?php


/*
if(isset($_POST['save'])&&$db){
$uid=$_POST['uid'];
$name=$_POST['uname'];
$sname=$_POST['usname'];
$email=$_POST['uemail'];
$pass=$_POST['upass'];
$gender=$_POST['ugender'];
 $l="UPDATE user SET username=?,surname=?,email=?,gender=?
        WHERE user_id=?";
        
		$state=$db->prepare($l);	
		 $state->bindValue(1,$name);
		 $state->bindValue(2,$sname);
		 $state->bindValue(3,$email);
		 $state->bindValue(4,$gender);
		 $state->bindValue(5,$uid);
		 $exec=$state->execute();
	
	if($exec){
	$msg="$exec update sucsessfully ";
	header("location:modifyusers.php?msg=$msg");
	}
	else 
$msg="something wrong ";
}*/
?>

<!DOCTYPE html>
<html lang="en"><head>
<title>Users Admin </title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="../bootstrap/js/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>

	  	<!-- Put favicon.ico and apple-touch-icon(s).png in the images folder -->
  	  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	  <link rel="stylesheet" href="../elusive-icons/elusive-icons.css">
	 <link rel="shortcut icon" href="../assets/images/ws_logo.png">
	
<link rel="stylesheet" href="../css/font-awesome.min.css">
<link rel="stylesheet" href="../bootstrap/css/icon.css">
	

<style type="text/css">
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
	.table-wrapper {
        background: #fff;
        padding: 20px 25px;
        margin: 30px 0;
		border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
	.table-title {        
		padding-bottom: 15px;
		background: #435d7d;
		color: #fff;
		padding: 16px 30px;
		margin: -20px -25px 10px;
		border-radius: 3px 3px 0 0;
    }
    .table-title h2 {
		margin: 5px 0 0;
		font-size: 24px;
	}
	.table-title .btn-group {
		float: right;
	}
	.table-title .btn {
		color: #fff;
		float: right;
		font-size: 13px;
		border: none;
		min-width: 50px;
		border-radius: 2px;
		border: none;
		outline: none !important;
		margin-left: 10px;
	}
	.table-title .btn i {
		float: left;
		font-size: 21px;
		margin-right: 5px;
	}
	.table-title .btn span {
		float: left;
		margin-top: 2px;
	}
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
		padding: 12px 15px;
		vertical-align: middle;
    }
	table.table tr th:first-child {
		width: 60px;
	}
	table.table tr th:last-child {
		width: 100px;
	}
    table.table-striped tbody tr:nth-of-type(odd) {
    	background-color: #fcfcfc;
	}
	table.table-striped.table-hover tbody tr:hover {
		background: #f5f5f5;
	}
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }	
    table.table td:last-child i {
		opacity: 0.9;
		font-size: 22px;
        margin: 0 5px;
    }
	table.table td a {
		font-weight: bold;
		color: #566787;
		display: inline-block;
		text-decoration: none;
		outline: none !important;
	}
	table.table td a:hover {
		color: #2196F3;
	}
	table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #F44336;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table .avatar {
		border-radius: 50%;
		vertical-align: middle;
		margin-right: 10px;
	}
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }
    .pagination li a:hover {
        color: #666;
    }	
    .pagination li.active a, .pagination li.active a.page-link {
        background: #03A9F4;
    }
    .pagination li.active a:hover {        
        background: #0397d6;
    }
	.pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }    
	/* Custom checkbox */
	.custom-checkbox {
		position: relative;
	}
	.custom-checkbox input[type="checkbox"] {    
		opacity: 0;
		position: absolute;
		margin: 5px 0 0 3px;
		z-index: 9;
	}
	.custom-checkbox label:before{
		width: 18px;
		height: 18px;
	}
	.custom-checkbox label:before {
		content: '';
		margin-right: 10px;
		display: inline-block;
		vertical-align: text-top;
		background: white;
		border: 1px solid #bbb;
		border-radius: 2px;
		box-sizing: border-box;
		z-index: 2;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		content: '';
		position: absolute;
		left: 6px;
		top: 3px;
		width: 6px;
		height: 11px;
		border: solid #000;
		border-width: 0 3px 3px 0;
		transform: inherit;
		z-index: 3;
		transform: rotateZ(45deg);
	}
	.custom-checkbox input[type="checkbox"]:checked + label:before {
		border-color: #03A9F4;
		background: #03A9F4;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		border-color: #fff;
	}
	.custom-checkbox input[type="checkbox"]:disabled + label:before {
		color: #b8b8b8;
		cursor: auto;
		box-shadow: none;
		background: #ddd;
	}
	/* Modal styles */
	.modal .modal-dialog {
		max-width: 400px;
	}
	.modal .modal-header, .modal .modal-body, .modal .modal-footer {
		padding: 20px 30px;
	}
	.modal .modal-content {
		border-radius: 3px;
	}
	.modal .modal-footer {
		background: #ecf0f1;
		border-radius: 0 0 3px 3px;
	}
    .modal .modal-title {
        display: inline-block;
    }
	.modal .form-control {
		border-radius: 2px;
		box-shadow: none;
		border-color: #dddddd;
	}
	.modal textarea.form-control {
		resize: vertical;
	}
	.modal .btn {
		border-radius: 2px;
		min-width: 100px;
	}	
	.modal form label {
		font-weight: normal;
	}	

</style>
<script type="text/javascript">
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	$("#editEmployeeModal").hide();
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
			$("#selectAll").prop("checked",false);
		}
	});
	
	/*	$(".edit").click(function(){

<?php

//$get_uid="document.getElementById('getuid').value";
   $sq="select * from user where user_id=".$get_uid;
   $su=$db->query($sq);	 
?>  
});
*/
});
</script>
</head>
<body style="" class="">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
      <div class="navbar-header">
	  <?php if(isset($_SESSION['u_name'])) {
	  echo "<a class='navbar-brand' href='../index.php'>";
	   echo "<span class='glyphicon glyphicon-user'></span>".$_SESSION['u_name']."&nbsp;".$_SESSION['u_sname']."</a>";
		if(isset($_SESSION['u_photo'])){ 
		    $u_photo= $_SESSION['u_photo'];
             echo"<div class='photo'><a class='' href='../user/umodify.php'><img src='../$u_photo'></a></div>";
		    }
	     }else 
		 echo "</a><a class='navbar-brand' href='#'>ALyaari news</a>";
	     ?>
    </div>
    <ul class="nav navbar-nav">

      <li><a href="../home.php">Home</a></li>

		  <?php if(isset($_SESSION['statue']))   
		  echo "<li><a href='admin/ad.php'>Content Manag</a></li>";?>
        <li><a href="../user/umodify.php" title="<?php echo ' البيانات الشخصية ل '.$_SESSION['u_name']?>" data-toggle="modal" >المعلومات الشخصية</a></li>
     
	  	  <li><a href="ad.php"><span class="glyphicon glyphicon-log-in"></span>ContentManagment</a></li>
	      <li class="active"><a href="modifyusers.php">users managment</a></li>

    </ul>
	 Welcom <?php if(isset($_SESSION['status'])) echo "Admin"; else echo "Mr";?> &nbsp;
	<span class='great'> <?php echo "<i background-color='blue'>".$_SESSION['u_name']."</i>";?></span>&nbsp;In content managment
   &nbsp;&nbsp;<a href='../accounts/logoutad.php'><button class='btn logout'>log out</button></a>

    <ul class="nav navbar-nav navbar-right">
           <li><a href="#"  onclick="document.getElementById('id01').style.display='block'" ><span class="glyphicon glyphicon-log-in"></span> + add news</a></li>
<li><a href="#">About we</a></li>   
   </ul>
	</div>
  </div>
</nav>
     
	 
    <div class="container">
        <div id="table-wrapper" class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Users</b></h2>
					</div>
					<div class="col-sm-6">
					<b><?php if(isset($_GET['msg'])){$msg=$_GET['msg']; echo $msg;}else echo $msg?></b>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Add New Employee</span></a>
						<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons"></i> <span>Delete</span></a>						
					</div>
                </div>
            </div>
            <table id="table-hover"class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>
							<span class="custom-checkbox">
	                            <input id="selectAll" type="checkbox">
								<label for="selectAll"></label>
							</span>
						</th>
						<th>user_id</th>
						<th class="photo">photo</th>
                        <th>Name</th>
						<th>Email</th>
						<th>phone</th>
						<th>Status</th>
                        <th>gender</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
					<?php
					 $i=0;
foreach($result as $r){
 $i++;
$id=$r['user_id'];
?>
         		  <form class = "w3-container" role = "form" action="<?php echo  $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data"  method="post">
                    <tr>
						<td>
							<span class="custom-checkbox">
								<input id="checkbox<?php echo $r['user_id']?>" name="options[]" value="<?php echo $r['user_id']?>" type="checkbox">
								<label for="checkbox<?php echo $r['user_id']?>"></label>
							</span>
						</td>
                        <td><?php echo $r['user_id']?></td>
                        <td><?php
						if($r['photo']){ ?>
						<img  class="w3-col" src="../<?php echo $r['photo']?>" alt="photo" title="<?php echo $r['username']?> profile" style="width:50px;border-radius:50%"> 
						<?php
						}
						else{
						?>
					<img  class="w3-col" src="../images/avatar.png?>" alt="no photo" title="<?php echo $r['username']?> hasn't profile" style="width:50px;border-radius:50%"> 
						<?php 
						}?></td>
						<td><?php echo $r['username']?></td>
                        <td><?php echo $r['email']?></td>
						<td><?php echo $r['phonenumber']?></td>
					 <td><?php echo $r['status']?></td>
						 <td><?php echo $r['gender']?></td>
                        <td>
						 <a href="#editEmployeeModal"  onclick="
<?php
//$get_uid="document.getElementById('getuid').value";
   $sql11="select * from user where user_id=".$r['user_id'];
   $res=$db->query($sql11);	 
?>  
						 " class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="" data-original-title="Edit" ></i></a>
                            <a href="#deleteEmployeeModal<?php echo $id;?>" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="" data-original-title="Delete"></i></a>
                    
						                   
					   </td>
					 
                           
                    </tr>  
		<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal<?php echo $id;?>" class="modal fade" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				
					<div class="modal-header">						
						<h4 class="modal-title">Delete user</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete user -<?php echo $r['username']?>- ?</p>
						<p class="text-warning"><small>cancle to undelete</small></p>
					</div>
					  <form class = "w3-container" role = "form" action="<?php echo  $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data"  method="post">
                  
					<div class="modal-footer">
					<input   name="u_name" value="<?php echo $r['username'];?>" type="hidden">
					<input   name="u_id" value="<?php echo $id;?>" type="hidden">
						<input class="btn btn-default" name="cancel"data-dismiss="modal" value="Cancel" type="button">
						<input class="btn btn-danger"  name="delete" value="Delete" type="submit">
					</div>
				</form>
			</div>
		</div>
	</div>
	
			
<?php
	}?>	
					
                </tbody>
            </table>
			
								<!-- Edit Modal HTML -->
<script>

</script>
<input  type="text" name="get_uid" value="" >
<?php foreach($res as $su){ ?>
	<div id="editEmployeeModal" class="modal fade" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
			<form class = "w3-container" role = "form" action="<?php echo  $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data"  method="post">
                 
					<div class="modal-header">						
						<h4 class="modal-title">Edit Employee</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						      <?php
	  if($su['photo']) {
	  ?>
	   <img  class="w3-col" src="<?php echo "../".$su['photo']?>" onclick="document.getElementById('id1<?php echo $su['user_id'];?>').style.display='block'" style="width:60px;border-radius:50%" >  
	      <h4>user_id <?php echo $su['user_id'];?></h4>
		  <input type="hidden" name="photopath" value="<?php echo $su['photo']?>">
	  <?php
	   }
	   else {
	   ?>
	   <img  class="w3-col" src="../images/avatar.png" onclick="document.getElementById('id1<?php echo $id;?>').style.display='block'"style="width:60px;border-radius:50%" >  
   <h4>user_id <?php echo $su['user_id']?>	</h4>   
	   <?php
	   }

	   ?>
	   	   <input id="id1<?php echo $su['user_id'];?>"  type="file" name="photo" style="display:none">
					</div>
					<div class="modal-body">		
						<div class="form-group">
							<label>Name</label>
							<input class="form-control" required="" name="u_name" value="<?php echo$su['username'];?>" type="text">
						</div>
						<div class="form-group">
							<label>SurName</label>
							<input class="form-control" required="" name="u_sname" value="<?php echo$su['surname'];?>" type="text">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input class="form-control"  name="u_email" value="<?php echo$su['email'];?>" type="email">
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input class="form-control"  name="u_phone" value="<?php echo$su['phonenumber'];?>" type="text">
						</div>		
						<div class="form-group">
							<label>Gender</label>
        <input class="" required="" type="radio" name="u_gender" 
        value="male" <?php if($su['gender']=='male') echo 'checked'; ?> >&nbsp; Male  &nbsp;&nbsp;
    
       <input class="" required=""  type="radio" name="u_gender" 
       value="female" <?php if($su['gender']=='female') echo 'checked'; ?> > Female 
   
						</div>	
						<div class="form-group">
							<label>Status:</label>
         <input class="" required="" type="radio" name="status" 
        value="1" <?php if($su['status']==1) echo 'checked'; ?> > &nbsp;Admin&nbsp;&nbsp;
    
         <input class="" required=""  type="radio" name="status" 
       value="0" <?php if($su['status']==0) echo 'checked'; ?> >User
   
						</div>												
					</div>
					<div class="modal-footer">
                        <input   name="u_id" value="<?php echo $id;?>" type="hidden">
						<input class="btn btn-default" data-dismiss="modal" value="Cancel" type="button">
						<input class="btn btn-info" name="save" value="save" type="submit">
					</div>
				</form>
			</div>
		</div>
	</div>
				   <?php
	   }

	   ?>
			<div class="clearfix">
                <div class="hint-text">Showing <b><?php echo $i;?></b> out of <b><?php echo $count_users;?></b> entries</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">Previous</a></li>
                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </div>
        </div>
    </div>


                    </form>			

<?php
include"../footer.php"
?>
                                		                            </body></html>




