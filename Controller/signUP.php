<?php 
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: SignUp.php			*
By:       Angelica Llerena		*
Date:     March 15, 2016.		*
*********************************/

$info['firstname'] = $_POST['firstname'];
if (!isset($info['firstname'])){
	$error['status'] = 404;
	$error['Error'] = "Please enter your firstname";
	$json = json_encode($error); die($json);
}
$info['lastname'] = $_POST['lastname'];
if (!isset($info['lastname'])){
	$error['status'] = 404;
	$error['Error'] = "Please enter your lastname";
	$json = json_encode($error); die($json);
}
$info['username'] = $_POST['username'];
if (!isset($info['username'])){
	$error['status'] = 404;
	$error['Error'] = "Please enter your username";
	$json = json_encode($error); die($json);
}
$info['password'] = $_POST['password'];
if (!isset($info['password'])){
	$error['status'] = 404;
	$error['Error'] = "Please enter your password";
	$json = json_encode($error); die($json);
}
$info['email'] = $_POST['email'];
if (!isset($info['email'])){
	$error['status'] = 404;
	$error['Error'] = "Please enter your email";
	$json = json_encode($error); die($json);
}


//Getting other user's info...

$info['bio'] = $_POST['bio'];
$info['image'] = $_POST['image'];
$info['events'] = $_POST['events'];
$info['friends'] = $_POST['friends'];
$info['pendingFriendRequests'] = $_POST['pendingFriendRequests'];
$info['createdEvents'] = $_POST['createdEvents'];


//Putting all info together to send to Jasper
$data = json_encode($info);
//echo $data;
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
	echo $DB_results;
}
else{
	session_destroy();
	echo $DB_results;
}

?>
