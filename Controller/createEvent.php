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
$info['startDateTime']=$_POST['startDateTime'];
$info['endDateTime']=$_POST['endDateTime'];
$info['location']=$_POST['location'];
$info['image']=$_POST['image'];
$info['owner']=$_POST['owner'];

//CHECKING FOR MISSING FIELDS
if(empty($info['name'])){
	$error['status'] = 404;
	$error['Error'] = "Please enter Event name";
	$json = json_encode($error); die($json);
}

if(empty($info['startDateTime'])){
	$error['status'] = 404;
	$error['Error'] = "Please enter Event start Date and Time";
	$json = json_encode($error); die($json);
}

if(empty($info['endDateTime'])){
	$error['status'] = 404;
	$error['Error'] = "Please enter Event end Date and Time";
	$json = json_encode($error); die($json);
}

if(empty($info['location'])){
	$error['status'] = 404;
	$error['Error'] = "Please enter Event location";
	$json = json_encode($error); die($json);
}

if(empty($info['owner'])){
	$error['status'] = 404;
	$error['Error'] = "Please enter Event owner";
	$json = json_encode($error); die($json);
}

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
	$_SESSION['startDateTime']=$info['startDateTime'];
	$_SESSION['endDateTime']=$info['endDateTime'];
	$_SESSION['location']=$info['location'];
	$_SESSION['image']=$info['image'];
	$_SESSION['owner']=$info['owner'];
	echo $json['status'];
}else{
	session_destroy();
	echo $json['status'];
}

?>
