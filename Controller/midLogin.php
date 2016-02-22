<?php
//Getting user and password and entering NJIT Server

//$info = file_get_contents('php://input');

$user = $_POST["ucid"];
$pass = $_POST["pass"];
$report = array();

$ch = curl_init("https://cp4.njit.edu/cp/home/login");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&pass=$pass&uuid=0xACA021");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt ($ch, CURLOPT_REFERER, "https://www.njit.edu/cp/login.php");
$result = curl_exec($ch);
curl_close($ch);
   

$valid = (strpos($result,"loginok.html") !== false);
if ($valid) {
	$report['200'] = "Successfully Logged In to NJIT.";
	$json = json_encode($report['200']);
    echo "$json </br>";
}else{
	$report['404'] = "Failed to Login to NJIT Server. Verify username and password.";
	$json = json_encode($report['404']);
	echo "$json </br>";
}

/*
//Sending results to Devin from NJIT Server
$D_url = //Devin website;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $D_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $result);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

curl_exec($ch);
curl_close($ch);
*/

// Sending user and password to Jasper.
$data = "user=$user&pass=$pass";
$J_url = "https://web.njit.edu/~jmd57/model.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $J_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

curl_exec($ch);
curl_close($ch);


?>
