<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: createEvent.php	    *
By:       Angelica Llerena		*
Date:     March 15, 2016.		*
*********************************/

//Getting the new event information to send Jasper
$title = $info['event_title'];
$host = $info['event_host'];
$description = $info['event_description'];
$date = $info['event_date'];
$time = $info['event_time'];
$location = $info['event_location'];
$phone = $info['event_phone'];
$email = $info['event_email'];

//Sending info to Jasper
$dateAndTime="date=$date&time=$time";

$data = "name=$title&
		 host=$host&
		 bio=$description&
		 dateAndTime=$dateAndTime&
		 location=$location&
		 phone=$phone&
		 email=$email";

echo $data;	 
		 
/*
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

*/
?>
