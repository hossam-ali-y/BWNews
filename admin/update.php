
<?php
   @session_start();
 
    include"../connectdb.php";//connect to db newsdb 
	$msg1=$msg2=$msg3='';

?>



<!doctyp html>
<html lang = "en">
<head>
      <title>Update</title>
  
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 		<meta name="description" content="">
		<meta name="author" content="">
		<!-- Devices Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" type="text/css" href="../my.css">		
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
		  	<!-- Put favicon.ico and apple-touch-icon(s).png in the images folder -->
	    <link rel="shortcut icon" href="../assets/images/ws_logo.png">
	
 <style>

 nav{
color:white;
font-size:16;
font-family: initial;
}
section{
widTH: 100%;
box-sizing:content box;
background-color: #3A41461A;
display: flex;
flex-flow: row wrap;

justify-content: space-around;
color: black;
}

section img{
height:100px;
width:100%;
box-sizing:content box;

}
.img{
width:250px;
height:170px;
}
#icon{
width:100%;
border:none;
}
div#icon a img{
width:50px;
height:50px;
}
.great{
border:1px solid #0a0a5c66;
background-color: #0b7dda;
}
.photo{
width="20%";
height:50px;
}



         body {
            padding-top: 0px;
            padding-bottom: 0spx;
           <!-- background-color: #335f6b;-->
			font-family: initial;
			color: white;
			   background-color: #2a4e5f;
			   color:black;
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

div.photo img{
height:70px;
border-radius:25em 25em;
}
		 	  .container{
		 max-width: 350px;

            margin: 0 auto;
            color: white;
			item-align: center;
			font-size: 18px;
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
             echo"<div class='photo'><img src='../$u_photo'></div>";
		    }
	     }
		 else {
		 echo "</a><a class='navbar-brand' href='#'>ALyaari news</a>";
	     }
    

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
	  
	   <li class="active"><a href="">تعديل المنشور</a></li>
	  <li><a href="ad.php">content manag</a></li>
	  <li><a href="modifyad.php">users managment</a></li>
	  <li><a href="#">About we</a></li>
    </ul>
	 Welcom <?php if(isset($_SESSION['status'])) echo "Admin"; else echo "Mr";?> &nbsp;
	<span class='great'> <?php echo $_SESSION['u_name'];?></span>&nbsp;In content managment
   &nbsp;&nbsp;<a href='../accounts/logoutad.php'><button class='btn logout'>log out</button></a>
</div>
  </div>
</nav>
     
 <!-- /container -->
      <div class = "container">


	<div>
	<?php /////////images managment
if(isset($_GET['newsid'])){
$news=$_GET['newsid'];
}
else if(isset($_POST['newsid']))
$news=$_POST['newsid'];

if(isset($_POST['update'])){
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
		 $state->bindValue(1,$newname);
		 $state->bindValue(2,$img_id);
		 $exec=$state->execute();
	$msg1="and image update successfully";
	}
	else{
		 $sql="INSERT INTO images(img_path) values(?)";
         $state=$db->prepare($sql);	
		 $state->bindValue(1,$newname);
		 $ex=$state->execute();
	$msg1="and image uploaded successfully";
	
$sql="select img_id from images WHERE img_path=?";
$s=$db->prepare($sql);	
$s->bindValue(1,$newname);
$s->execute();
$ro=$s->fetch();
$img_id=$ro['img_id'];
	}
	}
else
	$msg1="file not uploaded";
	}
}
else if(empty($_FILES['img']['name'])&&!isset($_POST['imgid'])){
	$msg1="and No image";
	$img_id=null;
	
	}
else
	$msg1="and No image";

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
	header("location:../index.php?msg=$msg1");
	}
	else
	echo "something wrong ";

}
}
?>
	<form method="post" enctype="multipart/form-data" action="<?php echo 'update.php' ; ?>">
<div>

           <?php

$sql="select * from news n left outer join images i on n.img_id=i.img_id 
  join postes p on n.post_id=p.post_id join user u on n.user_id=u.user_id 
 WHERE news_id=?";

$stat=$db->prepare($sql);	
$stat->bindValue(1,$news);
$stat->execute();
$r=$stat->fetch();
$news=$r['news_id']; 

		   if(isset($_GET['msg']))echo $_GET['msg']."<br>"; ?>
		news id <?php echo $r['news_id'];?><br>
		<input class = "form-control" type="text" name="newsid" value="<?php echo $r['news_id'];?>" style="display:none">
category 
<select class = "form-control" name="postname">
<option <?php if($r['post_name']=="social")echo "selected='selected'";?>>social</option>
<option <?php if($r['post_name']=="local") echo "selected='selected'";?>>local</option>
<option <?php if($r['post_name']=="sport") echo "selected='selected'";?>>sport</option>
<option  <?php if($r['post_name']=="education") echo "selected='selected';"?>>education</option>
<option  <?php if($r['post_name']=="economic") echo "selected='selected'";?>>economic</option>
</select>
	
        headline
            <textarea class = "form-control"  type='text' name='headline' 
             rows="1" ><?php echo $r['news_headline'];?>
		   	</textarea>
			
		report
			<textarea class = "form-control"  type='text' name='report' 
             rows="1" ><?php echo $r['news_report'];?>
		    </textarea><br>
			<?php 
	IF(ISSET($r['img_path'])){
	echo"<img class='img' src=".$r['img_path']." alt=".$r['username']." style='width:100%'>";  ?>
			<input  type="hidden" name="imgid" value="<?php echo $r['img_id'];?>" >
		<?php
		}
	?>
	<input  type="hidden" name="postid" value="<?php echo $r['post_id'];?>" >
		
<div>
	choose a file<input type="file" name="img" >
	</div>
		
	<input type="hidden" name="newsid" value="<?php echo $r['news_id'];?>">
	 <p><input class="w3-button w3-light-grey w3-block" type="submit" name="update" value="update"></p>
		</div>
		
			
	
	</form>

	<?php
	
	
	/* 
	echo "<tr><td>".$r[0]."<td>".$r[1]."<td>".$r[2]."<td>".$r[4]."</tr>";
	*/
?>
</div>


	        
		 </div> 
		 <?php
include"../footer.php"
?>
		 
   </body>
</html>
