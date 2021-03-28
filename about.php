<!doctyp html>
<html>
<head>
<meta charset="utf-8">
<title>about </title>
<link href = "bootstrap.min.css" rel = "stylesheet">
</head>
<body>

 <div class="container">
 <?php
 include 'accounts/checkAuthrized.php'
 ?>
  <div class="jumbotron">
    <h1>الصفحة من نحن محمية بتسجيل الدخول</h1> 
    <p>Bootstrap is the most popular HTML, CSS, and JS framework for developing
    responsive, mobile-first projects on the web.</p> 
  </div>
  <p>This is some text.</p> 
  <p>This is another text.</p> 
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