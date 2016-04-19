<?php
/********MIDDLE END**************************
Project:  CS 490 - Group # 2    			*
FileName: updateUserPassword.php		    	*
By:       Angelica Llerena					*
Date:     April 10, 2016.					*
*********************************************/

//Input: id, bio
//Output: DB_results


$info['id'] = $_POST['id'];
$info['password']= $_POST['password'];

$response = array();


if(!isset($info['id']) || empty($info['id'])){
	$response['status'] = 404;
	$response['message'] = "Error: user id empty.";
	
	$json = json_encode($response);
	die($json);
}
elseif(!isset($info['password']) || empty($info['password'])){
	$response['status'] = 404;
	$response['message'] = "Error: password empty.";
	
	$json = json_encode($response);
	die($json);
}
else{
	
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

	$query = mysql_query("UPDATE Users SET password = '".$info['password']."' WHERE id = '".$info['id']."';", $connection);
	if(!$query){$data['status'] = 404; $data = json_encode($data); die($data);}
	else{$data['status'] = 200; $data = json_encode($data); die($data);}
	
	// $data = json_encode($info);
	
	// //Sending to Jasper's url...
	// $J_url = "https://web.njit.edu/~jmd57/backend.php";
	// $ch = curl_init();
	// curl_setopt($ch, CURLOPT_URL, $J_url);
	// curl_setopt($ch, CURLOPT_POST, 1);
	// curl_setopt($ch, CURLOPT_POSTFIELDS, "json=".$data);
	// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	// $DB_results = curl_exec($ch);
	// curl_close($ch);
}

//die($DB_results);
?>