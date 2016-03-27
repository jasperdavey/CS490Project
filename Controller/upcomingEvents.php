<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: upcomingEvents.php	  *
By:       Angelica Llerena		  *
Date:     March 15, 2016.		    *
*********************************/


// Events taking place on the next upcoming 7 days.

$today = date("m.d.y") ;
$numEvents = 5;

//Call Jasper's Method to get info...
//Jasper will send me the next 5 upcoming Events.

$data = "today=$today&numEvents=$numEvents";

//$J_url = "https://web.njit.edu/~jmd57/.......";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $J_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

$events = curl_exec($ch);
curl_close($ch);

//Info for Devin to Display
echo "$events";

?>
