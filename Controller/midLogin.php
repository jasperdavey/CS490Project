<?php

$user = $_POST["ucid"];
$pass = $_POST["pass"];

$ch = curl_init("https://cp4.njit.edu/cp/home/login");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&pass=$pass&uuid=0xACA021");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
curl_close($ch);

$valid = (strpos($result,"loginok.html") !== false);

if ($valid) {
	echo "Successfully Logged In to NJIT. </br>";
} else {
    	echo "Failed to Login. Please check your username and password. </br>";
}
	  


$ch = curl_init("https://web.njit.edu/~jmd57/model.php"); 
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&pass=$pass");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);


?>
