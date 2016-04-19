<?php
/********MIDDLE END**********************
Project:  CS 490 - Group # 2    		*
FileName: createFriendRequest.php	    *
By:       Angelica Llerena				*
Date:     April 15, 2016.				*
*****************************************/

//Input: initiatorID, targetID
//Output: 200 if successful, 304 if already pending and 404 if an error ocurred

$initiatorID = $_POST['initiatorID'];
$targetID = $_POST['targetID'];

$friends = array();
$pendingFriendRequests = array();

//checking any fields are missing
if (empty($initiatorID) || empty($targetID)){$data['status'] = 404; $data = json_encode($data); die($data);}

//DB information
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

$sql = "SELECT * FROM Users where id = '".$targetID."';";

$db_table_users = mysql_query($sql,$connection);
if (!$db_table_users){echo "DB Error: could not query the database"; exit;}

while($row = mysql_fetch_assoc($db_table_users)){
	$friends = explode(",", $row['friends']);
	$pendingFriendRequests = explode(",", $row['pendingFriendRequests']);
	
	if (in_array($initiatorID, $friends)|| in_array($initiatorID, $pendingFriendRequests)){
		$data['status'] = 304; 
		$data = json_encode($data); 
		die($data);
	}else{
		
		$pendingFriendRequests[] = $initiatorID;
		
		$query = "Update Users set pendingFriendRequests = '".$pendingFriendRequests."' where id = '".$targetID."';";
		$db_table_users = mysql_query($sql,$connection);
		if (!$db_table_users){echo "DB Error: could not query the database"; exit;}
		
		
		$data['status'] = 200; 
		$data = json_encode($data); 
		die($data);
	}
}


?>