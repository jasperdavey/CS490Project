<?php
/********MIDDLE END**************************
Project:  CS 490 - Group # 2    			*
FileName: removeEventTag.php		    	*
By:       Angelica Llerena					*
Date:     April 10, 2016.					*
*********************************************/

//Input: event, tag
//Output: DB_results


$info['event'] = $_POST['event'];
$info['tag']= $_POST['tag'];

$response = array();


if(!isset($info['event']) || empty($info['event'])){
	$response['status'] = 404;
	$response['message'] = "Error: event empty.";
	
	$json = json_encode($response);
	die($json);
}
elseif(!isset($info['tag']) || empty($info['tag'])){
	$response['status'] = 404;
	$response['message'] = "Error: tag empty.";
	
	$json = json_encode($response);
	die($json);
}
else{
	
	$data = json_encode($info);
	
	//Sending to Jasper's url...
	$J_url = "https://web.njit.edu/~jmd57/backend.php";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $J_url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "json=".$data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	$DB_results = curl_exec($ch);
	curl_close($ch);
}

die($DB_results);
?>
