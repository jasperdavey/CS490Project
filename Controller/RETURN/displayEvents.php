<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: displayEvents.php	    *
By:       Angelica Llerena		*
Date:     March 15, 2016.		*
*********************************/
$table_events = array();

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

$sql = "SELECT * FROM Events;";

$db_table_events = mysql_query($sql,$connection);
if (!$db_table_events){echo "DB Error: could not query the database"; exit;}

while($row = mysql_fetch_assoc($db_table_events)){
	$table_events['id']= $row['id'];
	$table_events['name'] = $row['name'];
	$table_events['startDateTime'] = $row['startDateTime'];
	$table_events['endDateTime'] = $row['endDateTime'];
	$table_events['location']= $row['location'];
	$table_events['image']=$row['image'];
	$table_events['bio'] = $row['bio'];
	$table_events['owner']=$row['owner'];
	$table_events['attendees']=$row['attendees'];
	$table_events['tag']=getTags($connection, $row['id']);
	if($table_events['tag'] == null){$table_events['tag']="";}
	if($table_events['attendees'] == null){$table_events['attendees']="";}
	
	$response['Events'][]= $table_events;
	
}

function getTags($connection,$id){
	$sql = "SELECT * FROM Tags where owner = '".$id."';";
	$db_table_events = mysql_query($sql,$connection);
	if (!$db_table_events){echo "DB Error: could not query the database"; exit;}

	while($row = mysql_fetch_assoc($db_table_events)){
		$tags=explode(",",$row['tag']);
		return $tags;
	}
}

$response = json_encode($response);
echo $response;

?>