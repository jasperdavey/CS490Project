<?php 
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: SignUp.php			*
By:       Angelica Llerena		*
Date:     March 15, 2016.		*
*********************************/

//Getting user's info...
$info['firstname'] = $_POST['firstname'];
$info['lastname'] = $_POST['lastname'];
$info['username'] = $_POST['username'];
$info['password'] = $_POST['password'];
$info['email'] = $_POST['email'];

//Putting all info together to send to Jasper
$data = json_encode($info);

//Sending to Jasper's url...
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

$json = json_decode($DB_results, true);

//handle $_SESSION...
if ($json['status']==200){
	$_SESSION['firstname']=$info['firstname'];
	$_SESSION['lastname']=$info['lastname'];
	$_SESSION['username']=$info['username'];
	$_SESSION['password']=$info['password'];
	$_SESSION['email']=$info['email'];
	echo $json['status'];
}
else{
	session_destroy();
	echo $json['status'];
}

?>
