<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: search.php	    	*
By:       Angelica Llerena		*
Date:     April 6, 2016.		*
*********************************/

//Input: searchType -> [Users || Events], searchText-> [text].
//Output: {{"status":"..."},{"message":"..."},{"Users|Events":{{obj 1}{obj 2}{obj 3}}}}

$response = array();
$searchType = $_POST['type'];
$searchText = $_POST['text'];
$searchText = preg_replace("#[^0-9a-z]#i","",$searchText);
//echo $searchType."<br>";
//echo $searchText."<br>";
if(!isset($searchText) || empty($searchText)){//if searchText wasn't set
	$response['status'] = 404;
	$response['message'] = "Error: Search text empty.";
	$response[$searchType][] = null;
	$json = json_encode($response);
	die($json);
}
elseif(!isset($searchType) || empty($searchType)){
	$response['status'] = 404;
	$response['message'] = "Error: Search type empty.";
	$response[$searchType] = null;
	$json = json_encode($response);
	die($json);
}
else{
	getSearch($searchText, $searchType);
}

function getSearch($searchText, $searchType){
	$databaseName = "jmd57";
	$serverName = 'sql.njit.edu';
	$userName = 'jmd57';
	$password = 'owypHuH4g';

	// create connection
	$connection = mysql_connect( $serverName, $userName, $password);
	if ( !$connection )
	{
		die(' Could not connect: ' . mysql_error() );
	}

	// select database
	if ( !mysql_select_db( $databaseName, $connection ) )
	{
		die( 'Could not select database' );
	}

	
	if ($searchType != "Users" && $searchType != "Events"){
		$response['status'] = 404;
		$response['message'] = "Error: Wrong searchType! Please use 'Users' or 'Events'.";
		$response[$searchType] = null;
		$json = json_encode($response);
		die($json);
	}
	elseif($searchType == "Users"){
		
		//echo "I am inside of Users...<br>";
		$sql = "SELECT * FROM Users;";
		$query = mysql_query($sql,$connection);
		if (!$query){echo "DB Error: could not query the database"; exit;}	  
		if(mysql_num_rows($query)){
			while($row = mysql_fetch_assoc($query)){
				//$user['id'] = $row['id'];
				$user['firstname'] = $row['firstname'];
				$user['lastname'] = $row['lastname'];
				$user['email'] = $row['email'];
				
				if (($ans = stripos($user['firstname'], $searchText))!== false||
				    ($ans = stripos($user['lastname'], $searchText))!== false ||
					($ans = stripos($user['email'], $searchText))!== false){
						
						$response[$searchType][$row['id']] = $user;
						
					}
			}
			//$response['status'] = 200;
			//$response['message'] = "Searching...";
			//$response[$searchType] = null;
			$json = json_encode($response);
			die($json);
		}else{
			$response['status'] = 404;
			$response['message'] = "Sorry, not matches were found!";
			//$response[$searchType] = null;
			$json = json_encode($response);
			die($json);
		}
	}
	else{
		//echo "I am inside of Events...<br>";
		$query = mysql_query("Select * from Events;", $connection);
							  
		if(mysql_num_rows($query)){
			while($row = mysql_fetch_assoc($query)){
				$event['name'] = $row['name'];
				$event['startDateTime'] = $row['startDateTime'];
				$event['endDateTime'] = $row['endDateTime'];
				$event['location'] = $row['location'];
				$event['bio'] = $row['bio'];
				
				if (($ans = stripos($event['name'], $searchText))!== false||
				    ($ans = stripos($event['location'], $searchText))!== false ||
					($ans = stripos($event['startDateTime'], $searchText))!== false ||
					($ans = stripos($event['endDateTime'], $searchText))!== false ||
					($ans = stripos($event['bio'], $searchText))!== false){
						
						$response[$searchType][$row['id']] = $event;
						
					}
			}
			//$response['status'] = 200;
			//$response['message'] = "Searching...";
			//$response[$searchType] = null;
			$json = json_encode($response);
			die($json);
		}else{
			$response['status'] = 404;
			$response['message'] = "Sorry, not matches were found!";
			//$response[$searchType] = null;
			$json = json_encode($response);
			die($json);
		}
	}
}
?>
