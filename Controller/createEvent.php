<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: createEvent.php	*
By:       Angelica Llerena	*
Date:     March 15, 2016.	*
*********************************/

//Getting the new event information to send Jasper
$title = $_POST['title'];
$host = $_POST['host'];
$description = $_POST['description'];
$date = $_POST['date'];
$time = $_POST['time'];
$location = $_POST['location'];
$rsvp = $_POST['rsvp'];
$contactInfo = $_POST['cinfo'];
$Htags = $_POST['tags'];

//Sending info to Jasper
$data = "title=$title&
		 host=$host&
		 description=$description&
		 date=$date&
		 time=$time&
		 location=$location&
		 rsvp=$rsvp&
		 contactInfo=$contactInfo&
		 Htags=$Htags";

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
