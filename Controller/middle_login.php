<?php
//Getting user and password and entering NJIT Server
//session_start();
$user = $_POST["ucid"];
$pass = $_POST["pass"];

global $json;
$report = array();

$ch = curl_init("https://cp4.njit.edu/cp/home/login");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,"user=$user&pass=$pass&uuid=0xACA021");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt ($ch, CURLOPT_REFERER, "https://www.njit.edu/cp/login.php");
$result = curl_exec($ch);
curl_close($ch);
   

$valid = (strpos($result,"loginok.html") !== false);
if ($valid) {
	$report['status'] = "success";
	$json = json_encode($report);
    echo "$json </br>";
}else{
	$report['status'] = "failed";
	$json = json_encode($report);
	echo "$json </br>";
}


//Sending user and password to Jasper.
$data = "user_id=$user&password=$pass";
$J_url = "https://web.njit.edu/~jmd57/model.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $J_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

$DB_results = curl_exec($ch);
curl_close($ch);

echo "$DB_results";


?>