<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: userProfile.php       *
By:       Angelica Llerena      *
Date:     March 15, 2016.       *
*********************************/

$userID = _POST['userID']; 

//Jasper will send all user's info to display in user's Profile Page

$data = "user_id=$userID";

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
