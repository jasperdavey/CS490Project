<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: recommendEvents.php	*
By:       Angelica Llerena		*
Date:     March 15, 2016.		*
*********************************/
/*
function get_pastEventsByTag($userTags, $pastEvents){//oder pastEvents by tag
	$pastEventsByTag = array();
	foreach($userTags as $userTag){
		foreach($pastEvents as $pastEvent){
			if (in_array($userTag['tag'], $pastEvent)){
				$pastEventsByTag[$userTag] = $pastEvent;
			}
		}
	}
	return $pastEventsByTag;
}

function get_futureEventsByTag($userTags,$futureEvents){//order futureEvents by tag
	$futureEventsByTag = array();
	foreach($userTags as $userTag){
		foreach($futureEvents as $futureEvent){
			if (in_array($userTag['tag'], $futureEvent)){
				$futureEventsByTag[$userTag] = $futureEvent;
			}
		}
	}
	return $futureEventsByTag;
}
*/
function get_userTagsByValue($userTags){ //order tags by $nice from high-to-low
	$userTagsByValue = array();
	$first_tag= array_shift($userTags);
	$nice_max = $first_tag['nice'];
	
		foreach($userTags as $userTag){
			$userTagsByValue[] = $userTag;
			foreach($userTag as $tag=>$nice){
				if ($nice>$nice_max){array_unshift($userTagsByValue,$userTag);}
				else{array_push($userTagsByValue,$userTag);}
			}
		}
	return $userTagsByValue;
}

function byName($events,$userEvents){
	$similarEventsByName = array();
	foreach($events as $event){
		foreach($userEvents as $userEvent){
			if (strpos($userEvent,$event)!== false){
				$similarEventsByName[]=$event;
			}
		}
	}
	return $similarEventsByName;
}

function recommend($tags,$events,$similarEventsByName){
	$recommendEvents = array();
	$recommendEvents = $similarEventsByName;
	foreach($events as $event){
		if (strpos($tags['tag'],$event)!== false){array_unshift($recommendEvents,$tags['tag']);}
		if(!in_array($event, $recommendEvents)){
			$recommendEvents[]=$event;
		}
	}
	return $recommendEvents;
}

// Matching hastags from user to event's hastags.
$info['id']= $_POST['id'];
//$info['id']=$_SESSION['id'];
//Call Jasper's Method to get data
$data = json_encode($info);
//echo $data;

$J_url = "https://web.njit.edu/~jmd57/backend.php";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $J_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "json=".$data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

//This is what I want from Jasper
$DB_results= curl_exec($ch);
curl_close($ch);

$json = json_decode($DB_results,true);
//echo $DB_results;
//print_r($json);

if ($json['status']==200){
	$tags = $json['tags']; //print_r($tags); echo"<br>";
	$events = $json['events']; //print_r($events); echo"<br>";
	$userEvents = $json['userEvents']; //print_r($userEvents); echo"<br>";
	if (empty($userEvents)){
		$recommendEvents['events']=$events;
		$data=json_encode($recommendEvents);die($data);
	}
	elseif (empty($events)){
		$recommendEvents['events']="User does not have tags";
		$data=json_encode($recommendEvents);die($data);
	}
	else{
		//$tagsByValue = get_userTagsByValue($tags); print_r($tagsByValue); echo"<br>";
		$similarEventsByName = byName($events,$userEvents); //print_r($similarEventsByName); echo"<br>";
		$recommendEvents['events'] = recommend($tags,$events, $similarEventsByName); //print_r($recommendEvents); echo"<br>";
		$data = json_encode($recommendEvents);
		echo $data;
		//$futureEventsByTag = get_futureEventsByTag($userTags,$futureEvents);
		//$userEventsByTag = get_pastEventsByTag($userTags,$pastEvents);
		//$userTagsByValue = get_userTagsByValue($userTags); //highest to lowest
	}
}else{
	$data = $json['status'];
	$data = json_encode($data);
	echo $data;
}


?>
