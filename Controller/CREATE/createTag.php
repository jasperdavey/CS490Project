<?php
/********MIDDLE END**************
Project:  CS 490 - Group # 2    *
FileName: createTag.php	    *
By:       Angelica Llerena		*
Date:     March 15, 2016.		*
*********************************/

//Getting the new tag information to send Jasper
$id = $_POST['id'];
$tag=$_POST['tag'];
$nice=$_POST['nice'];
$type = 0;

//Appending new tag to Tags_table in Jasper's DB
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

$sql="INSERT INTO Tags(id, tag, nice, type) VALUES($id, $tag, $nice, $type);";

$db_table_events = mysql_query($sql,$connection);
if (!$db_table_events){$data['status']=404; $data=json_encode($data); echo $data;}
else{$data['status'] = 200; $data=json_encode($data); echo $data; }

?>