<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: createEvent.php	    *
By:       Angelica Llerena		*
Date:     March 15, 2016.		*
*********************************/

//Getting the new event information to send Jasper
$info['name']=$_POST['name'];
$info['bio']=$_POST['bio'];
$info['dateAndTime']=$_POST['dateAndTime'];
$info['location']=$_POST['location'];
$info['image']=$_POST['image'];

//Sending info to Jasper
$data = json_encode($info);

$J_url = "https://web.njit.edu/~jmd57/backend.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $J_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "json=".$data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


$DB_results = curl_exec($ch);
curl_close($ch);

$json = json_decode($DB_results,true);

if($json['status']==200){
	$_SESSION['name']=$info['name'];
	$_SESSION['bio']=$info['bio'];
	$_SESSION['dateAndTime']=$info['dateAndTime'];
	$_SESSION['location']=$info['location'];
	$_SESSION['image']=$info['image'];
	echo $json['status'];
}else{
	session_destroy();
	echo $json['status'];
}

?>
