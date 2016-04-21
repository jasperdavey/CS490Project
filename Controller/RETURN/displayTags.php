<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: displayTags.php	    *
By:       Angelica Llerena		*
Date:     April 7, 2016.		*
*********************************/

function displayTags(){
	global $table_tags;
	$table_tags = array();

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
	if (!$db_table_events){$data['status']=404; echo "json_encode($data)";exit;}
		
	while($row = mysql_fetch_assoc($db_table_events)){
		if (!in_array($row['tag'], $table_tags['tags'])){
			$table_tags['tags'][]= $row['tag'];
		}

	}
	$response = json_encode($table_tags);
	echo $response;
}

displayTags();
?>