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
$connection = mysql_connect( $serverName, $userName, $password );
if ( !$connection )
{
    die(' Could not connect: ' . mysql_error( ) );
}

// select database
if ( !mysql_select_db( $databaseName, $connection ) )
{
    die( 'Could not select database' );
}

$sql = "SELESCT * FROM Events;";

$db_table_events = mysql_query($connection,$sql);
if (!$db_table_events){echo "DB Error: could not query the database"; exit;}
	
while($row = mysql_fetch_assoc($db_table_events)){
	$table_events['name'] = $row['name'];
	$table_events['dateAndTime'] = $row['dateAndTime'];
	$table_events['location']= $row['location'];
	$table_events['image']=$row['image'];
	$table_events['bio'] = $row['bio'];
	
}

$response = json_encode($table_events);
echo "json=".$response;

?>
