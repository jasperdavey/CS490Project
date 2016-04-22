<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: recommendEvents.php	*
By:       Angelica Llerena		*
Date:     March 15, 2016.		*
*********************************/
$id = $_POST['id'];
$info['id']=$id;

function getFutureEvents(){
	$cmd = 31;
	
	$json = "command=$cmd";
	
	$J_url = "https://web.njit.edu/~aml35/login/commandLine.php";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $J_url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	//This is what I want from Jasper
	$DB_results= curl_exec($ch);
	curl_close($ch);
	$info = json_decode($DB_results, true);
	return $info['info'];
	
}

function getEventInfo($futureEvents){
	$events=array();
	foreach ($futureEvents as $futureEvent){
		$cmd = 32;
		$id = $futureEvent[0];
		$json = "command=$cmd&id=$id";
		$J_url = "https://web.njit.edu/~aml35/login/commandLine.php";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $J_url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		//This is what I want from Jasper
		$DB_results= curl_exec($ch);
		curl_close($ch);
		$event = json_decode($DB_results, true);
		$info = $event['info'];
		foreach($info['tags'] as $tag){
			$events[$id][]=$tag['tag'];
		}
		
	}
	return $events;
}

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
	$events['events'] = array();
	$tags = $json['tags']; //print_r($tags); echo"<br>";
	$futureEvents = getFutureEvents(); //print_r($futureEvents); echo"<br>";
	$eventTags = getEventInfo($futureEvents); //print_r($eventTags); echo"<br>";
	
	foreach($eventTags as $index=>$singleEvent){
		//echo $singleEvent;
		foreach ($tags as $tag){
			if (count(array_intersect($tag, $singleEvent))>0){
				if ($events['events'] != null){
					if (!in_array($index,$events['events'])){
						$events['events'][] = $index;
					}
					else{continue;}	
				}else{
					$events['events'][] = $index;
				}
				
			}
		}
	}
	
	$data = json_encode($events);
	echo $data;
	
}else{
	$data = $json['status'];
	$data = json_encode($data);
	echo $data;
}


?>