<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: recommendEvents.php	*
By:       Angelica Llerena		*
Date:     March 15, 2016.		*
*********************************/

// Matching hastags from user to event's hastags.
//$today = date("m.d.y") ;
$userID = _POST['userID'];
$numEvents = 5;

//Call Jasper's Method to get the 5 next events which tags coincides
//with the user's tags to use as a recommendation for the user to 
//consider going.

$data = "user_id=$userID&numEvents=$numEvents";

//$J_url = "https://web.njit.edu/~jmd57/.......";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $J_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

//This is what I want from Jasper
// eventID | Date&Time | Location | Description | PeopleGoing | User's Friends 
$events = curl_exec($ch);
curl_close($ch);

//echo "$events";

//Info for Devin to Display
// Events with tags in common to the user's tags +
// User's friends going to the those events

$events = json_decode($events);
$newEvents = array();
foreach ($events as $event){
	$newEvents[$event]['ID'] = $event['eventID'];
	$newEvents[$event]['Date'] = $event['eventDate'];
	$newEvents[$event]['Time'] = $event['eventTime'];
	$newEvents[$event]['Location'] = $event['eventLoc'];
	$newEvents[$event]['Description'] = $event['eventDesc'];
	
	$friends = $event['userFriends'];	
	$going = $event['going'];
	
	
	foreach ($friends as $friend){
		if (in_array($friend, $going)){
			$newEvents[$event]['friendsGoing'] = $friend;
		}
	}
}

$newEvents = json_encode($newEvents);

echo $newEvents;
?>