<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: SignUp.php			*
By:       Angelica Llerena		*
Date:     March 15, 2016.		*
*********************************/
session_start();
//Getting user and password and entering NJIT Server
$info['username']= $_POST['username'];
$info['password']=$_POST['password'];


//Sending user and password to Jasper.
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

//echo "$DB_results";
$response = json_decode($DB_results);

//handle $_SESSION...
if ($response['status']==200){
	$_SESSION['username']=$info['username'];
	echo $response['status'];
}
else{
	session_destroy();
	echo $response['status'];
}

?>
