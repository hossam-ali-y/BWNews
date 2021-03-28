<?php

$msg['img']=$msg['post']=$msg['name']=$msg['delnews']=$msg1='';
$imgid=$newname=$headline='';

if(isset($_GET['msg']))
$msg['post']=$_GET['msg'];

?>
<div class="page">
  <!-- Header -->
<header class="header" >
    <div class="container">
	
      <div class="row">
        <div class="col-lg-5 col-sm-4 col-md-5">
    
								  <?php if(isset($_SESSION['u_name'])) {

		 if(isset($_SESSION['u_photo'])){ 
		    $u_photo= $_SESSION['u_photo'];
				  echo "<a href='#edituserModal' title='".' البيانات الشخصية ل '.$_SESSION['u_name']."' data-toggle='modal'>";
				   echo "<img style='border-radius:50%;width:70px;' alt='$u_photo' src=".$u_photo."></a>"; 
				   ?>
		 		                <!-- Header Logo -->
          <a class="" title="Bw News" href="home.php">
		  <img style="border-radius:50%;width:70px;background-color:white;" alt="	bw news" src="assets/images/bw_logo.png"></a>
		  
				   <?php 
				   echo "<br><a href='index.php' title='صفحتي الشخصية'><span class='category-label'>".$_SESSION['u_name']."&nbsp;".$_SESSION['u_sname']."</span></a>";
         		
		    }
			else{
			   echo"<a class='' title='Bw News' href='home.php'><img style='border-radius:50%;width:70px;background-color:white;' alt='ws news' src='assets/images/bw_logo.png'></a>";
         	
			 echo " <a class='' href='user/umodify.php'><br><span class='category-label'><span class='glyphicon glyphicon-user'></span>".$_SESSION['u_name']."&nbsp;".$_SESSION['u_sname']."</span></a>";
			}
	     }else {
		  echo"<a class='' title='Bw News' href='home.php'><img style='border-radius:50%;width:70px;background-color:white;' alt='ws news' src='assets/images/bw_logo.png'></a>";
         	
		 echo "</a>";
		 }
	     ?>
					
 

		</div>
		     
		 <!--img class="w3-image" src="uploads/5ce4bd5631fbc.jpg" alt="Architecture" width="1500" height="600"-->
  <div class="w3-display-middle w3-margin-top w3-center" >
   <h1  class="hidden-xs">  
	 <span class="w3-padding w3-black w3-opacity-min" >
	 <a class="" title="Magento Commerce" href="home.php" ><b >ALYAARI_NEWS</b></a></span> <span class="w3-hide-small w3-text-light-blue" ></span></h1>
  </div>
  
        <div class=" col-lg-7 col-sm-8 col-md-7 col-xs-12">
          <div class="header-top">
            <div class="welcome-msg hidden-xs"> 
 <?php 
if(isset($_SESSION['u_name']) && $_SESSION['u_pass']){
 ?>
 Welcom <?php if(isset($_SESSION['status'])) echo "Admin"; else echo "Mr";?> &nbsp;
	<span class='great'> <?php echo"<mark background-color='blue'>".$_SESSION['u_name']."</mark>";?></span>&nbsp;In My Web Site
   <?php 
   }
   else{
   
   ?>
   <span class='great'></span>WelcomIn My Web Site
     <?php 
   }
   ?>
   
			</div>
            <!-- Header Language -->
            <div class="dropdown block-language-wrapper"> <a role="button" data-toggle="dropdown" data-target="" class="block-language dropdown-toggle" href="#"> <img src="images/english.png" alt="language"> English <span class="caret"></span> </a>
              <ul class="dropdown-menu" role="menu">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><img src="images/english.png" alt="language"> English </a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><img src="images/francais.png" alt="language"> French </a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><img src="images/german.png" alt="language"> German </a></li>
              </ul>
            </div>
            <!-- End Header Language -->
			
            <!-- Header Top Links -->
			<!-- Header -->
            <div class="toplinks">
              <div class="links">
                <!-- End Header Company -->
	  <div class="login"><a href="admin/ad.php" title="Admin"><span class="hidden-xs">Admin</span></a></div>
				 <?php 
if(isset($_SESSION['u_name']) && isset($_SESSION['u_pass'])){
 ?>

              <?php  
            if(isset($_SESSION['status']))
                echo" <div class='logout' ><a href='#logoutmodal' data-toggle='modal' title='تسجيل الخروج'><i class='hidden-xs'>تسجيل الخروج&nbsp;</i></a></div>";
            else{
              ?>
                 <div class="logout"><a href='#logoutmodal' title='تسجيل الخروج' data-toggle='modal'><i class='hidden-xs'> تسجيل الخروج&nbsp;</i></a></div>

<?PHP
            }
}
else{
	if(isset($_COOKIE['admin']) || isset($_COOKIE['user'])){
if(isset($_COOKIE['admin']))
  $name=$_COOKIE['admin'];
  else if(isset($_COOKIE['user']))
    $name=$_COOKIE['user'];
?>  
 <div class="login"><a href="index.php" title="استعادة الولوج الى حسابي"><span class="hidden-xs"><?php  echo $name ; ?></span></a></div>
<?php }?>  
  

	 <div class="myaccount"><a href="#sign_up" title="إنشاء حساب جديد" data-toggle="modal" >&nbsp;<i class="hidden-xs">إنشاء حساب </i></a></div>
	 
	 			
  <div class="login"><a href="#login"  data-toggle="modal" title="تسجيل دخول بحساب اخر">&nbsp;<i class="hidden-xs">تسجيل الدخول</i></a></div>
		<?php
		}?>
			 </div>
            </div>
            <!-- End Header Top Links -->
          </div>
        
        </div>
      </div>
    </div>
	 </div>
  </header>
  
  <!-- end header -->
  <!-- Navbar -->
  <nav>
    <div class="container">
      <div class="nav-inner">
        <!-- mobile-menu -->
        <div class="hidden-desktop" id="mobile-menu">
          <ul class="navmenu">
            <li>
              <div class="menutop">
                <div class="toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></div>
                <h2>Menu</h2>
              </div>
              <ul style="display:none;" class="submenu">
                <li>
				
                  <ul class="topnav">
				  <li class="level0 nav-6 level-top first parent"> <a class="level-top" href="index.html"> <span>home</span> </a>
                      <ul class="level0">
                        <li class="level1"><a href="../../layout-1/red/index.html"><span>Home Version 1</span></a> </li>
                        <li class="level1"><a href="../../layout-2/red/index.html"><span> Home Version 2</span></a> </li>
                        <li class="level1"><a href="../../layout-1/aqua/index.html"><span>Aqua</span></a> </li>
                        <li class="level1"><a href="../../layout-1/orange/index.html"><span>Orange</span></a> </li>
                        <li class="level1"><a href="../../layout-1/red/index.html"><span>Red</span></a> </li>
                        <li class="level1"><a href="../../layout-1/yellow/index.html"><span>Yellow</span></a> </li>
                         </ul>
                    </li>
					
                    <li class="level0 nav-1 level-top first parent"> <a href="grid.html" class="level-top"> <span>Women</span> </a>
                      <ul class="level0">
                        <li class="level1 nav-1-1 first parent"> <a href="grid.html"> <span>Stylish Bag</span> </a>
                          <ul class="level1">
                            <li class="level2 nav-1-1-1 first"> <a href="grid.html"> <span>Clutch Handbags</span> </a> </li>
                            <li class="level2 nav-1-1-2"> <a href="grid.html"> <span>Diaper Bags</span> </a> </li>
                            <li class="level2 nav-1-1-3"> <a href="grid.html"> <span>Bags</span> </a> </li>
                            <li class="level2 nav-1-1-4 last"> <a href="grid.html"> <span>Hobo Handbags</span> </a> </li>
                          </ul>
                        </li>
                        <li class="level1 nav-1-2 parent"> <a href="grid.html"> <span>Material Bag</span> </a>
                          <ul class="level1">
                            <li class="level2 nav-1-2-5 first"> <a href="grid.html"> <span>Beaded Handbags</span> </a> </li>
                            <li class="level2 nav-1-2-6"> <a href="grid.html"> <span>Fabric Handbags</span> </a> </li>
                            <li class="level2 nav-1-2-7"> <a href="grid.html"> <span>Handbags</span> </a> </li>
                            <li class="level2 nav-1-2-8 last"> <a href="grid.html"> <span>Leather Handbags</span> </a> </li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li class="level0 nav-2 level-top parent"> <a href="grid.html" class="level-top"> <span>Men</span> </a>
                      <ul class="level0">
                        <li class="level1 nav-2-1 first parent"> <a href="grid.html"> <span>Shoes</span> </a>
                          <ul class="level1">
                            <li class="level2 nav-2-1-1 first"> <a href="grid.html"> <span>Sport Shoes</span> </a> </li>
                            <li class="level2 nav-2-1-2"> <a href="grid.html"> <span>Casual Shoes</span> </a> </li>
                            <li class="level2 nav-2-1-3"> <a href="grid.html"> <span>Leather Shoes</span> </a> </li>
                            <li class="level2 nav-2-1-4 last"> <a href="grid.html"> <span>canvas shoes</span> </a> </li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li class="level0 nav-3 level-top parent"> <a href="grid.html" class="level-top"> <span>Electronics</span> </a>
                      <ul class="level0">
                        <li class="level1 nav-3-1 first parent"> <a href="grid.html"> <span>Mobiles</span> </a>
                          <ul class="level1">
                            <li class="level2 nav-3-1-1 first"> <a href="grid.html"> <span>Samsung</span> </a> </li>
                            <li class="level2 nav-3-1-2"> <a href="grid.html"> <span>Nokia</span> </a> </li>
                            <li class="level2 nav-3-1-3"> <a href="grid.html"> <span>iPhone</span> </a> </li>
                            <li class="level2 nav-3-1-4 last"> <a href="grid.html"> <span>Sony</span> </a> </li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li class="level0 nav-4 level-top parent"> <a href="grid.html" class="level-top"> <span>Furniture</span> </a>
                      <ul class="level0">
                        <li class="level1 nav-4-1 first parent"> <a href="grid.html"> <span>Living Room</span> </a>
                          <ul class="level1">
                            <li class="level2 nav-4-1-1 first"> <a href="grid.html"> <span>Racks &amp; Cabinets</span> </a> </li>
                            <li class="level2 nav-4-1-2"> <a href="grid.html"> <span>Sofas</span> </a> </li>
                            
                          </ul>
                        </li>
                        <li class="level1 nav-4-2 parent"> <a href="grid.html"> <span>Dining &amp; Bar</span> </a>
                          <ul class="level1">
                            <li class="level2 nav-4-2-5 first"> <a href="grid.html"> <span>Dining Table Sets</span> </a> </li>
                            <li class="level2 nav-4-2-6"> <a href="grid.html"> <span>Serving Trolleys</span> </a> </li>
                          
                          </ul>
                        </li>
                      </ul>
                    </li>
                
                  </ul>
                </li>
		
              </ul>
            </li>
          </ul>
          <!--navmenu-->
        </div>
        <!--End mobile-menu -->
        <ul id="nav" class="hidden-xs">	
          <li id="nav-home" class="level0 parent drop-menu active"><a href="home.php"><span>الرئيسية</span> </a>
            <ul class="level1" style="display: none;">
              <li class="level1 parent"><a href="../../layout-2/orange/index.html"><span>Orange</span></a> </li>
              <li class="level1 parent"><a href="../../layout-2/red/index.html"><span>Red</span></a> </li>
              <li class="level1 parent"><a href="../../layout-2/yellow/index.html"><span>Yellow</span></a> </li>
            </ul>
          </li>
		  			
					<?php if(isset($_SESSION['u_name'])){	?>
   <li class="level0 parent drop-menu"><a href="#"><span>حسابي</span></a>
           <ul class="level1" style="display: none;">
		  <li><a  href="index.php" title="<?php  echo $_SESSION['u_name']; ?>">صفحتي الشخصية </a></li>
				 <li><a href="#edituserModal" title="<?php echo ' البيانات الشخصية ل '.$_SESSION['u_name']?>" data-toggle="modal" >ملفي الشخصي</a></li>
     
		  <?php if(isset($_SESSION['status'])) {  
		  echo "<li><a href='admin/ad.php'>Content Manag</a></li>";
		  echo"<li><a href='admin/modifyusers.php'>users managment</a></li>";
		} ?> 

          </ul>
      </li>
	   <?php 
		  }?>

      <li class="level0 parent drop-menu"><a href="#"><span>Category</span></a>
        <ul class="level1" style="display: none;">
          <li><a href="#">Import news</a></li>
          <li><a href="#">Today</a></li>
          <li><a href="#">More famious</a></li>
        </ul>
      </li>

   
<!-- Navbar (sit on top) -->

          <li class="level0 parent drop-menu"><a href="#"><span>Pages</span> </a>
            <ul style="display: none;" class="level1">
              <li class="level1 first"><a href="grid.html"><span>Grid</span></a></li>
              <li class="level1 nav-10-2"> <a href="list.html"> <span>List</span> </a> </li>    
                <ul class="level2">
                  <li class="level2 nav-2-1-1 first"><a href="checkout_method.html"><span>Checkout Method</span></a></li>
                  <li class="level2 nav-2-1-5 last"><a href="checkout_billing_info.html"><span>Checkout Billing Info</span></a></li>
                </ul>
              </li>
              <li class="level1 nav-10-4"> <a href="wishlist.html"> <span>Wishlist</span> </a> </li>
              <li class="level1"> <a href="dashboard.html"> <span>Dashboard</span> </a> </li>
              <li class="level1"> <a href="multiple_addresses.html"> <span>Multiple Addresses</span> </a> </li>
             
                <ul class="level2">
                  <li class="level2 nav-2-1-1 first"><a href="blog_detail.html"><span>Blog Detail</span></a></li>
                </ul>
              </li>
              <li class="level1"><a href="404error.html"><span>404 Error Page</span></a> </li>
            </ul>
          </li>
          <li class="level0 nav-5 level-top first"> <a href="grid.html" class="level-top"> <span>local</span> <span class="category-label">حسام</span></a>
            <div style="display: none; left: 0px;" class="level0-wrapper dropdown-6col">
              <div class="level0-wrapper2">
                <div class="nav-block nav-block-center">
                  <ul class="level0">
                    <li class="level1 nav-6-1 first parent item"> <a href="grid.html"> <span>Styliest Bag </span> </a>
                      <ul class="level1">
                        <li class="level2 nav-6-1-1 first"> <a href="grid.html"> <span>Clutch Handbags</span> </a> </li>
                        <li class="level2 nav-6-1-2"> <a href="grid.html"> <span>Diaper Bags</span> </a> </li>
                        <li class="level2 nav-6-1-2"> <a href="grid.html"> <span>Bags</span> </a> </li>
                        <li class="level2 nav-6-1-3 last"> <a href="grid.html"> <span>Hobo Handbags</span> </a> </li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="nav-add">
                <div class="push_item">
                  <div class="push_img"> <a href="#"> <img alt="women_jwellery" src="images/women_jwellery.png"> </a> </div>
                  <div class="push_text">Lorem Ipsum is simply dummy text of the printing</div>
                </div>
                <div class="push_item">
                  <div class="push_img"> <a href="#"> <img alt="women_bag" src="images/women_jwellery.png"> </a> </div>
                  <div class="push_text">Lorem Ipsum is simply dummy text of the printing</div>
                </div>
                <div class="push_item">
                  <div class="push_img"> <a href="#"> <img alt="women_sandle" src="images/women_jwellery.png"> </a> </div>
                  <div class="push_text">Lorem Ipsum is simply dummy text of the printing</div>
                </div>
                <div class="push_item push_item_last">
                  <div class="push_img"> <a href="#"> <img alt="women_top" src="images/women_jwellery.png"> </a> </div>
                  <div class="push_text">Lorem Ipsum is simply dummy text of the printing</div>
                </div>
                <br class="clear">
              </div>
            </div>
          </li>
          <li class="level0 nav-7 level-top parent"> <a href="grid.html" class="level-top"> <span>sport</span> </a>
            <div style="display: none; left: 0px;" class="level0-wrapper dropdown-6col">
              <div class="level0-wrapper2">
                <div class="nav-block nav-block-center">
                  <ul class="level0">
                    <li class="level1 nav-7-1 first parent item"> <a href="grid.html"> <span>Gents Purses</span> </a>
                      <ul class="level1">
                        <li class="level2 nav-7-3-15 first"> <a href="grid.html"> <span>Digital Cameras</span> </a> </li>
                        <li class="level2 nav-7-3-16"> <a href="grid.html"> <span>Camcorders</span> </a> </li>
                        <li class="level2 nav-7-3-17"> <a href="grid.html"> <span>Lenses</span> </a> </li>
                        <li class="level2 nav-7-3-18"> <a href="grid.html"> <span>Filters</span> </a> </li>
                        <li class="level2 nav-7-3-19 last"> <a href="grid.html"> <span>Tripods</span> </a> </li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </li>

          <li class="level0 nav-7 level-top parent"> <a class="level-top" href="grid.html"> <span>education</span> </a>
            <div class="level0-wrapper dropdown-6col" style="left: 0pt; display: none;">
              <div class="level0-wrapper2">
                <div class="nav-block nav-block-center grid12-8 itemgrid itemgrid-4col">
                  <ul class="level0">
                    <li class="level1 nav-7-1 first parent item"> <a href="grid.html"> <span>Smartphones</span> </a>
                      <ul class="level1">
                        <li class="level2 nav-7-1-1 first"> <a href="grid.html"> <span>Samsung</span> </a> </li>
                        <li class="level2 nav-7-1-2"> <a href="grid.html"> <span>Apple</span> </a> </li>
                       
                      </ul>
                    </li>
                    <li class="level1 nav-7-3 parent item"> <a href="grid.html"> <span>Cameras</span> </a>
                      <ul class="level1">
                        <li class="level2 nav-7-3-15 first"> <a href="grid.html"> <span>Digital Cameras</span> </a> </li>
                        <li class="level2 nav-7-3-16"> <a href="grid.html"> <span>Camcorders</span> </a> </li>
                   
                      </ul>
                    </li>
                    <li class="level1 nav-7-4 last parent item"> <a href="grid.html"> <span>Accessories</span> </a>
                      <ul class="level1">
                        <li class="level2 nav-7-2-8 first"> <a href="grid.html"> <span>Headsets</span> </a> </li>
                        <li class="level2 nav-7-2-9"> <a href="grid.html"> <span>Batteries</span> </a> </li>
                       
                      </ul>
                    </li>
                  </ul>
                </div>
                <div class="nav-block nav-block-right std grid12-4"><a href="grid.html"><img src="images/menu_furniture.png" class="fade-on-hover" alt=""></a> </div>
              </div>
            </div>
          </li>

          <li class="nav-custom-link level0 level-top parent"> <a class="level-top" href="#"><span>economic</span></a>
            <div style="display: none; left: 0px;" class="level0-wrapper">
              <div class="header-nav-dropdown-wrapper clearer">
                <div class="grid12-5">
                  <h4 class="heading">HTML5 + CSS3</h4>
                  <div class="ccs3-html5-box"><em class="icon-html5">&nbsp;</em> <em class="icon-css3">&nbsp;</em></div>
                  <p>Our designed to deliver almost everything you want to do online without requiring additional plugins.CSS3 has been split into "modules".</p>
                </div>
                <div class="grid12-5">
                  <h4 class="heading">Responsive Design</h4>
                  <a href="#//">
                  <div class="icon-custom-reponsive"></div>
                  </a>
                  <p>Responsive design is a Web design to provide an optimal navigation with a minimum of resizing, and scrolling across a wide range of devices.</p>
                </div>
                <div class="grid12-5">
                  <h4 class="heading">Google Fonts</h4>
                  <a href="#//">
                  <div class="icon-custom-google-font"></div>
                  </a>
                  <p>Our font delivery service is built upon a reliable, global network of servers. Our flexible solution provides multiple implementation options.</p>
                </div>
                <div class="grid12-5">
                  <h4 class="heading">Smart Product Grid</h4>
                  <a href="#//">
                  <div class="icon-custom-grid"></div>
                  </a>
                  <p>Smart Product Grid is uses maximum available width of the screen to display content. It can be displayed on any screen or any devices.</p>
                </div>
                <br>
              </div>
            </div>
          </li>
        </ul>
        <div id="form-search" class="search-bar">
          <form id="search_mini_form" action="#" method="get">
            <input class="search-bar-input" placeholder="Search entire store here..." type="text" value="" name="search" id="search">
            <input class="search-bar-submit" type="submit" value="">
            <span class="search-icon"><img src="images/search-icon.png" alt="search-icon"></span>
          </form>
        </div>
      </div>
    </div>
  </nav>
 
  <!-- end nav -->
  </div>
 	  <?php echo $msg['post'].$msg1.$ms; ?>

	<?php
	
	if($msg['post']!='' || $msg['user']!=''||$ms1='')
		echo"<script>alert('".$msg['user']." ".$msg['post'].$ms."') </script>";
		?>