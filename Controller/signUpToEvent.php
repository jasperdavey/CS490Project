<?php 
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: SignUpToEvent.php	*
By:       Angelica Llerena      *
Date:     March 15, 2016.	*
*********************************/

//Getting user's info...

$fname = _POST['fname'];
$lname = _POST['lname'];
$midname = _POST['midname'];

$email = _POST['email'];


//Putting all info together to send to Jasper

$data = "fname=$fname&
		 lname=$lname&
		 midname=$midname&
		 email=$email";
		 
//$J_url = "https://web.njit.edu/~jmd57/.......";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $J_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

$results = curl_exec($ch);
curl_close($ch);

echo "$results";

?>
