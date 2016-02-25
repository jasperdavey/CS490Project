<?php
//Getting user and password and entering NJIT Server

function login(){

$info = file_get_contents('php://input');
session_start();
$user = $_POST["ucid"];
$pass = $_POST["pass"];

$ch = curl_init("https://web.njit.edu/~aml35/login/login.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $info);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);

curl_close($ch);
list($response1,$response2) = split(" ",$result,2);

echo "</br>";

echo $response2;
echo strlen($response2)."</br>";

$response1 = json_decode($response1,true);
$response2 = json_decode($response2,true);

echo $response1[status];
echo $response2[status];
}

?>
