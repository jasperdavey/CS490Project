<?php
//Getting user and password and entering NJIT Server
//$info = file_get_contents('php://input');
session_start();
$user = $_POST["ucid"];
$pass = $_POST["pass"];

$ch = curl_init("https://web.njit.edu/~aml35/login/login.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&pass=$pass");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);

echo $result;

curl_close($ch);

?>
