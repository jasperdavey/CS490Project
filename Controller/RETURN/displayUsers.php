<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: displayAllUsers.php	*
By:       Angelica Llerena		*
Date:     March 15, 2016.		*
*********************************/


function getAllUsers(){
$table_users = array();

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
	$table_users['id'] = $row['id'];
	$table_users['firstname'] = $row['firstname'];
	$table_users['lastname'] = $row['lastname'];
	$table_users['email']= $row['email'];
	$table_users['username']=$row['username'];
	$table_users['bio'] = $row['bio'];
	$table_users['image'] = $row['image'];
	$table_users['events'] = $row['events'];
	$table_users['friends'] = $row['friends'];
	$table_users['createdEvents'] = $row['createdEvents'];
	$table_users['pendingFriendRequests'] = $row['pendingFriendRequests'];
	
	$response['Users'][] = $table_users;
	
}

$response = json_encode($response);
die($response);
}


getAllUsers();
?>