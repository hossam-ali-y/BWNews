<?php
   @session_start();
   	 require_once"connectdb.php";//connect to db newsdb
     
	 require_once"functions.php";
	  require_once"accounts/checkAuthrized.php";//connect to db newsdb
	   require_once"user/usermodifycontroller.php";
   	 require_once"modal.php";
?>

<?php
$nid='';
$msg['img']=$msg['post']=$msg['name']=$msg['delnews']=$msg1='';
$imgid=$newname=$headline='';
$uname=$_SESSION['u_name'];
if(isset($_GET['msg']))
$msg['post']=$_GET['msg'];

/////////////////////////////insert new news////////////////////////////////
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
$newname="uploads/".uniqid().".$path";
if(! in_array($path,$v_type))
$msg['img']='play out only jpg,png,gif,pdf,mp4 are allowed'; 
else if($fs>$size)
$msg['img']='allowed size is 4 mb or less ';
else if ($fe != 0)
	$msg['img']="error occured:  $fe ";
else{
	if(move_uploaded_file($ftmp,$newname)){
	$newpath="../$newname";
	 $sql="INSERT INTO images(img_path) values(?)";
         $state=$db->prepare($sql);	
		 $state->bindValue(1,$newpath);
		 $ex=$state->execute();
	$msg['img']="uploaded successfully";
	
$sql="select img_id from images WHERE img_path=?";
$s=$db->prepare($sql);	
$s->bindValue(1,$newpath);
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
if(isset($_POST['headline']))
$headline=$_POST['headline'];
if(isset($_POST['report']))
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
        
		 try{
	     $q="SELECT user_id FROM user where username=?";
         $re=$db->prepare($q);
		 $re->bindValue(1,$uname);
		 $re->execute();
         $r=$re->fetch();
		 $userid=$r['user_id'];
}
catch(PDOException $e){
die($e->GetMessage());
}
TRY{
if(($imgid !=null||$headline !=null ) && $userid !=null ){
      $sql="INSERT INTO news (post_id,news_headline,news_report,img_id,user_id,type_date,type_day) values(?,?,?,?,?,?,?)";
         $state=$db->prepare($sql);	
	     $state->bindValue(1,$postid);
		 $state->bindValue(2,$headline);
		 $state->bindValue(3,$report);
		 $state->bindValue(4,$imgid);
		 $state->bindValue(5,$userid);	
		 $state->bindValue(6,date('y-m-d  h:m'));
	     $state->bindValue(7,date('l'));
		 $exec=$state->execute();

	 if($exec >=1 ){
	 if($imgid!=null && $headline!=null)
	      $msg['post']="$exec post added sucseccfully with image";
		  	else if($imgid!=null &&$headline==null)
			$msg['post']="$ exec only image upload sucseccfully";
			 else if($imgid==null && $headline!=null)
		  $msg['post']="$exec post added sucseccfully with no image";
		}
	
	  else if($exec < 1){
	   $msg['post']="$exec post not added";
	    }
		}
		else
		$msg['post']="اكتب منشور المنشور فارغ!!!!";
		}
		catch(PDOException $i){
die($i->GetMessage());
}
}	
}
/////////////////////////////delete news/////////////////////////////
if(isset($_POST['delete']))
{
$msg['delnews']=delete_news($db);
}

///////////////////////////////////update news/////////////////////
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
$size=400000000;
$newname="uploads/".uniqid().".$path";
$new="../$newname";
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

		$sql="select * from news n left outer join images i on n.img_id=i.img_id 
  join postes p on n.post_id=p.post_id join user u on n.user_id=u.user_id
  where u.username='$uname'
 order by n.news_id desc";
 
 $r=$db->query($sql);
	// mime_content_type($ftmp);
?>


<!doctyp html>
<html>
<head>
<title>BW My Account<?php echo $_SESSION['u_name'];?> </title>

 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 		<meta name="description" content="">
		<meta name="author" content="">
		<!-- Devices Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

  	<!-- Put favicon.ico and apple-touch-icon(s).png in the images folder -->
	    <link rel="shortcut icon" href="assets/images/ws_logo.png">

<link rel="stylesheet" href="bootstrap/css/icon.css">
<link rel="stylesheet" type="text/css" href="my.css">
  	  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	  
	  

<link rel="stylesheet" href="css/font-awesome.min.css">

<style>
         body {
           padding-top: 0px;
            padding-bottom: 0px;
            background-color: #2a4e5f;
			font-size: 16px;
			line-height: 0;
	margin: 0;
         }
.anc a:hover {
		color: #000;
		text-decoration: none;
	}

 nav{
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
	  echo "<li class='active'><a class='navbar-brand' href='index.php'>";
	   echo "<span class='glyphicon glyphicon-user'></span>".$_SESSION['u_name']."&nbsp;".$_SESSION['u_sname']."</a>";
		 if(isset($_SESSION['u_photo'])){ 
		    $u_photo= $_SESSION['u_photo'];
             echo"<div class='photo'><a class='' href='user/umodify.php'><img src='$u_photo'></a></div>";
		    }
	     }else 
		 echo "<a class='navbar-brand' href='#'>ALyaari news</a></li>";
	     ?>
	
 
      <li><a href="home.php">الرئيسية</a></li>

		  <?php if(isset($_SESSION['statue']))   
		  echo "<li><a href='admin/ad.php'>Content Manag</a></li>";?>
		  
		  	 <li><a href="#edituserModal" title="<?php echo ' البيانات الشخصية ل '.$_SESSION['u_name']?>" data-toggle="modal" >المعلومات الشخصية</a></li>
     
 	<li> <a href="#AddNewsModal" class="add" data-toggle="modal">
	   <i class="material-icons" data-toggle="tooltip" title="" data-original-title="add news"> <img src="images/Overlay Add" alt="add news"width="20px">	</i></a>
      </li>
   

	      </ul>

	 <ul class="nav navbar-nav navbar" color="white">
	    <?php if(isset($_SESSION['status'])) echo "Admin"; else echo "";?> &nbsp;
	<span class='great'> <?php echo $_SESSION['u_name'];?></span>&nbsp;مرحبا في موقعي الاخباري والإجتماعي
	
	<?PHP         if(isset($_SESSION['status'])){
	?>
<a href='#logoutmodal' class='' data-toggle='modal'><button class='btn danger'>تسجيل الخروج</button></a>
          <?php 
		  }
            else{
              ?>
                 <a href='#logoutmodal' class="" data-toggle="modal"> <button class='btn danger'>تسجيل الخروج</button></a>
<?PHP
                }
			?>
     

  </ul>
	<ul class="nav navbar-nav navbar-right">
 	 <li><a href="admin/ad.php"><span class="glyphicon glyphicon-log-in"></span>&nbsp;إدارة الموقع  </a></li>
   
      <li><a href="get.php" ><span class="glyphicon glyphicon-log-in"></span> تسجيل دخول</a></li>
    </ul>

  </div>
</nav>


 <div class="container">

<header class="headerr">

<h2 ID="home">BW NEWS موقع اخباري اجتماعي </h2>
<a href="#q"><button class="btn default">اجتماعي</button></a>
<a href="#e"><button class="btn info" STYLE="margin:0px 0px 0px 6px">اليوم</button></a>
<a href="#i"><button class="btn warning">المحلية</button></a>
<a href="#m"><button class="btn danger">رياضة</button></a>
<a href="#q"><button class="btn default">اقتصاد</button></a>
	  <?php echo $msg['post'].$msg1.$msg['delnews'].$msg['user']; ?>
	<?php
	/*	if($msg['post']!='' || $msg['user']!='' || $msg['delnews']!='')
		echo"<script>alert('".$msg['user']." ".$msg['post'].$msg['delnews']."') </script>";
	*/
		?>
</header>
		<!-- news container -->
<div class="w3-content w3-padding" style="max-width:1564px">

	 <div class="w3-row-padding ">
	<?php 
	foreach($r as $i){
	$e=explode("../",$i['img_path']);
	$path=strtolower(end($e));
	$nid=$i['news_id'];
	?>

	<div class="w3-col l3 m6 w3-margin-bottom">
		<form class = "" role = "form" action="<?php echo  $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data"  method="post">
              
	<?php echo $nid;
	
	IF(ISSET($i['img_path'])):
	?>
	  <div class="blog-img"> <img src="<?php echo $path;?>" alt="<?php echo $i['username'];?>" style="width:100%">
          <div class="mask"> <a class="info" href="<?php echo'blog_detail.php?nid='.$nid;?>">Read More</a> </div>
        </div>
		<input type="hidden" name="imgid" value="<?php echo $i['img_id'];?>">
		<?php endif;?>
		
      <p><?php if($i['username']==$_SESSION['u_name']){echo "انا";} else echo $i['username']."&nbsp;".$i['surname'];?></p>
      <p class="w3-opacity"><?php echo $i['post_name'];?></p>
	  
	<p class="anc" ><a class="" href="<?php echo'blog_detail.php?nid='.$nid?>"><b><?php echo $i['news_headline'];?> </b></a></p>

	  	   		<div class="col-sm-6">
	 <a href="#EditNewsModal<?php echo $i['news_id'];?>" class="w3-button w3-light-grey w3-block" alt="edit"data-toggle="modal">
	   <i class="material-icons" data-toggle="tooltip"  data-original-title="Edit" title="" > <img src="images/Overlay Add" alt="edit"width="25px">	</i></a>
	
	<a href="#DeleteNewsModal<?php echo $i['news_id'];?>" class="w3-button w3-light-grey w3-block"  alt="delete" data-toggle="modal">
	 <i class="material-icons" data-toggle="tooltip"  data-original-title="Delete"title="" > <img src="images/Overlay Remove" alt="delete"width="25px"></a></i>
  </div>

  
  	<!-- Edit post Modal HTML -->
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
	<div id="DeleteNewsModal<?php echo $i['news_id'];?>" class="modal fade" style="display: none;">
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
								<?php	IF(ISSET($i['img_path'])){
	?>
					<input   name="img_id" value="<?php echo $i['img_id'];?>" type="hidden">
					<?php }?>
					<input   name="post_name" value="<?php echo $i['post_name'];?>" type="hidden">
					<input   name="news_id" value="<?php echo $i['news_id'];;?>" type="hidden">
						<input class="btn btn-default" name="cancel"data-dismiss="modal" value="Cancel" type="button">
						<input class="btn btn-danger"  name="delete" value="Delete" type="submit">
					</div>
				</form>
			</div>
		</div>
	</div>
	
	</form>
	  </div>
				<?php
}	
?>
	</div>
</div>


	

	</form>
	  </div>

			

<div id="icon" align="center">
<a href="mailto:hosamali.9.bh@gmail.com">
<img src="images\mail.png">
</a>
<a href="https://www.facebook.com/">
<img src="images\facebook_color.png">
</a>
<a href="http://www.hosam/facebook">
<img src="images\youtube_color.png">
</a>
<a href="http://www.hosam/facebook">
<img src="images\twitter_color.png">
</a>
<a href="http://www.hosam/facebook">
<img src="images\google_color.png">
</a>
<a href="#home">
<a href="#home">
<img src="images\home.png">
</a>
</div>

</div>

<?php
include"footer.php"
?>

</div>
<script>
setTimeout(hidedive,5000);
function hidedive(){
var b= document.getElementsByTagName('body');
if(b[0].children[b[0].children.length-1].tagName=="DIV"){
b[0].children[b[0].children.length-1].style="display:none"
}
 
}
</script>

</body>
</html>