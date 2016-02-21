<?php

$user = $_POST["ucid"];
$pass = $_POST["pass"];

$ch = curl_init("https://cp4.njit.edu/cp/home/login");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&pass=$pass&uuid=0xACA021");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = rtrim(curl_exec($ch));
curl_close($ch);

$valid = (strpos($result,"loginok.html") !== false);
if ($valid) {
    echo "Successfully Logged In. </br>";
} else {
		echo "Failed. </br>";
  }
	  
/********************Still working on...********************************/
	  /*
$ch = curl_init("###"); //Jasper I need your php url
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&pass=$pass");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = rtrim(curl_exec($ch));
echo $result;
curl_close($ch);
	  */
?>
