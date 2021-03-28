<?php

$ms="";
$success=0;
$i=0;
$count=count($_FILES['file']['name']);
for($i=0;$i<$count;$i++){
		//$res['success']=$_FILES['file']['name'][0];
	//if(!empty($_FILES['file']['name'])){
		$success=0;
		$file=$_FILES['file'];
$fn= $file['name'][$i];
$ft= $file['type'][$i];
$fs= $file['size'][$i];
$ftmp= $file['tmp_name'][$i];	

$v_type=['jpg','png','gif','pdf','mp4'];
//pathinfo()

$e=explode(".", $fn);
$path=strtolower(end($e));
 //echo $path;
$size=400000000;
$new_name="images/".uniqid().".$path";

	if(move_uploaded_file($ftmp,$new_name)){
	$photo=$new_name;
		$ms="upload successfullt";
		$success=1;
	}
else
	$ms="file not uploaded"; 


}
	$res=array();
	//$res['data']=$fn;
	$res['msg']=$ms;
$res['success']=$i;
echo JSON_encode($res);
?>