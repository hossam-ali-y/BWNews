<?php

$nid='';
  @session_start();
   
	 require"connectdb.php";//connect to db newsdb
	$sql="select * from news n left outer join images i on n.img_id=i.img_id 
  join postes p on n.post_id=p.post_id join user u on n.user_id=u.user_id 
 order by n.type_date desc  limit 10 ";
 
   require_once"functions.php";
   require_once'user/usermodifycontroller.php';

   include"modal.php";
      require_once"nav.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>BW NEWS</title>
  <meta charset="utf-8">
<!-- Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">




<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="my.css">
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
		
		
	

  	  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		
<link rel="stylesheet" href="css/slider.css" type="text/css">
<link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="css/owl.theme.css" type="text/css">
<link rel="stylesheet" href="css/font-awesome.css" type="text/css">
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="css/font-awesome.min.css">
  	<!-- Put favicon.ico and apple-touch-icon(s).png in the images folder -->
	    <link rel="shortcut icon" href="assets/images/bw_logo.png">
  <style>
         
		 .img{
		 
		 height:180px;
		 }
  </style>
  <script type="text/javascript">
$(document).ready(function(){

	$('#file').on('change',function(e){
		console.log( e.target.files);
	$('#upload').submit();
	});
	
$('#formUpload').on('submit',function(e){
			   	
	e.preventDefault();
	
		   var formData=new FormData(this);

	
	$.ajax({
		type:'POST',
		url: 'upload.php',
		data:formData,
		contentType: false,
		processData: false,
		success: function (data) {
			data=JSON.parse(data);
			if (data.success) {
				alert(data.success+' files successfully uploaded!');
			} else {
				alert('error uploading your file!!!!');
			}
			console.log(data);
			//data=JSON.parse(data);

		},
		error: function (data) {
			alert('There was an error uploading your file!');
		}
});

});
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

<div class="page">
 
<div >

	



<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">

  <!-- Project Section -->
  <div class="w3-container w3-padding-32" id="projects">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">News Category</h3>
  </div>
  
    <div class="w3-row-padding">
<?php
 $m=$db->query($sql);
	foreach($m as $i){
	$e=explode("../",$i['img_path']);
	$path=strtolower(end($e));
	if(($i['post_name']=="social"||$i['post_name']=="education")&&isset($i['img_path'])){
	?>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding"><?php echo $i['post_name'];?></div>
        <img class="img" src="<?php echo $path;?>" alt="House" style="width:100%">
      </div>
   </div>
   	<?php
	}
}	?>
  </div>
</div>
  <!-- About Section -->
	<form  id="formUpload" enctype="multipart/form-data" >
				               <div class="w3-center" style="display:contents" >
											 رفع الصور اجاكس		<input type="button" id="" name="" value="رفع" onclick="$('#file').click();" >
								<div class="w3-center" id="image" class="w3-center"  style="display:none">
					
							   <input type="file" id="file" name="file[]" multiple="multiple" accept="image/*" browse="gallery"  >
						    </div> 
				  </div>
				  <input type="submit" id="upload" name="upload" value=" رفع" hidden >
				    </form>
					
  <div class="w3-container w3-padding-32" id="about">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">تعرف على الموقع </h3>
    <p>السلام عليكم ورحمة الله وبركاتة الموقع يعتبر موقع أخباري اجتماعي يمكنكم إنشاء حسابات جديده خاصة بكم وذلك باختيار انشاء حساب من الشريط العلوي
	وتعبية بياناتكم ويمكنكم ادراج صورة شخصية للحساب الخاص بكم عند انشاء الحساب اوبعده ويمكنكم بعد انشاء الحساب الدخول على صفحتكم الشخصية ورفع منشورات ومقالات وصور ويمكنكم التعديل عليها فيما بعد
	او حذها متى ما اردتم ذلك 
	حيث يمكنكم الموقع من الاطلاع على مزيد من الاخبار المتنوعة التي تنشرها ادارة الموقع من المصادر الرسمية وغيرها التي ينشرها الاعضاء من تمثالكم 
    </p>
  </div>



  </div>

  <!-- Contact Section -->
  <div class="w3-container w3-padding-32" id="contact">
    <h4 class="w3-border-bottom w3-border-light-grey w3-padding-16">ضع اقتراحك</h4>
    <p><b>شاركنا اراءك ارسل رساله لنا تفيدنا في اصلاح عيوب موجوده في الموقع او خدمات تقترح اضافتها </b></p>
    <form action="https://www.w3schools.com/action_page.php" target="_blank">
      <input class="w3-input w3-border" type="text" placeholder="اسم المستخدم" required="" name="Name">
      <input class="w3-input w3-section w3-border" type="text" placeholder="الايميل" required="" name="Email">
      <input class="w3-input w3-section w3-border" type="text" placeholder="الموضوع" required="" name="Subject">
      <input class="w3-input w3-section w3-border" type="text" placeholder="المحتوى" required="" name="Comment">
      <button class="w3-button w3-black w3-section" type="submit">
        <i class="fa fa-paper-plane"></i> ارسال الرساله
      </button>
    </form>
  </div>
  
    <!-- Latest Blog -->
  <section class="latest-blog container">
    <div class="blog_post">
      <div class="blog-title">
        <h2><span>اخر الأخبار</span></h2>
      </div>
	  
	  	
<?php
	 if(isset($_GET['uname'])){
	 	 $uname=$_GET['uname'];
	 if(isset($_SESSION['$uname'])){
	 $c=$_SESSION['$uname'];

	 $count=($c+1);
	   $s="update user set count_subscribers=? where username=?";
         $state=$db->prepare($s);	
		 $state->bindValue(1,$count);
		 $state->bindValue(2,$uname);
		 $exec=$state->execute();
	}
}

	  $r=$db->query($sql);
	foreach($r as $i){
	$e=explode("../",$i['img_path']);
	$path=strtolower(end($e));
	$uid=$i['user_id'];
	$uname=$i['username'];
	$nid=$i['news_id'];
	$c=$i['count_subscribers'];
	?>
	 <div class="col-xs-12 col-sm-4" >

	    
	 <?php
	 if(isset($i['img_path'])){
	 ?>
	  <div class="blog-img"> <img src="<?php echo $path;?>" alt="<?php echo $i['username'];?>" style="width:100%">
          <div class="mask"> <a class="info" href="<?php echo'blog_detail.php?nid='.$nid?>">Read More</a> </div>
        </div>
		 <?php
	 }
	 ?>

			<div class="sale-label sale-top-left"><?php echo $i['post_name'];?></div>
		<a href="blog_detail.html"></a> &nbsp;&nbsp;<br>
        <a href="<?php echo'blog_detail.php?nid='.$nid?>"><p><b><?php echo $i['news_headline'];?>... </b></p></a>
		<a href=""  value="subscribe" ><?PHPcomment?></a>

		      <?php 
				if(isset($i['type_date'])){
				              $da=explode(" ",$i['type_date']);
	                            $date=strtolower($da[0]);
								$time=strtolower($da[1]);					
						  //$tii=explode(":",$time);
						  // $timm=strtolower($tii[0].":".$tii[1]);
								}
									 echo"_________<br>";?>
								
								
								  <h7>
<a href="?uname=<?php echo $uname;echo "#".$nid;?>" class="w3-buttonname w3-blue" value="subscribe" width="50px"><?PHP echo $i['username']."&nbsp;".$i['surname'] ?></a>
	</h7>
				<div class="post-date"><i class="icon-calendar"></i> <?php echo $i['type_day'].", ".$time."<br>".$date;?></div>
	
      <?php

	   $_SESSION['$uname']=$c;
	   	 echo"_____________________________";?>
	   
	<br><br>
	  </div>
	
	<?php
}	
?>
     
  </section>
  <!-- End Latest Blog -->

  
  <!-- main container -->
  <section class="main-container col1-layout home-content-container">
    <div class="container">
      <div class="std">
        <div class="best-seller-pro wow bounceInUp animated">
          <div class="slider-items-products">
            <div class="new_title center">
              <h2>Best News</h2>
            </div>
				
 <div id="best-seller-slider" class="product-flexslider hidden-buttons">
              <div class="slider-items slider-width-col4" id="<?php echo $nid;?>">
			<?php
				  $r=$db->query($sql);
	foreach($r as $i){
	$e=explode("../",$i['img_path']);
	$path=strtolower(end($e));
	$uid=$i['user_id'];
	$uname=$i['username'];
	$nid=$i['news_id'];
	$c=$i['count_subscribers'];
	?>

                <div class="item"id="<?php echo $nid;?>">
                  <div class="item-inner">
                    <div class="product-block">
                     <div class="product-image"> <a href="<?php echo'blog_detail.php?nid='.$nid?>">
					 <!--figure class="product-display"></figure-->
					  <div class="sale-label sale-top-left"><?php echo $i['post_name'];?></div>
						 <?php	 if(isset($i['img_path'])){
						 
	 ?>                     
                        
	
                          <img src="<?php echo $path;?>" alt="<?php echo $i['username'];?>" class="lazyOwl product-mainpic"  style="height:150px;"> 
						  <img class="product-secondpic" alt="product-image" src="<?php echo $path;?>">
						  
                        </a> 
	
		 <?php
	 }
	 else{
	 ?>                 </a> 
	 <?php
	 } 
	 ?>
	 </div> 
                        
                      <div class="product-meta">
                        <div class="product-action"> <a class="addcart" href="shopping_cart.html"><i class="icon-like">&nbsp;</i><?php echo $i['post_name'];?></a> 
						<a class="wishlist" href="wishlist.html"> <i class="icon-heart">&nbsp;</i> </a> <a href="quick_view.html" class="quickview"> <i class="icon-zoom">&nbsp;</i> </a> </div>
                      </div>
                    </div>
                    <div class="item-info">
					<div class="sale-label sale-top-left"><?php echo $i['post_name'];?></div><br>
                      <div class="info-inner">
					  
					        <a href="<?php echo'blog_detail.php?nid='.$nid?>"><p><b><?php echo $i['news_headline'];?></b></p></a>
                        <div class="item-title"> <a href="#" title="<?php if($i['status']==1) echo "admin";else echo"user";?>">  <?php echo $i['username']."&nbsp;".$i['surname'];?>  </a> </div>
                        <div class="item-content">
                          <div class="item-price">
                            <div class="price-box"> <span class="regular-price" > <span class="price"> <a href="blog_detail.html"></a></span> </span> </div>
                          </div>
						<?php
                       if (isset($i['type_date'])){
						$d=explode(" ",$i['type_date']);
	                            $dat=strtolower($d[0]);
						  $tim=strtolower($d[1]);
						  $t=explode(":",$tim);
						   $ti=strtolower($t[0].":".$t[1]);
								}?>
						  <div class="post-date"><i class="icon-calendar"></i> <?php echo $i['type_day']." , ".$ti."<br>".$dat;?></div>
                          <div class="rating">
                            <div class="ratings">
                              <div class="rating-box">
                                <div class="rating" style="width:80%"></div>
                              </div>
                              <p class="rating-links"> <a href="#">    </a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                            
		<a href=""  value="subscribe" ><?PHPcomment?></a>
       <?php
	   if(isset($_SESSION['u_name'])){ ?>
	    <a href="?uname=<?php echo $uname;echo "#".$nid;?>" class="w3-button w3-red" value="subscribe" ><?PHP echo "subscribe ".$i['count_subscribers'] ?></a>
	 </h4><?php
	   $_SESSION['$uname']=$c;
	   }?>
						   </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
         
	<?php
}	
?>
             </div>
          </div> 
        </div>
		     </div>
          </div>
        </div>
		</section>
        <!-- Featured Slider -->
<!-- Image of location/map 
<div class="w3-container">
  <img src="./W3.CSS Template_files/map.jpg" class="w3-image" style="width:100%">
</div>
-->
<!-- End page content -->
</div>

	

<!-- Footer 
<footer class="w3-center w3-black w3-padding-16">
  <p>Powered by <a href="about.php" title="hossam" target="_blank" class="w3-hover-text-green">Eng:Hossam ALyaari</a></p>
</footer>-->
<?php
require_once"footer1.php"
?>


</div>


<!-- JavaScript -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/slider.js"></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript">
    //<![CDATA[
	jQuery(function() {
		jQuery(".slideshow").cycle({
			fx: 'scrollHorz', easing: 'easeInOutCubic', timeout: 10000, speedOut: 800, speedIn: 800, sync: 1, pause: 1, fit: 0, 			pager: '#home-slides-pager',
			prev: '#home-slides-prev',
			next: '#home-slides-next'
		});
	});
    //]]>
    </script>
<script>
			new UISearch( document.getElementById( 'form-search' ) );
		</script>
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

