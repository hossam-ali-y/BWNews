<?php
$dsn = 'mysql:host=localhost;dbname=newsdb';
$username = 'root';
$password = '';
//$options = array(
//    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
//); 
$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
if (!$pdo) {
   echo 'not connect';
   }
?>