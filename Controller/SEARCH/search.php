<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: search.php	    	*
By:       Angelica Llerena		*
Date:     April 6, 2016.		*
*********************************/

//Input: searchType -> [Users || Events], searchText-> [text].
//Output: {{"status":"..."},{"message":"..."},{"Users|Events":{{obj 1}{obj 2}{obj 3}}}}


$searchType = $_POST['type'];
$searchText = $_POST['text'];


$response = array();
echo"Welcome to SEARCH:<br>";
echo "text: ".$searchText."<br>";
echo "type: ".$searchType."<br>";
if(!isset($searchText)){//if searchText wasn't set
	$response['status'] = 404;
	$response['results'][] = "Error: Search text empty.";
	//$response[$searchType][] = "";
	$json = json_encode($response);
	die($json);
}
elseif(!isset($searchType)){
	$response['status'] = 404;
	$response['results'][] = "Error: Search type empty.";
	//$response[$searchType][] = "";
	$json = json_encode($response);
	die($json);
}
else{
	getSearch($searchText, $searchType);
}


function getUserInfo($id){
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

	$sql = "SELECT * FROM Users;";

	$db_table_events = mysql_query($sql,$connection);
	if (!$db_table_events){echo "DB Error: could not query the database"; exit;}

	while($row = mysql_fetch_assoc($db_table_events)){
		if ($row['id'] == $id){
			$user_info['id'] = $row['id'];
			$user_info['firstname'] = $row['firstname'];
			$user_info['lastname'] = $row['lastname'];
			$user_info['username'] = $row['username'];
			$user_info ['email']= $row['email'];
			$user_info ['bio'] = $row['bio'];
			$user_info ['image'] = $row['image'];
			$user_info ['events'] = $row['events'];
			$user_info['friends'] = $row['friends'];
			$user_info['createdEvents'] = $row['createdEvents'];
			$user_info['pendingFriendRequests'] = $row['pendingFriendRequests'];
			//GETTING USER TAGS
			$user_info['tags'] = getUserTag($id);
			//$response['status'] =200;
			$response = $user_info;
			//$json = json_encode($response);
			return $response;
		}	
	}
}

function getUserTag($id){
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

	$sql = "SELECT * FROM Tags;";

	$db_table_events = mysql_query($sql,$connection);
	if (!$db_table_events){echo "DB Error: could not query the database"; exit;}

	while($row = mysql_fetch_assoc($db_table_events)){
		if ($row['id'] == $id){
			$user_tag['id'] = $row['id'];
			$user_tag['tag'] = $row['tag'];
			$user_tag['nice'] = $row['nice'];
			$user_tag['type'] = $row['type'];
			
			return $user_tag;
		}else{
			$user_tag = ""; 
			return $user_tag;
		}	
	}
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

	
	if ($searchType != "users" && $searchType != "events"){
		$response['status'] = 404;
		$response['results'][] = "Error: Wrong searchType! Please use 'users' or 'events'.";
		//$response[$searchType] = "";
		$json = json_encode($response);
		die($json);
	}
	elseif($searchType == "users"){
		
		//echo "I am inside of Users...<br>";
		$sql = "SELECT * FROM Users;";
		$query = mysql_query($sql,$connection);
		if (!$query){echo "DB Error: could not query the database"; exit;}	  
		if(mysql_num_rows($query)){
			while($row = mysql_fetch_assoc($query)){
				$user['id'] = $row['id'];
				$user['firstname'] = $row['firstname'];
				$user['lastname'] = $row['lastname'];
				$user['email'] = $row['email'];
				$user['username'] = $row['username'];
				
				if (($ans = stripos($user['firstname'], $searchText))!== false||
				    ($ans = stripos($user['lastname'], $searchText))!== false ||
					($ans = stripos($user['email'], $searchText))!== false ||
					($ans = stripos($user['username'], $searchText))!== false){
						
						$response['results'][] = getUserInfo($user['id']);	
				}
			}
		}
		if($response != null){
			$json = json_encode($response);
			die($json);
		}
		else{
			$response['status'] = 404;
			$response['results'][] = "Sorry, not matches were found!";
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
				$event['id'] = $row['id'];
				$event['name'] = $row['name'];
				$event['startDateTime'] = $row['startDateTime'];
				$event['endDateTime'] = $row['endDateTime'];
				$event['location'] = $row['location'];
				$event['bio'] = $row['bio'];
				$event['owner'] = $row['owner'];
				
				if (($ans = stripos($event['name'], $searchText))!== false||
				    ($ans = stripos($event['location'], $searchText))!== false ||
					($ans = stripos($event['startDateTime'], $searchText))!== false ||
					($ans = stripos($event['endDateTime'], $searchText))!== false ||
					($ans = stripos($event['bio'], $searchText))!== false ||
					($ans = stripos($event['owner'], $searchText))!== false){
						
						$response['results'][] = $event;
						
					}
			}
			
		}
		if($response != null){
			$json = json_encode($response);
			die($json);
		}
		else{
			$response['status'] = 404;
			$response['results'][] = "Sorry, not matches were found!";
			//$response[$searchType] = null;
			$json = json_encode($response);
			die($json);
		}
	}
}
?>