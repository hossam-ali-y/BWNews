
<?php
	 @session_start();
	 require_once'../connectdb.php';//connect to db newsdb
   require_once"../accounts/checkAuthrizedad.php";


   if(isset($_SESSION['status']) && isset($_SESSION['u_pass'])){

} 
else {
  header('location:loginad.php');
}

//////////////////functions///////////////////////////////
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

<?php
$msg['img']=$msg['post']=$msg['name']=$msg['delnews']=$msg1='';
$imgid=$newname=$headline='';
$uname=$_SESSION['u_name'];
if(isset($_GET['msg']))
$msg['post']=$_GET['msg'];

////////////start add news controller////////
if(isset($_POST['send'])){

if(!empty($_FILES['img']['name'])){
$fn= $_FILES['img']['name'];
$ft= $_FILES['img']['type'];
$fs= $_FILES['img']['size'];
$fe= $_FILES['img']['error'];
$ftmp= $_FILES['img']['tmp_name'];	
$v_type=['jpg','png','gif','pdf','mp4'];
//pathinfo()

$e=explode(".", $fn);
$path=strtolower(end($e));
 //echo $path;
$size=400000000;
$newname="../uploads/".uniqid().".$path";
if(! in_array($path,$v_type))
$msg['img']='play out only jpg,png,gif,pdf,mp4 are allowed'; 
else if($fs>$size)
$msg['img']='allowed size is 4 mb or less ';
else if ($fe != 0)
	$msg['img']="error occured:  $fe ";
else{

	if(move_uploaded_file($ftmp,$newname)){
	 $sql="INSERT INTO images(img_path) values(?)";
         $state=$db->prepare($sql);	
		 $state->bindValue(1,$newname);
		 $ex=$state->execute();
	$msg['img']="uploaded successfully";
	
$sql="select img_id from images WHERE img_path=?";
$s=$db->prepare($sql);	
$s->bindValue(1,$newname);
$s->execute();
$ro=$s->fetch();
$imgid=$ro['img_id'];
	}
  }
}
else
$imgid=NULL;

/*$newsid=$_POST['newsid'];*/
$postname=$_POST['postname'];
$headline=$_POST['headline'];
$report=$_POST['report'];

	$sql="select post_id from postes WHERE post_name=?";
$s=$db->prepare($sql);	
$s->bindValue(1,$postname);
$s->execute();
$row=$s->fetch();
$postid=$row['post_id'];

if(!$postid){
$msg['post']="this categry no found";
}
else{
         $username= $_SESSION['u_name'];
	     $q="SELECT user_id FROM user where username=?";
         $re=$db->prepare($q);
		 $re->bindValue(1,$username);
		 $re->execute();
         $r=$re->fetch();
		 $userid=$r['user_id'];

      $sql="INSERT INTO news (post_id,news_headline,news_report,img_id,user_id) values(?,?,?,?,?)";
         $state=$db->prepare($sql);	
	     $state->bindValue(1,$postid);
		 $state->bindValue(2,$headline);
		 $state->bindValue(3,$report);
		 $state->bindValue(4,$imgid);
		 $state->bindValue(5,$userid);
		 $exec=$state->execute();

	 if(!$exec){
	   $msg['post']="not added";
		}
	  else{
		 header("location:ad.php");
	    }
}
}
////////////end add news controller////////
?>

	<?php
/////////start delete news controller/////////////
if(isset($_POST['delete']))
{
//call to function delete_news($db) in page function.php
$msg['delnews']=delete_news($db);
}
/////////end delete news controller/////////////////////

////////////////start update news controller///////////////
if(isset($_POST['save'])){
 if(isset($_POST['newsid']))
$news=$_POST['newsid'];

$postname=$_POST['postname'];
$headline=$_POST['headline'];
$report=$_POST['report'];
if(isset($_POST['imgid']))
$img_id=$_POST['imgid'];

	$sql="select post_id from postes WHERE post_name=?";
$s=$db->prepare($sql);	
$s->bindValue(1,$postname);
$s->execute();
$row=$s->fetch();
$postid=$row['post_id'];

if(!$postid){
echo"this categry no found";
}
else{
//////////img managment 
	if(!empty($_FILES['altimg']['name'])){
$fn= $_FILES['altimg']['name'];
$ft= $_FILES['altimg']['type'];
$fs= $_FILES['altimg']['size'];
$fe= $_FILES['altimg']['error'];
$ftmp= $_FILES['altimg']['tmp_name'];	
$v_type=['jpg','png','gif','pdf','mp4'];
//pathinfo()

$e=explode(".", $fn);
$path=strtolower(end($e));
 //echo $path;
$size=8000000;
$newname="../uploads/".uniqid().".$path";
$new="$newname";
if(! in_array($path,$v_type))
$msg1='play out only jpg,png,gif,pdf,mp4 are allowed'; 
else if($fs>$size)
$msg1='allowed size is 4 mb or less ';
else if ($fe != 0)
	$msg1="error occured:  $fe ";
else{
	if(move_uploaded_file($ftmp,$newname)){   
if(isset($img_id)){
	 $sql="update images set img_path=? where img_id=?";
         $state=$db->prepare($sql);	
		 $state->bindValue(1,$new);
		 $state->bindValue(2,$img_id);
		 $exec=$state->execute();
	$msg1="and image update successfully";
	}
	else{
		 $sql="INSERT INTO images(img_path) values(?)";
         $state=$db->prepare($sql);	
		 $state->bindValue(1,$new);
		 $ex=$state->execute();
	$msg1="and image uploaded successfully";
	
$sql="select img_id from images WHERE img_path=?";
$s=$db->prepare($sql);	
$s->bindValue(1,$new);
$s->execute();
$ro=$s->fetch();
$img_id=$ro['img_id'];
	}
	}
else
	$msg1="file not uploaded";
	}
}
else if(empty($_FILES['altimg']['name'])&&!isset($_POST['imgid'])){
	$msg1="and No image";
	$img_id=null;
	
	}
else
	$msg1=" ";
//////////////
 $sql="UPDATE news SET post_id=?,news_headline=?,news_report=?,img_id=?
        WHERE news_id='$news'";
		
		$state=$db->prepare($sql);	
		$state->bindValue(1,$postid);
		$state->bindValue(2,$headline);
		$state->bindValue(3,$report);
		$state->bindValue(4,$img_id);
		// $state->bindValue(4,$gender);
	if($exec=$state->execute()){
	$msg1="you update news id=$news $msg1 ";
	}
	else
	echo "something wrong ";

}
}
///////////////end update news controller////////////

if(isset($_POST['update'])){
	header("location: ../admin/update.php?newsid={$_POST['news_id']}&&sta=ad");
	/*$sql="UPDATE images SET post_id=?,imag_path=? WHERE img_id={$_POST['img_id']}";
        
		$state=$db->prepare($sql);	
		 $state->bindValue(1,1);
		 $state->bindValue(2,$new_name);
		 $exec=$state->execute();
	
	if($db->exec($sql))
		echo "updated";
	else
		echo "not updated";	
*/
}

$sql="select * from news n left outer join images i on n.img_id=i.img_id 
  join postes p on n.post_id=p.post_id join user u on n.user_id=u.user_id 
 order by n.news_id desc";
 
 $r=$db->query($sql);
?>

<!doctyp html>
<html lang = "en">
<head>
      <title>BW Admin </title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Put favicon.ico and apple-touch-icon(s).png in the images folder -->
		<link rel="shortcut icon" href="../assets/images/ws_logo.png">
	
<link rel="stylesheet" type="text/css" href="../my.css">

<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
 <link rel="stylesheet" href="../bootstrap/css/icon.css">
		  

<script src="../bootstrap/js/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>


	  
  <style>

   body {
           padding-top: 0px;
		   margin-top: 0px;
            padding-bottom: 0px;
       
			
         }

.anc a:hover {
		color: #000;
		text-decoration: none;
	}
 nav{
 	   margin-top:0px;
color:white;
font-size:16;
font-family: initial;
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
 </head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
   <ul class="nav navbar-nav">
   	  <?php if(isset($_SESSION['u_name'])) {
	  echo "<li><a class='navbar-brand' href='../index.php'>";
	   echo "<span class='glyphicon glyphicon-user'></span>".$_SESSION['u_name']."&nbsp;".$_SESSION['u_sname']."</a>";
		 if(isset($_SESSION['u_photo'])){ 
		    $u_photo= $_SESSION['u_photo'];
             echo"<div class='photo'><a class='' href='../user/umodify.php'><img src='../$u_photo'></a></div>";
		    }
	     }else 
		 echo "<a class='navbar-brand' href='#'>ALyaari news</a></li>";
	     ?>
	 


      <li><a href="../home.php">Home</a></li>
   
	<li> <a href="#AddNewsModal" class="add" data-toggle="modal">
	   <i class="material-icons" data-toggle="tooltip" title="" data-original-title="add news"> <img src="../images/Overlay Add" alt="add news"width="20px">	</i></a>
      </li>
	  
	  <li class="active"><a href="ad.php"><span class="glyphicon glyphicon-log-in"></span> ادارة المحتوى</a></li>
	  <li><a href="modifyusers.php">ادارة المستخدمين </a></li>
	</ul>
	  <ul class="nav navbar-nav navbar">
     Welcom <?php if(isset($_SESSION['status'])) echo "Admin"; else echo "Mr";?> &nbsp;
	<span class='great'> <?php echo $_SESSION['u_name'];?></span>&nbsp;In content managment
   &nbsp;&nbsp;
   <a href='#logoutmodal' class='' data-toggle='modal'><button class='btn danger'>تسجيل الخروج</button></a>

	</ul>
	  <?php echo $msg['post'].$msg1.$msg['delnews']; ?>


  </div>
</nav>
     
 <!-- /container -->



		
<div class="w3-content w3-padding" style="max-width:1564px">

	 <div class="w3-row-padding ">
	<?php
	foreach($r as $i){
	$path=$i['img_path'];
		$nid=$i['news_id'];
	?>
	<div class="w3-col l3 m6 w3-margin-bottom">

	<form class = "w3-container" role = "form" action="<?php echo  $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data"  method="post">
                 
  
  <?php echo $nid;
	
	IF(ISSET($i['img_path'])):
	?>
	  <div class="blog-img"> <img src="<?php echo $path;?>" alt="<?php echo $i['username'];?>" style="width:100%">
          <div class="mask"> <a class="info" href="<?php echo'../blog_detail.php?nid='.$nid;?>">Read More</a> </div>
        </div>
		<input type="hidden" name="imgid" value="<?php echo $i['img_id'];?>">
		<?php endif;?>
		
      
            <p><?php if($i['username']==$_SESSION['u_name']){echo "انا";} else echo $i['username']."&nbsp;".$i['surname'];?></p>
      <p class="w3-opacity"><?php echo $i['post_name'];?></p>
	  
	<p class="anc" ><a class="" href="<?php echo'../blog_detail.php?nid='.$nid?>"><b><?php echo $i['news_headline'];?> </b></a></p>

	  	   		<div class="col-sm-6">
	 <a href="#EditNewsModal<?php echo $i['news_id'];?>" class="w3-button w3-light-grey w3-block" alt="edit"data-toggle="modal">
	   <i class="material-icons" data-toggle="tooltip"  data-original-title="Edit" title="" > <img src="../images/Overlay Add" alt="edit"width="25px">	</i></a>
	
	<a href="#DeleteNewsModal<?php echo $i['news_id'];?>" class="w3-button w3-light-grey w3-block"  alt="delete" data-toggle="modal">
	 <i class="material-icons" data-toggle="tooltip"  data-original-title="Delete"title="" > <img src="../images/Overlay Remove" alt="delete"width="25px"></a></i>
  </div>

 
  	<!-- Edit News Modal HTML -->
	<div id="EditNewsModal<?php echo $i['news_id'];?>" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
			<form class = "w3-container" role = "form" action="<?php echo  $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data"  method="post">
                 
					<div class="modal-header">						
						<div class="modal-title"><b>تعديل</b></div>
				<button type="button" class="w3-button w3-xlarge w3-transparent w3-display-topright"
                data-dismiss="modal" aria-hidden="true" title="Close Modal"> X</button>
				</div>
					<div class="modal-body">		
					
<div>

           <?php
		   if(isset($_GET['msg']))echo $_GET['msg']."<br>"; ?>
		news id <?php echo $i['news_id'];?><br>
category 
<select class = "form-control" name="postname">
<option <?php if($i['post_name']=="social")echo "selected='selected'";?>>social</option>
<option <?php if($i['post_name']=="local") echo "selected='selected'";?>>local</option>
<option <?php if($i['post_name']=="sport") echo "selected='selected'";?>>sport</option>
<option  <?php if($i['post_name']=="education") echo "selected='selected';"?>>education</option>
<option  <?php if($i['post_name']=="economic") echo "selected='selected'";?>>economic</option>
</select>
	
        headline
            <textarea class = "form-control"  type='text' name='headline' 
             rows="1" ><?php echo $i['news_headline'];?>
		   	</textarea>
			
		report
			<textarea class = "form-control"  type='text' name='report' 
             rows="1" ><?php echo $i['news_report'];?>
		    </textarea><br>
			<?php 
	IF(ISSET($i['img_path'])){
	echo"<img  align='center'src=".$path." alt=".$i['username']." style='width:70%;height:120px'>";  ?>
			<input  type="hidden" name="imgid" value="<?php echo $i['img_id'];?>" >
		<?php
		}
	?>
	<input  type="hidden" name="postid" value="<?php echo $i['post_id'];?>" >
		
<div>
	choose a file<input type="file" name="altimg" >
	</div>
		</div>					
					</div>
					<div class="modal-footer">
						<input type="hidden" name="newsid" value="<?php echo $i['news_id'];?>">
						<input class="btn btn-default" data-dismiss="modal" value="Cancel" type="button">
						<input class="btn btn-info" name="save" value="save" type="submit">
					</div>
				</form>
			</div>
		</div>
	</div>
	
  	<!-- Delete post Modal HTML -->
	<div id="DeleteNewsModal<?php echo $i['news_id'];?>" class="modal fade" s>
		<div class="modal-dialog">
			<div class="modal-content">
				
					<div class="modal-header">						
						<h4 class="modal-title">Delete News</h4>
												<button type="button" class="w3-button w3-xlarge w3-transparent w3-display-topright"
                                         data-dismiss="modal" aria-hidden="true" title="Close Modal"> X</button>
		
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete news  with id= <?php echo $i['news_id'];?> from <?php echo $i['post_name'];?>- ?</p>
						<p class="text-warning"><small>cancle to undelete</small></p>
					</div>
					  <form class = "w3-container" role = "form" action="<?php echo  $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data"  method="post">
                  
					<div class="modal-footer">
					<input   name="post_name" value="<?php echo $i['post_name'];?>" type="hidden">
				<?php	IF(ISSET($i['img_path'])){
	?>
					<input   name="img_id" value="<?php echo $i['img_id'];?>" type="hidden">
					<?php }?>
					<input   name="news_id" value="<?php echo $i['news_id'];;?>" type="hidden">
						<input class="btn btn-default" name="cancel"data-dismiss="modal" value="Cancel" type="button">
						<input class="btn btn-danger"  name="delete" value="Delete" type="submit">
					</div>
				</form>
			</div>
		</div>
	</div>
  
	   <!--p><input class="w3-button w3-light-grey w3-block" type="submit" name="update" value="update"></p>
  <input class="w3-button w3-light-grey w3-block" type="submit" name="delete" value="delete"-->
	</form>
	  </div>
				<?php
}	
?>
  	<!-- addnews Modal HTML //////////////////////////////////////-->
<div   id="AddNewsModal" class="modal fade" >
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
	 <a href='../accounts/deletecookie.php' class="" data-toggle="modal"> <button class='btn btn-danger'>Clear cookies</button></a>
		  <?php if(isset($_SESSION['statue'])){ 
		  ?>
		                  <a href='../accounts/logoutad.php' class='' data-toggle='modal'> <button class='btn btn-default'>تسجيل الخروج</button></a>
                      <?php  
					  }		
				else{  
				?>
						<a href='../accounts/logout.php' class="" data-toggle='modal'> <button class='btn btn-default'>تسجيل الخروج</button></a>
				<?php 
				}?>
					</div>
			</div>
		</div>
	</div>
	
	</form>
	  </div>
	  <!--end logout modal-->
	  
	</div>

</div>

<?php
include"../footer.php"
?>
   </body>
</html>
