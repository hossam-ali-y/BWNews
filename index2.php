<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>KickWeb server for Android</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">
    <style>
      * {
        line-height: 1.5;
        margin: 0;
      }

      html {
        color: black;
        font-family: sans-serif;
        text-align: justify;
font-size: 19px;
text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
      }

      body {

        position: absolute;
        top: 10%;
        width: 100%;
bottom:10%;
background: #91877b;

      }

.container {
        padding:20px;

      }
ul {
list-style-type: square;
}
      h1 {
        color: #555;
        font-size: 2em;
        font-weight: 400;
      }

      p {
        line-height: 1.2;
      }


hr { border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0)); }
.button {
font: bold 20px Arial; text-decoration: none; background-color: #EEEEEE; color: #333333; padding: 2px 6px 2px 6px; border-top: 1px solid #CCCCCC; border-right: 1px solid #333333; border-bottom: 1px solid #333333; border-left: 1px solid #CCCCCC;text-shadow: 0 1px 0 rgba(255, 255, 255, 0.7);
}

.image { 
display: block;
margin: 0 auto;
position: relative; 
width: 50%; 

} 
.image img {
width:100%;
}

.image h2 {
position: absolute; 
top: 35px; 
left: 0; 
font-size: 25px;
text-align: center;
text-shadow: 0 1px 0 rgba(255, 255, 255, 0.7);
}





      @media only screen and (max-width: 270px) {
        body {
          margin: 10px auto;
          position: static;
          width: 100%;
        }

        h1 {
          font-size: 1.5em;
        }
      }
    </style>
  </head>
  <body>
<?php
if (isset($_GET['phpinfo'])){
       phpinfo();
} else {
?>
<div class="container">
    <div class="image"> 
<img src="kickwebserverlogo.png" alt="" /> 
<h2>KickWeb server</h2> 
</div>
    <p><b>Congratulations</b> You have just successfully install KickWeb Server as your very own Personal Web Server for Android</p>
    <p>Start uploading your project to <code>/mnt/sdcard/htdocs</code></p>
    <p>Click <a href="?phpinfo">here</a> to see phpinfo</p>
<br>
<hr>
<div style="padding:15px;"class="">
Be sure to check our <a href="https://kickwe.com/tutorial" class="button"> KICKWE tutorial</a> page
</div>
<hr>
<br>
<p>
	KickWeb Server by KickWe.
Easy and automatic installation, everything is pre-configured, low memory consumption, low CPU usage, capable of serving requests simultaneously, not need of root access though you can use root aswell, and completely free of charge along with no advertisement.


# Requirements
- Internal memory should not be less than 50MB!
- Minimum Android API 9 (GINGERBREAD)!

# Features
- Lighttpd 1.4.34
- PHP 5.5.9
- MySQL 5.1.62
- MSMTP 1.4.31
- phpMyAdmin 4.1.10
- Nginx 1.5.11

# Default Document Root (htdocs)
- Path : /sdcard/htdocs/

# Default URL
- Address : localhost:8080

# phpMyAdmin Informations
- Address : localhost:10000
- Username : root
- Password :

# MySQL Informations
- Host : localhost
- Port : 3306
- Username : root
- Password :

Usage: One thing you should remember is starting server before entering Configurations.
</p>
<br>
    <h2>List of PHP extensions</h2>
    <ul class="">
<?php
    foreach(get_loaded_extensions() as $extName){
        printf('<li>%s</li>', $extName);
    }
}
?>
    </ul>
</div>
  </body>
</html>
