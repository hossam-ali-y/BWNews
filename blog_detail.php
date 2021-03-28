<?php 
  @session_start();
   

	 require"connectdb.php";//connect to db newsdb
	 	    require_once"functions.php";
   require_once'user/usermodifycontroller.php';
require_once"nav.php";
include_once"modal.php";
	 	 if(isset($_GET['nid'])){
	 $nid=$_GET['nid'];


	 ?>
	 <?php 
	$sql="select * from news n left outer join images i on n.img_id=i.img_id 
  join postes p on n.post_id=p.post_id join user u on n.user_id=u.user_id where news_id=$nid";


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Amaze, premium HTML5 &amp; CSS3 template</title>

<!-- Favicons Icon -->
<link rel="icon" href="http://demo.magikthemes.com/skin/frontend/base/default/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="http://demo.magikthemes.com/skin/frontend/base/default/favicon.ico" type="image/x-icon" />

<!-- Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS Style -->

<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="css/owl.theme.css" type="text/css">
<link rel="stylesheet" href="css/font-awesome.css" type="text/css">
<link rel="stylesheet" href="css/blogmate.css" type="text/css">
<link rel="stylesheet" href="css/style.css" type="text/css">


<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,300,700,800,400,600' rel='stylesheet' type='text/css'>

</head>
<body>
<div class="page">

  <div class="main-container col2-right-layout">
    <div class="main container">
      <div class="row">
        <div class="col-main col-sm-9 wow bounceInUp animated">
          
          <div class="blog-wrapper" id="main"><div class="page-title new_page_title">
            <h2>Blog</h2>
          </div>
            <div class="site-content" id="primary">
              <div role="main" id="content">
                <article class="blog_entry clearfix" >
                  <header class="blog_entry-header clearfix">
                    <div class="blog_entry-header-inner">
                      <h2 class="blog_entry-title"> Pellentesque habitant morbi </h2>
                    </div>
                    <!--blog_entry-header-inner--> 
                  </header>
				  <?php
  	  $r=$db->query($sql);
	foreach($r as $i){
	$e=explode("../",$i['img_path']);
	$path=strtolower(end($e));
	$uid=$i['user_id'];
	$uname=$i['username'];
	$nid=$i['news_id'];
	$c=$i['count_subscribers'];
	$headlin=$i['news_headline'];
	$reaport=$i['news_report'];
  }
}
?>
                  <!--blog_entry-header clearfix-->
                  <div class="entry-content">
                    <div class="featured-thumb"><a href="#"><img alt="blog-img4" src="<?php echo $path?>"></a></div>
                    <div class="entry-content">
                      <p><?php echo $headlin;?></p>
                      <p><?php  if ($reaport!='')echo $reaport;else echo "no found reaport"?></p>
                      <p>Quisque nisl lectus, accumsan et euismod eu, sollicitudin ac augue. In sit amet urna magna. Curabitur imperdiet urna nec purus egestas eget aliquet purus iaculis. Nunc porttitor blandit imperdiet. Nulla facilisi. Cras odio ipsum, vehicula nec vehicula sed, convallis scelerisque quam. Phasellus ut odio dui, ut fermentum neque.</p>
                      <blockquote>Lorem ipsum dolor sit amet, consecte adipiscing elit. Integer aliquam mi nec dolor placerat a condimentum diam mollis. Ut pulvinar neque eget massa dapibus dolor.</blockquote>
                      <p>Curabitur at vestibulum sem. Aliquam vehicula neque ac nibh suscipit ultrices. Morbi interdum accumsan arcu nec scelerisque. Phasellus eget purus nulla. Suspendisse quam est, tempor quis consectetur non, interdum vitae diam. Pellentesque volutpat mollis ligula in laoreet. Aenean est dui, sagittis in consequat at, adipiscing at risus. Sed suscipit, est vitae aliquam molestie, sem dolor dignissim leo, eget imperdiet enim urna in justo. Mauris pulvinar tortor lorem. Aliquam sed nisl in ipsum tincidunt ultrices.</p>
                      <p>Nullam commodo lobortis nibh, vitae accumsan velit dapibus sed. Nunc ac sem eu libero pretium faucib. Quisque et semper odio. Praesent tortor ligula, imperdiet sed aliquet ut, pharetra at nisi. Etiam sit amet molestie est. Donec id turpis vitae leo viverra adipiscing at sed nisi. Donec ut justo nunc. Vivamu bibendum erat ac nunc sollicitudin lacinia. Phasellus sed lacus magna.</p>
                    </div>
                  </div>
                  <footer class="entry-meta"> This entry was posted						in <a rel="category tag" title="View all posts in First Category" href="#first-category">First Category</a> On
                    <time datetime="2014-07-10T06:53:43+00:00" class="entry-date">Jul 10, 2014</time>
                    . </footer>
                </article>
                <div class="comment-content wow bounceInUp animated">
                  <div class="comments-wrapper">
                    <h3> Comments </h3>
                    <ul class="commentlist">
                      <li class="comment">
                        <div class="comment-wrapper" >
                          <div class="comment-author vcard"> <p class="gravatar"><a href="#"><img width="60" height="60" alt="avatar" src="images/avatar60x60.jpg"></a></p><span class="author">John Doe</span> </div>
                          <!--comment-author vcard-->
                          <div class="comment-meta">
                            <time datetime="2014-07-10T07:26:28+00:00" class="entry-date">Thu, Jul 10, 2014 07:26:28 am</time>
                            . </div>
                          <!--comment-meta-->
                          <div class="comment-body"> Curabitur at vestibulum sem. Aliquam vehicula neque ac nibh suscipit ultrices. Morbi interdum accumsan arcu nec scelerisque ellentesque id erat sem, ut commodo nulla. Sed a nulla et eros fringilla. Phasellus eget purus nulla. </div>
                        </div>
                      </li>
                      <!--comment-->
                      <li class="comment">
                        <div class="comment-wrapper" >
                          <div class="comment-author vcard"><p class="gravatar"><a href="#"><img width="60" height="60" alt="avatar" src="images/avatar60x60.jpg"></a></p> <span class="author">John Doe</span> </div>
                          <!--comment-author vcard-->
                          <div class="comment-meta">
                            <time datetime="2014-07-10T07:27:08+00:00" class="entry-date">Thu, Jul 10, 2014 07:27:08 am</time>
                            . </div>
                          <!--comment-meta-->
                          <div class="comment-body"> Curabitur at vestibulum sem. Aliquam vehicula neque ac nibh suscipit ultrices. Morbi interdum accumsan arcu nec scelerisque ellentesque id erat sem, ut commodo nulla. Sed a nulla et eros fringilla. Phasellus eget purus nulla. </div>
                        </div>
                      </li>
                      <!--comment-->
                      <li class="comment">
                        <div class="comment-wrapper" >
                          <div class="comment-author vcard"> <p class="gravatar"><a href="#"><img width="60" height="60" alt="avatar" src="images/avatar60x60.jpg"></a></p><span class="author">John Doe</span> </div>
                          <!--comment-author vcard-->
                          <div class="comment-meta">
                            <time datetime="2014-07-10T07:27:56+00:00" class="entry-date">Thu, Jul 10, 2014 07:27:56 am</time>
                            . </div>
                          <!--comment-meta-->
                          <div class="comment-body"> Curabitur at vestibulum sem. Aliquam vehicula neque ac nibh suscipit ultrices. Morbi interdum accumsan arcu nec scelerisque ellentesque id erat sem, ut commodo nulla. Sed a nulla et eros fringilla. Phasellus eget purus nulla. </div>
                        </div>
                      </li>
                      <!--comment-->
                      <li class="comment">
                        <div class="comment-wrapper" >
                          <div class="comment-author vcard"><p class="gravatar"><a href="#"><img width="60" height="60" alt="avatar" src="images/avatar60x60.jpg"></a></p> <span class="author">Lisa White</span> </div>
                          <!--comment-author vcard-->
                          <div class="comment-meta">
                            <time datetime="2014-07-10T07:28:32+00:00" class="entry-date">Thu, Jul 10, 2014 07:28:32 am</time>
                            . </div>
                          <!--comment-meta-->
                          <div class="comment-body"> Curabitur at vestibulum sem. Aliquam vehicula neque ac nibh suscipit ultrices. Morbi interdum accumsan arcu nec scelerisque ellentesque id erat sem, ut commodo nulla. Sed a nulla et eros fringilla. </div>
                        </div>
                      </li>
                      <!--comment-->
                    </ul>
                    <!--commentlist--> 
                  </div>
                  <!--comments-wrapper-->
                  
                  <div class="comments-form-wrapper clearfix">
                    <h3>Leave A reply</h3>
                    <form class="comment-form" method="post" id="postComment" action="#">
                      <div class="field">
                        <label>Name<em class="required">*</em></label>
                        <input type="text" class="input-text" title="Name" value="" id="user" name="user_name">
                      </div>
                      <div class="field">
                        <label>Email<em class="required">*</em></label>
                        <input type="text" class="input-text validate-email" title="Email" value="" name="user_email">
                      </div>
                      <div class="clear"></div>
                      <div class="field aw-blog-comment-area">
                        <label>Comment<em class="required">*</em></label>
                        <textarea rows="5" cols="50" class="input-text" title="Comment" id="comment1" name="comment"></textarea>
                      </div>
                      <div style="width:96%" class="button-set">
                        <input type="hidden" value="1" name="blog_id">
                        <button type="submit" class="bnt-comment"><span><span>Add Comment</span></span></button>
                      </div>
                    </form>
                  </div>
                  <!--comments-form-wrapper clearfix--> 
       
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-right sidebar col-sm-3 wow bounceInUp animated">
          <div role="complementary" class="widget_wrapper13" id="secondary">
            <div class="popular-posts widget widget__sidebar" id="recent-posts-4">
              <h3 class="widget-title">Most Popular Post</h3>
              <div class="widget-content">
                <ul class="posts-list unstyled clearfix">
                  <li>
                    <figure class="featured-thumb"> <a href="blog_detail.html"> <img width="80" height="53" alt="blog image" src="images/blog-img1.jpg"> </a> </figure>
                    <!--featured-thumb-->
                    <h4><a title="Pellentesque posuere" href="blog_detail.html">Pellentesque posuere</a></h4>
                    <p class="post-meta"><i class="icon-calendar"></i>
                      <time datetime="2014-07-10T07:09:31+00:00" class="entry-date">Jul 10, 2014</time>
                      .</p>
                  </li>
                  <li>
                    <figure class="featured-thumb"> <a href="blog_detail.html"> <img width="80" height="53" alt="blog image" src="images/blog-img1.jpg"> </a> </figure>
                    <!--featured-thumb-->
                    <h4><a title="Dolor lorem ipsum" href="blog_detail.html">Dolor lorem ipsum</a></h4>
                    <p class="post-meta"><i class="icon-calendar"></i>
                      <time datetime="2014-07-10T07:01:18+00:00" class="entry-date">Jul 10, 2014</time>
                      .</p>
                  </li>
                  <li>
                    <figure class="featured-thumb"> <a href="blog_detail.html"> <img width="80" height="53" alt="blog image" src="images/blog-img1.jpg"> </a> </figure>
                    <!--featured-thumb-->
                    <h4><a title="Aliquam eget sapien placerat" href="blog_detail.html">Aliquam eget sapien placerat</a></h4>
                    <p class="post-meta"><i class="icon-calendar"></i>
                      <time datetime="2014-07-10T06:59:14+00:00" class="entry-date">Jul 10, 2014</time>
                      .</p>
                  </li>
                  <li>
                    <figure class="featured-thumb"> <a href="blog_detail.html"> <img width="80" height="53" alt="blog image" src="images/blog-img1.jpg"> </a> </figure>
                    <!--featured-thumb-->
                    <h4><a title="Pellentesque habitant morbi" href="blog_detail.html">Pellentesque habitant morbi</a></h4>
                    <p class="post-meta"><i class="icon-calendar"></i>
                      <time datetime="2014-07-10T06:53:43+00:00" class="entry-date">Jul 10, 2014</time>
                      .</p>
                  </li>
                </ul>
              </div>
              <!--widget-content--> 
            </div>
            <div class="popular-posts widget widget_categories" id="categories-2">
              <h3 class="widget-title">Categories</h3>
              <ul>
                <li class="cat-item cat-item-19599"><a href="#first-category">First Category</a></li>
                <li class="cat-item cat-item-19599"><a href="#second-category">Second Category</a></li>
              </ul>
            </div>
            <!-- Banner Ad Block -->
            <div class="ad-spots widget widget__sidebar">
              <h3 class="widget-title">Ad Spots</h3>
              <div class="widget-content"><a target="_self" href="#" title=""><img alt="offer banner" src="images/offerBanner.jpg"></a></div>
            </div>
            <!-- Banner Text Block -->
            <div class="text-widget widget widget__sidebar">
              <h3 class="widget-title">Text Widget</h3>
              <div class="widget-content">Mauris at blandit erat. Nam vel tortor non quam scelerisque cursus. Praesent nunc vitae magna pellentesque auctor. Quisque id lectus.<br>
                <br>
                Massa, eget eleifend tellus. Proin nec ante leo ssim nunc sit amet velit malesuada pharetra. Nulla neque sapien, sollicitudin non ornare quis, malesuada.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <!-- Footer -->
  <?php
require_once"footer1.php"
?>
  <!-- End Footer -->
</div>
<div class="help_slider">
  <div class="text alignleft">Need Help?</div>
  <div class="icons"> <a class="show_hide" id="questionbox-side-phonebutton" href="javascript:void(0)"><i class="icon-phones">&nbsp;</i></a> <a class="show_hide1" id="questionbox-side-emailbutton" href="javascript:void(0)"><i class="icon-email">&nbsp;</i></a> </div>
</div>
<div id="hideShow" class="right-side-content" style="display: none;">
  <!--Contact Static Block -->
  <div class="slider-phone active">
    <h2 class="">Talk To Us</h2>
    <h3 class="">Available 24/7</h3>
    <p class="textcenter"> Want to speak to someone? We're here 24/7 to answer any questions. Just call!<br>
      <br>
      <span class="phone-number"> +1 800 123 1234</span></p>
    <a id="hideDiv" class="slider-close" href="javascript:void(0)"></a> </div>
  <div class="slider-email hidden">
    <h2 class="">Let us know how we can help you.</h2>
    <form action="#" enctype="application/x-www-form-urlencoded" method="post" id="form-contact-help_slider">
      <div class="column sixty">
        <div class="">
          <ul>
            <li>
              <label>First Name</label>
              <input type="text" name="FirstName" class="required-entry">
              <div class="clearfix"></div>
            </li>
            <li>
              <label>Last Name</label>
              <input type="text" name="LastName" class="required-entry">
              <div class="clearfix"></div>
            </li>
            <li>
              <label>Email Address</label>
              <input type="email" name="Email" class="required-entry">
              <div class="clearfix"></div>
            </li>
            <li>
              <label>Phone Number</label>
              <input type="text" name="Phone">
              <div class="clearfix"></div>
            </li>
          </ul>
        </div>
      </div>
      <div class="column fourty last">
        <div class="padding">
          <textarea name="Contact_Form_Message__c" class="required-entry">How can we help you?</textarea>
          <div class="textright">
            <button class="button btn-sent" title="Add to Cart" type="button"><span>Send</span></button>
          </div>
        </div>
      </div>
    </form>
    <div class="clearfix"></div>
    <a class="slider-close" href="#"></a></div>
</div>
<div id="hideShow1" style="display: none;">
  <div class="right-side-content hidden1">
    <div class="slider-email active">
      <div id="messages_product_view"></div>
      <div id="formSuccess" style="display:none;">Your inquiry was submitted and will be responded to as soon as possible. Thank you for contacting us.</div>
      <form action="#" id="contactForm1" method="post">
        <div class="column sixty">
          <h2>TALK TO US</h2>
          <ul>
            <li>
              <label>Name<em class="required">*</em></label>
              <input name="name" id="name" title="Name" value="" class="input-text required-entry" type="text">
            </li>
            <li>
              <label>Email<em class="required">*</em></label>
              <input name="email" id="email" title="Email" value="" class="input-text required-entry validate-email" type="text">
            </li>
            <li>
              <label>Telephone</label>
              <input name="telephone" id="telephone" title="Telephone" value="" class="input-text" type="text">
            </li>
          </ul>
		  <p class="required">* Required Fields</p>		  
        </div>
        <!--column sixty-->
        <div class="column fourty last">
          <div class="padding">
            <label>Comment<em class="required">*</em></label>
            <textarea name="comment" title="Comment" class="required-entry input-text" cols="5" rows="3"></textarea>
            <div class="textright">
              <input type="text" name="hideit" value="" style="display:none !important;">
              <button type="submit" title="Submit" class="button btn-sent"><span>Submit</span></button>
              <img src="images/mgkloading1.gif" id="loader" alt="loader" style="display:none;"> </div>
            <!--textright-->
          </div>
          <!--padding-->
        </div>
        <!--column fourty last-->
      </form>
      <a href="javascript:void(0)" id="hideDiv1" class="slider-close"></a> </div>
    <!--slider-email active-->
  </div>
  <!--right-side-content hidden1-->
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
</body>
</html>